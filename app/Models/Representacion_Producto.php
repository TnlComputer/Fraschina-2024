<?php

namespace App\Models;

use App\Http\Controllers\RepresentacionAuxProductosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacion_Producto extends Model
{
  use HasFactory;

  protected $table = 'representacion_productos';

  protected $guarded = [];

  public function producto()
  {
    return $this->belongsTo(Representacion_AuxProductos::class);
  }
}