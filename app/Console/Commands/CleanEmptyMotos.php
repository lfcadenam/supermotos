<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MotoDisponible;
use Illuminate\Support\Facades\File;

class CleanEmptyMotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'motos:clean-empty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina todas las motos que no tienen datos completos (nombre, marca o fotos)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando limpieza de motos sin datos...');

        $motos = MotoDisponible::where(function($query) {
            $query->whereNull('nombre')
                  ->orWhereRaw('TRIM(nombre) = ""')
                  ->orWhereNull('marca')
                  ->orWhereRaw('TRIM(marca) = ""')
                  ->orWhereNull('fotos')
                  ->orWhereRaw('TRIM(fotos) = ""')
                  ->orWhereNull('valor')
                  ->orWhere('valor', 0)
                  ->orWhere('valor', '')
                  ->orWhere('ruta', 'LIKE', '/home/%'); // Registros basura de scripts antiguos
        })->get();

        $count = $motos->count();

        if ($count === 0) {
            $this->info('No se encontraron motos sin datos para eliminar.');
            return 0;
        }

        if ($this->confirm("Se han encontrado {$count} registros incompletos. ¿Deseas eliminarlos permanentemente junto con sus fotos?")) {
            foreach ($motos as $moto) {
                // Eliminar fotos si existen
                if (!empty($moto->fotos)) {
                    $fotos = explode(',', $moto->fotos);
                    foreach ($fotos as $foto) {
                        $foto = trim($foto);
                        if ($foto) {
                            $path = public_path('fotos_motos/' . $foto);
                            if (File::exists($path)) {
                                File::delete($path);
                            }
                        }
                    }
                }
                
                $moto->delete();
            }

            $this->info("Limpieza completada. Se eliminaron {$count} registros.");
        } else {
            $this->info('Operación cancelada.');
        }

        return 0;
    }
}
