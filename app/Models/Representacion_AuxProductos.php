<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacion_AuxProductos extends Model
{
  use HasFactory;

  protected $table = 'representacion_aux_productos';
  
  protected $guarded = [];

  public function productos()
  {
    return $this->hasMany(Representacion_Producto::class, 'producto_id');
  }
}