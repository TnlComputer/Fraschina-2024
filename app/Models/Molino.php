<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Molino extends Model
{
  use HasFactory;

  protected $table = 'molinos';

  protected $fillable = [
    'razonsocial',
    'dire_calle',
    'dire_nro',
    'piso',
    'dpto',
    'dire_obs',
    'codpost',
    'localidad_id',
    'telefono',
    'municipio_id',
    'fax',
    'cuit',
    'info',
    'correo',
    'marcas',
    'barrio_id',
    'status'
  ];
}