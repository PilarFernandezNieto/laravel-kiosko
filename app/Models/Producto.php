<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'imagen',
        'precio',
        'disponible',
        'categoria_id'
    ];
}
