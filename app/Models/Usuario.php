<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'usuario',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Laravel ya usa 'password' por defecto, pero nos aseguramos.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
