<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    protected $table = 'parametros';
    protected $primaryKey = 'id_parametro';

    protected $fillable = [
        'descripcion',
        'valor',
        'clave'
    ];
}
