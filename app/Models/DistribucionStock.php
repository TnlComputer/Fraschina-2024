<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribucionStock extends Model
{
  use HasFactory;

  protected $table = 'distribucion_stock';

  protected $guarded = [];
}
