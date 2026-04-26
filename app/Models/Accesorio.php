<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $table = 'accesorios';
    protected $primaryKey = 'id_accesorio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_acc',
        'descripcion',
        'valor',
        'fotos'
    ];
}
