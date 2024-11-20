<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla en la base de datos
    protected $table = 'cliente';

    // Deshabilitar la gestión automática de timestamps (fechas created_at y updated_at)
    public $timestamps = false;

    // Definir la clave primaria si no es "id"
    protected $primaryKey = 'id';

    // Especificar que el ID es un autoincremental y no necesita ser asignado
    protected $keyType = 'int';

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = [
        'razonsocial',
        'ruc',
        'domicilio',
        'persona',
        'contacto',
        'correo',
        'estado',
        'fechareg'
    ];

    // Si la tabla usa otro tipo de colación o codificación, puedes especificar la conexión de base de datos aquí.
    protected $connection = 'mysql'; // o el nombre de tu conexión si es diferente
}
