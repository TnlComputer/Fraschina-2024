<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedicionCliente extends Model
{
  use HasFactory;

  protected $table = 'expedicion_clientes';

  protected $guarded = [];
}