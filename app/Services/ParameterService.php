<?php

namespace App\Services;

use App\Models\Parametro;

class ParameterService
{
    /**
     * Obtener valor de un parámetro (Legacy: obtenerParametro)
     */
    public function get($key)
    {
        $param = Parametro::where('clave', $key)->first();
        return $param ? $param->valor : null;
    }

    /**
     * Guardar o actualizar un parámetro (Legacy: guardarParametro)
     */
    public function set($key, $value, $description = null)
    {
        return Parametro::updateOrCreate(
            ['clave' => $key],
            ['valor' => $value, 'descripcion' => $description ?? $key]
        );
    }
}
