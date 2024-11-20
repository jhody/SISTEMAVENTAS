<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    /**
     * Nombre de la tabla en la base de datos
     */
    protected $table = 'usuario';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'username',
        'password',
        'perfil',
        'nombre', // asumiendo que el nombre está en esta columna
        'activo',
        'ultimo_acceso',
        'ultimo_logout',
        'fecha'
        // otros campos que puedas tener
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtener el nombre para mostrar del usuario
     */
    public function getNameAttribute()
    {
        return $this->nombre ?? $this->username;
    }
}
