<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'tipodoc',
        'serie',
        'numero',
        'idcliente',
        'fecha',
        'idmediopago',
        'observaciones',
        'total',
        'estado',
        'fechareg',
    ];

    protected $casts = [
        'fecha' => 'date',
        'fechareg' => 'datetime',
        'total' => 'float',
        'estado' => 'int',
        'tipodoc' => 'int',
    ];
}
