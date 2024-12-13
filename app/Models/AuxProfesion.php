<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxProfesion extends Model
{
  use HasFactory;

  protected $table = 'auxprofesiones';

  protected $fillable = [
    'nombreprofesion',
    'representaciones',
    'distribuciones',
    'molinos',
    'proveedores',
    'agros',
    'transportes',
    'agendas'
  ];

  public function agendas()
  {
    return $this->hasMany(AgendaGral::class, 'cod_prof');
  }
}
