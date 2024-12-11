<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgroProducto extends Model
{
  use HasFactory;

  protected $table = 'agro_productos';

  protected $guarded = [];
}
