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

    public function getNombreAttribute(): ?string
    {
        return $this->attributes['nombre_acc'] ?? null;
    }

    public function getFotoAttribute(): ?string
    {
        return $this->attributes['fotos'] ?? null;
    }

    public function photoUrl(): string
    {
        if (empty($this->foto)) {
            return asset('img/no-image.png');
        }

        return asset('fotos_motos/' . $this->foto);
    }
}
