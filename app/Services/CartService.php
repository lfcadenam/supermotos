<?php

namespace App\Services;

use App\Models\CarritoProducto;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Obtener productos en el carrito (Legacy: obtenerProductosEnCarrito)
     */
    public function getItemsInCart()
    {
        return DB::table('productos')
            ->join('carrito_productos', DB::raw('md5(productos.id)'), '=', 'carrito_productos.id_producto')
            ->select('carrito_productos.id_carrito', 'productos.nombre', 'productos.descripcion', 'productos.precio', 'carrito_productos.cantidad')
            ->where('carrito_productos.estado', 0)
            ->get();
    }

    /**
     * Agregar producto al carrito (Legacy: agregarProductoAlCarrito)
     */
    public function addProduct($idProductoMd5, $cantidad, $referenceCode, $usuario)
    {
        return CarritoProducto::create([
            'id_producto' => $idProductoMd5,
            'cantidad' => $cantidad,
            'carrito_ref' => $referenceCode,
            'usuario' => $usuario,
            'estado' => 0
        ]);
    }

    /**
     * Actualizar datos del cliente en el carrito (Legacy: datosCarrito)
     */
    public function updateCustomerInfo($idCarrito, array $data)
    {
        return CarritoProducto::where('id_carrito', $idCarrito)->update([
            'nombre_cli' => $data['nombre'],
            'direccion_cli' => $data['direccion'],
            'ciudad_cli' => $data['ciudad'],
            'telefono_cli' => $data['telefono'],
            'correo_cli' => $data['correo']
        ]);
    }

    /**
     * Cambiar estado del producto en el carrito (Legacy: quitarProductoDelCarrito)
     */
    public function updateStatus($idCarrito, $estado)
    {
        return CarritoProducto::where('id_carrito', $idCarrito)->update(['estado' => $estado]);
    }
}
