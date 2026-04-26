<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    protected $table = 'carrito_productos';
    protected $primaryKey = 'id_carrito';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'cantidad',
        'carrito_ref',
        'usuario',
        'estado',
        'fch_registro',
        'nombre_cli',
        'direccion_cli',
        'ciudad_cli',
        'telefono_cli',
        'correo_cli',
        'numeros'
    ];
}
