<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agro extends Model
{
  use HasFactory;

  protected $table = 'agros';

  protected $guarded = [];
}
