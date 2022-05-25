<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InspectPlace extends Model
{
    protected $table = "inspect_places";
    protected $fillable = ['name', 'name_en', 'status'];
}
