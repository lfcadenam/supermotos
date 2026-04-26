<?php

namespace App\Services;

use App\Models\MotoDisponible;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MotoPublicada;

class MotoService
{
    /**
     * Obtener motos disponibles filtradas (Legacy logic from motosDispo class)
     */
    public function getMotos(array $search, ?int $invExt = 1)
    {
        $query = MotoDisponible::where('estado', 1);
        
        if ($invExt !== null) {
            $query->where('moto_inv_ext', $invExt);
        }

        if (!empty($search['query'])) {
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', '%' . $search['query'] . '%')
                  ->orWhere('descripcion', 'LIKE', '%' . $search['query'] . '%');
            });
        }

        if (!empty($search['location'])) {
            $query->where('ciudad_clie_moto', $search['location']);
        }

        if (!empty($search['status'])) {
            $query->where('modelo', $search['status']);
        }

        if (!empty($search['marca'])) {
            $query->where('marca', $search['marca']);
        }

        if (!empty($search['linea'])) {
            $query->where('linea', $search['linea']);
        }

        return $query->orderBy('id_moto_disp', 'desc')
            ->paginate($search['per_page'] ?? 10);
    }

    /**
     * Obtener todas las motos disponibles (Legacy: obtenerMotosDisponibles)
     */
    public function getAllAvailable()
    {
        return MotoDisponible::whereIn('estado', [0, 1])->get();
    }

    /**
     * Obtener moto por ID MD5 (Legacy: obtenerMotosDisponiblesID)
     */
    public function getByIdMd5($idMd5)
    {
        return MotoDisponible::whereRaw('md5(id_moto_disp) = ?', [$idMd5])
            ->whereIn('moto_inv_ext', [1, 2])
            ->where('estado', 1)
            ->first();
    }

    /**
     * Obtener moto por ID numérico
     */
    public function getById($id)
    {
        return MotoDisponible::find($id);
    }

    /**
     * Guardar una nueva moto disponible (Legacy: guardarMotoDisponible)
     */
    public function create(array $data)
    {
        return MotoDisponible::create($data);
    }

    /**
     * Actualizar una moto disponible (Legacy: guardarMotoDisponibleedit)
     */
    public function update($id, array $data)
    {
        $moto = MotoDisponible::findOrFail($id);
        $moto->update($data);
        return $moto;
    }

    /**
     * Activar publicación (Legacy: activarPublicacion)
     */
    public function activate($id)
    {
        return MotoDisponible::where('id_moto_disp', $id)->update(['estado' => 1]);
    }

    /**
     * Eliminar (soft delete legacy) o borrar físicamente
     */
    public function delete($id, $permanent = false)
    {
        if ($permanent) {
            return MotoDisponible::where('id_moto_disp', $id)->delete();
        }
        return MotoDisponible::where('id_moto_disp', $id)->update(['estado' => -1]);
    }

    /**
     * Enviar correo de notificación (Legacy: enviarCorreo)
     */
    public function notifyPublication($email, $link)
    {
        Mail::to($email)->send(new MotoPublicada($link));
    }

    /**
     * Desactivar/Quitar publicación (Legacy: quitarMotoDisp)
     */
    public function deactivate($id)
    {
        return MotoDisponible::where('id_moto_disp', $id)->update(['estado' => -1]);
    }
}
