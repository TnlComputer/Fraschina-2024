<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionLineaTareas extends Model
{
  use HasFactory;

  protected $table = 'distribucion_linea_tareas';

  protected $guarded = [];

  public function distribucionNropedido()
  {
    return $this->belongsTo(DistribucionNroPedidos::class, 'id');
  }
}
