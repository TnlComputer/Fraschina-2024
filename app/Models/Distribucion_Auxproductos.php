<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion_Auxproductos extends Model
{
  use HasFactory;

  protected $table = 'distribuicion_aux_productos';

  protected $guarded = [];
  public function productos()
  {
    return $this->hasMany(Distribucion_Producto::class, 'producto_id');
  }
}
