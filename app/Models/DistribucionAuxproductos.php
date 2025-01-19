<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionAuxproductos extends Model
{
  use HasFactory;

  protected $table = 'distribuicion_aux_productos';

  protected $guarded = [];
  public function productos()
  {
    return $this->hasMany(DistribucionProducto::class, 'producto_id');
  }
}