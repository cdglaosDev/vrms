<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Division extends Model
{
        use SoftDeletes;
     protected $fillable=['name', 'name_en', 'status'];
}
