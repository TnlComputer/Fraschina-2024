<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expedicion extends Model
{
  use HasFactory;

  protected $table = 'expedicions';

  protected $guarded = [];
}
