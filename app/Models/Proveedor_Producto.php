<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor_Producto extends Model
{
  use HasFactory;

  protected $table = 'proveedor_productos';

  protected $guarded = [];
}
