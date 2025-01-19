<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorAuxProductos extends Model
{
  use HasFactory;

  protected $table = 'proveedor_aux_productos';

  protected $guarded = [];

  public function productos()
  {
    return $this->hasMany(ProveedorProducto::class, 'producto_id');
  }
}