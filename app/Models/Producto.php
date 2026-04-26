<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_p'; // Usualmente id_p en este sistema
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad_p',
        'fotos',
        'cant_min',
        'estado'
    ];
}
