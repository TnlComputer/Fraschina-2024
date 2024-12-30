<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
  use HasFactory;

  protected $table = 'distribucions';

  protected $fillable = [
    'clisg_id',
    'razonsocial',
    'nomfantasia',
    'dire_calle_id',
    'dire_nro',
    'piso',
    'dpto',
    'codpost',
    'dire_obs',
    'barrio_id',
    'municipio_id',
    'localidad_id',
    'zona_id',
    'telefono',
    'cuit',
    'correo',
    'marcas',
    'info',
    'rubro_id',
    'tamanio_id',
    'modo_id',
    'contacto_id',
    'auto',
    'veraz_id',
    'estado_id',
    'productoCDA',
    'desde',
    'hasta',
    'desde1',
    'hasta1',
    'lunes',
    'sabado',
    'fac_imp',
    'obsrecep',
    'cobrar_id',
    'cobro_id',
    'tcobro_id',
    'status'
  ];
}
