<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionNroPedidos extends Model
{
  use HasFactory;
  protected $table = 'distribucion_nropedidos';

  protected $guarded = [];

  // public function distribucionLineaPedido()
  // {
  //   return $this->belongsTo(DistribucionLineaPedidos::class, 'pedido_nro', 'id');
  // }
}