<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'producto';

    // Llave primaria
    protected $primaryKey = 'id';

    // Campos que pueden ser asignados de forma masiva
    protected $fillable = [
        'codigo',
        'nombre',
        'id_categoria',
        'stock',
        'idunidad_medida',
        'precio_compra',
        'precio_venta',
        'estado',
        'fechareg',
    ];

    // Desactivar timestamps automáticos si no usas las columnas created_at y updated_at
    public $timestamps = false;

    // Tipos de datos de los atributos
    protected $casts = [
        'peso' => 'float',
        'precio' => 'float',
        'estado' => 'boolean',
        'fechareg' => 'datetime',
    ];

    // Relación con la unidad de medida (asumiendo una relación con otra tabla)
    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class, 'idunidad_medida');
    }
}
