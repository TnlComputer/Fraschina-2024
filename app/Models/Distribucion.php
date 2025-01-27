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

  public function auxCalles()
  {
    return $this->belongsTo(AuxCalles::class, 'dire_calle_id', 'id');
  }

  public function distribucionLineaPedidos()
  {
    return $this->hasMany(DistribucionLineaPedidos::class, 'distribucion_id');
  }

  public function personal()
  {
    return $this->hasMany(DistribucionPersonal::class, 'distribucion_id');
  }

  public function auxcontacto()
  {
    return $this->belongsTo(AuxContacto::class, 'contacto_id');
  }

  public function auxveraz()
  {
    return $this->belongsTo(AuxVeraz::class, 'veraz_id');
  }

  public function auxrubro()
  {
    return $this->belongsTo(AuxRubros::class, 'rubro_id');
  }

  public function auxestado()
  {
    return $this->belongsTo(AuxEstados::class, 'estado_id');
  }


  public function auxtamanio()
  {
    return $this->belongsTo(AuxTamanios::class, 'tamanio_id');
  }
  public function auxmodo()
  {
    return $this->belongsTo(AuxModos::class, 'modo_id');
  }

  public function auxlocalidad()
  {
    return $this->belongsTo(AuxLocalidades::class, 'localidad_id');
  }

  public function auxmunicipio()
  {
    return $this->belongsTo(AuxMunicipios::class, 'municipio_id');
  }

  public function auxbarrio()
  {
    return $this->belongsTo(AuxBarrios::class, 'barrio_id');
  }

  public function auxzona()
  {
    return $this->belongsTo(AuxZonas::class, 'zona_id');
  }


  public function auxpago()
  {
    return $this->belongsTo(AuxPagos::class, 'cobro_id');
  }

  public function auxcobro()
  {
    return $this->belongsTo(AuxCobrar::class, 'cobrar_id');
  }

  public function auxtcobro()
  {
    return $this->belongsTo(AuxTipoPagos::class, 'tcobro_id');
  }
}
