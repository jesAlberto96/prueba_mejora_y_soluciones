<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\facturasDetalle;

class producto extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->hasMany(facturasDetalle::class, 'producto_id', 'id');
    }
}
