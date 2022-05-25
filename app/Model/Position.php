<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  protected $fillable=['name', 'name_en', 'status'];
}
