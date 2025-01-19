<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentacionAuxProductos extends Model
{
  use HasFactory;

  protected $table = 'representacion_aux_productos';
  
  protected $guarded = [];

  public function productos()
  {
    return $this->hasMany(RepresentacionProducto::class, 'producto_id');
  }
}