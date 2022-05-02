<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\facturasDetalle;

class factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'nitVendedor',
        'nombreVendedor',
        'nitComprador',
        'nombreComprador',
        'price',
        'iva',
        'total',
        'estado',
    ];

    public function detalle()
    {
        return $this->hasMany(facturasDetalle::class);
    }
}
