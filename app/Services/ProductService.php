<?php

namespace App\Services;

use App\Models\Producto;
use App\Models\Accesorio;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Obtener todos los productos (Legacy: obtenerProductos)
     */
    public function getAllProducts()
    {
        return Producto::where('estado', 1)->get();
    }

    /**
     * Obtener producto por ID (Legacy: obtenerProductosID)
     */
    public function getProductById($id)
    {
        return Producto::find($id);
    }

    /**
     * Guardar producto (Legacy: guardarProducto)
     */
    public function createProduct(array $data)
    {
        return Producto::create($data);
    }

    /**
     * Obtener todos los accesorios (Legacy: obtenerAccesorios)
     */
    public function getAllAccessories()
    {
        return Accesorio::all();
    }

    /**
     * Obtener accesorio por MD5 (Legacy: obtenerAccesoriosID)
     */
    public function getAccessoryByMd5($idMd5)
    {
        return Accesorio::whereRaw('md5(id_accesorio) = ?', [$idMd5])->first();
    }

    /**
     * Guardar accesorio (Legacy: guardarAccesorio)
     */
    public function createAccessory(array $data)
    {
        return Accesorio::create($data);
    }
}
