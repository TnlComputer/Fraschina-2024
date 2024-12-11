<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productoCDA extends Model
{
  use HasFactory;

  protected $table = 'productos_c_d_a';

  protected $guarded = [];
}
