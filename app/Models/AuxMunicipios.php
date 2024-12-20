<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuxMunicipios extends Model
{
  use HasFactory;

  protected $table = 'auxmunicipios';

  protected $guarded = [];
  
  public function representacions()
  {
    return $this->hasMany(Representacion::class);
  }
}