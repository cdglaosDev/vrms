<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenseNoControl extends Model
{
    protected $fillable = ["province_code", "vehicle_type_id", "license_alphabet_id", "license_alphabet_control_status_id", "status", "create_by", "update_by"]
}
