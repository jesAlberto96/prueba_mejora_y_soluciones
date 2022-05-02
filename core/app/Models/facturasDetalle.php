<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\producto;

class facturasDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'observaciones',
    ];

    public function producto()
    {
        return $this->hasMany(producto::class, 'id', 'producto_id');
    }
}
