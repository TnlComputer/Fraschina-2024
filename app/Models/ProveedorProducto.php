<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorProducto extends Model
{
  use HasFactory;

  protected $table = 'proveedor_productos';

  protected $guarded = [];

  public function producto()
  {
    return $this->belongsTo(ProveedorAuxProductos::class, 'producto_id');
  }

  public function proveedor()
  {
    return $this->belongsTo(Proveedor::class, 'proveedor_id');
  }
}