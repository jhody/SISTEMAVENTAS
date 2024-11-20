<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'medio_pago';

    // Clave primaria
    protected $primaryKey = 'id';

    // Indica que la clave primaria es autoincremental
    public $incrementing = true;

    // Indica el tipo de clave primaria
    protected $keyType = 'int';

    // Indica si las marcas de tiempo (created_at, updated_at) están habilitadas
    public $timestamps = false;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'fechareg',
        'estado',
    ];

    // Los atributos que deben ser tratados como fechas
    protected $casts = [
        'fechareg' => 'datetime',
        'estado' => 'boolean',
    ];
}
