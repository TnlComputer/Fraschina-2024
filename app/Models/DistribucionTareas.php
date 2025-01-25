<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionTareas extends Model
{
  use HasFactory;

  protected $table = 'distribucion_tareas';

  protected $fillable = [
    'tarea',
    'status'
  ];

  // Relación: una tarea tiene muchas líneas de tarea
  public function tarea()
  {
    return $this->hasMany(DistribucionLineaTareas::class, 'tarea_id', 'id');
  }
}
