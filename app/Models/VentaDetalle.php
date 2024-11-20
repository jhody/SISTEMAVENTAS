<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'venta_detalle';

    // Llave primaria
    protected $primaryKey = 'id';

    // Indica si la llave primaria es autoincremental
    public $incrementing = true;

    // Tipo de datos de la llave primaria
    protected $keyType = 'int';

    // Deshabilitar timestamps
    public $timestamps = false;

    // Columnas asignables en masa
    protected $fillable = [
        'idventa',
        'idproducto',
        'cantidad',
        'precio',
    ];

    // Relaciones (si aplica)
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idventa', 'id');
    }
}
