<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion_Producto extends Model
{
  use HasFactory;

  protected $table = 'distribucion_productos';

  protected $fillable = [
    'distribucion_id',
    'producto_id',
    'precio',
    'fecha',
    'nomproducto',
    'fechaUEnt',
    'status',
  ];
}
