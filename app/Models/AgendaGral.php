<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaGral extends Model
{
  use HasFactory;

  protected $table = 'agendageneral';

  protected $guarded = [];
}