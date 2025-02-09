<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionLineaTareas extends Model
{
  use HasFactory;

  protected $table = 'distribucion_linea_tareas';

  protected $guarded = [];

  // Relación: una línea de tarea pertenece a una tarea
  public function tarea()
  {
    return $this->belongsTo(DistribucionTareas::class, 'tarea_id');
  }
  public function distribucionNropedido()
  {
    return $this->belongsTo(DistribucionNroPedidos::class, 'id');
  }
}