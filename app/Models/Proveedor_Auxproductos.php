<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_AuxProductos extends Model
{
  use HasFactory;

  protected $table = 'proveedor_aux_productos';

  protected $guarded = [];

  public function productos()
  {
    return $this->hasMany(Proveedor_Producto::class, 'producto_id');
  }
}