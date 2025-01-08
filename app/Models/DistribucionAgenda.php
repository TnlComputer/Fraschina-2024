<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionAgenda extends Model
{
  use HasFactory;

  protected $table = 'distribucion_agenda';

  protected $fillable = [
    'distribucion_id',
    'fecha',
    'hs',
    'prioridad_id',
    'accion_id',
    'persona_id',
    'cotizacion',
    'temas',
    'status',
  ];

  // Relación con la tabla de prioridades (auxprioridades)
  public function auxprioridades()
  {
    return $this->belongsTo(AuxPrioridades::class, 'prioridad_id', 'id');
  }

  // Relación con la tabla de acciones (auxacciones)
  public function auxacciones()
  {
    return $this->belongsTo(AuxAcciones::class, 'accion_id', 'id');
  }

  // Relación con la distribución
  public function distribucion()
  {
    return $this->belongsTo(Distribucion::class, 'distribucion_id', 'id');
  }

  // Relación con productos CDA
  public function productocda()
  {
    return $this->belongsTo(ProductoCDA::class, 'producto_id', 'id');
  }

  // Relación con el personal de distribución
  public function distribucionPersonal()
  {
    return $this->belongsTo(Distribucion_Personal::class, 'persona_id', 'id');
  }

  // Otros métodos de relación con tablas auxiliares
  // public function auxtipoPersonal()
  // {
  //   return $this->belongsTo(AuxTipoPersonal::class, 'tipoper_id', 'id');
  // }

  // public function auxveraz()
  // {
  //   return $this->belongsTo(AuxVeraz::class, 'veraz_id', 'id');
  // }

  // public function auxestados()
  // {
  //   return $this->belongsTo(AuxEstados::class, 'estado_id', 'id');
  // }

  // public function auxcontacto()
  // {
  //   return $this->belongsTo(AuxContacto::class, 'contacto_id', 'id');
  // }

  // public function auxcargos()
  // {
  //   return $this->belongsTo(AuxCargos::class, 'cargo_id', 'id');
  // }

  // public function auxbarrios()
  // {
  //   return $this->belongsTo(AuxBarrios::class, 'barrio_id', 'id');
  // }

  // public function auxmunicipios()
  // {
  //   return $this->belongsTo(AuxMunicipios::class, 'municipio_id', 'id');
  // }

  // public function auxlocalidades()
  // {
  //   return $this->belongsTo(AuxLocalidades::class, 'localidad_id', 'id');
  // }

  // public function auxzonas()
  // {
  //   return $this->belongsTo(AuxZonas::class, 'zona_id', 'id');
  // }

  // public function auxrubros()
  // {
  //   return $this->belongsTo(AuxRubros::class, 'rubro_id', 'id');
  // }

  // public function auxtamanios()
  // {
  //   return $this->belongsTo(AuxTamanios::class, 'tamanio_id', 'id');
  // }

  // public function auxmodos()
  // {
  //   return $this->belongsTo(AuxModos::class, 'modo_id', 'id');
  // }

  public function distribucionNropedidos()
  {
    return $this->belongsTo(DistribucionNropedidos::class, 'pedido_id', 'id');
  }
}