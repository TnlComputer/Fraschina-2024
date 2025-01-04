<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Representacion extends Model
{
  use HasFactory;

  protected $table = 'representacions';

  protected $fillable = [
    'razonsocial',
    'dire_calle',
    'dire_nro',
    'piso',
    'codpost',
    'dire_obs',
    'barrio_id',
    'localidad_id',
    'zona_id',
    'municipio_id',
    'telefono',
    'fax',
    'cuit',
    'excenciones',
    'marcas',
    'info',
    'contacto',
    'horario',
    'objetivos',
    'comentarios',
    'correo',
    'dpto',
    'status'
  ];

  public function barrio()
  {
    return $this->belongsTo(AuxBarrios::class);
  }

  public function localidad()
  {
    return $this->belongsTo(AuxLocalidades::class);
  }

  public function zona()
  {
    return $this->belongsTo(AuxZonas::class);
  }

  public function municipio()
  {
    return $this->belongsTo(AuxMunicipios::class);
  }

  public function personal()
  {
    return $this->hasMany(representacion_personal::class);
  }

  public function productos()
  {
    return $this->hasMany(Representacion_Producto::class, 'representacion_id');
  }
}