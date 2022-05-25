<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LicenseAlphabetControlStatus extends Model
{
    protected $fillable = ["name", "name_en", "status", "created_by"];
}
