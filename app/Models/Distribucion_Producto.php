<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion_Producto extends Model
{
  use HasFactory;

  protected $table = 'distribucion_productos';

  protected $fillable = ['producto_id', 'precio', 'fecha', 'fechaUEnt', 'status', 'distribucion_id'];

  public function producto()
  {
    return $this->belongsTo(ProductoCDA::class, 'producto_id');
  }

  public function distribucion()
  {
    return $this->belongsTo(Distribucion::class, 'distribucion_id');
  }
}
