<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $fillable = ['name', 'name_en', 'status'];
}
