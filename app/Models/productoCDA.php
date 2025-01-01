<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productoCDA extends Model
{
  use HasFactory;

  protected $table = 'productos_c_d_a';

  protected $fillable = [
    'productoCDA',
    'ivancda',
    'ivacda',
    'stockmincda',
    'stockmaxcda',
    'stockcda',
    'stockreservacda',
    'stockdisponiblecda',
    'stockfecentcda',
    'cantultent',
    'status',
  ];

  // Relación inversa con Distribucion_Producto
  public function distribuciones()
  {
    return $this->hasMany(Distribucion_Producto::class, 'producto_id');
  }
}
