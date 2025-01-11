<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionNroPedidos extends Model
{
  use HasFactory;
  protected $table = 'distribucion_nropedidos';

  protected $guarded = [];

  public function lineasPedidos()
  {
    return $this->hasMany(DistribucionLineaPedidos::class, 'pedido_id');
  }

  public function lineasTareas()
  {
    return $this->hasMany(DistribucionLineaTareas::class, 'pedido_id');
  }
  public function distribucion()
  {
    return $this->belongsTo(Distribucion::class, 'distribucion_id');  // Relación con la tabla distribucions
  }
}
