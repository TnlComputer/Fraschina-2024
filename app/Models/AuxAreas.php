<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Prompts\Table;
use tidy;

class AuxAreas extends Model
{
  use HasFactory;

  protected $table = 'auxareas';

  protected $guarded = [];
}
