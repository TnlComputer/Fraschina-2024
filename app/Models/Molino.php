<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Molino extends Model
{
  use HasFactory;

  protected $table = 'molinos';

  protected $guarded = [];
}