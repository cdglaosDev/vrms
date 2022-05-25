<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['name', 'name_en', 'remark', 'status'];
}
