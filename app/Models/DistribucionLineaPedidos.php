<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionLineaPedidos extends Model
{
  use HasFactory;

  protected $table = 'distribucion_linea_pedidon';

  protected $guarded = [];

  public function distribucion()
  {
    return $this->belongsTo(DistribucionNroPedidos::class, 'id');
  }
}
