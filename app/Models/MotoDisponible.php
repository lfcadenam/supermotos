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
}
