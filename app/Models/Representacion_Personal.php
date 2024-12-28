<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacion_Personal extends Model
{
  use HasFactory;

  protected $table = 'representacion_personal';
  
  protected $guarded = [];

  public function representacion()
  {
    return $this->belongsTo(Representacion::class, 'representacion_id');
  }

  public function area()
  {
    return $this->belongsTo(AuxAreas::class, 'area_id');
  }

  public function cargo()
  {
    return $this->belongsTo(AuxCargos::class, 'cargo_id');
  }

  // public function categoriaCargo()
  // {
  //   return $this->belongsTo(AuxCargos::class, 'categoria_id');
  // }

  public function profesion()
  {
    return $this->belongsTo(AuxProfesion::class, 'profesion_id');
  }
}