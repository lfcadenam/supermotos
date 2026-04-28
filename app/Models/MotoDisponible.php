<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotoDisponible extends Model
{
    protected $table = 'motos_disponibles';
    protected $primaryKey = 'id_moto_disp';
    public $timestamps = false;

    protected $fillable = [
        'nombre_clie_moto',
        'ciudad_clie_moto',
        'telefono_clie_moto',
        'correo_clie_moto',
        'nombre',
        'marca',
        'tipoMoto',
        'linea',
        'modelo',
        'kilometraje',
        'soat_tecno_matri',
        'descripcion',
        'fotos',
        'url_insta',
        'valor',
        'moto_inv_ext',
        'estado',
        'fecha_registro',
        'ruta'
    ];

    public function photoFolder(?string $filename = null): string
    {
        $filename = trim($filename ?? $this->firstPhotoName());

        if ($filename === '') {
            return 'fotos_motos/';
        }

        $primaryPath = public_path('fotos_motos/' . $filename);
        $legacyPath = public_path('admin_files/fotos_motos/' . $filename);

        if (file_exists($primaryPath) || ! file_exists($legacyPath)) {
            return 'fotos_motos/';
        }

        return 'admin_files/fotos_motos/';
    }

    public function photoUrl(?string $filename = null): string
    {
        $filename = trim($filename ?? $this->firstPhotoName());

        if ($filename === '') {
            return asset('img/no-image.png');
        }

        return asset($this->photoFolder($filename) . $filename);
    }

    protected function firstPhotoName(): string
    {
        if (empty($this->fotos)) {
            return '';
        }

        return trim(explode(',', $this->fotos)[0]);
    }
}
