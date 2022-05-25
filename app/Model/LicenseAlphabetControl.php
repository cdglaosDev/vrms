<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class LicenseAlphabetControl extends Model
{
    protected $table = "license_alphabet_controls";
    protected $fillable =["province_code", "vehicle_type_group_id", "license_alphabet_id","license_alphabet_control_status_id","status","created_by", "license_alphabet_next_id", "vehicle_kind_code"];

    public function province()
    {
        return $this->belongsTo("\App\Model\Province", 'province_code', 'province_code')->withDefault();
    }
    public function vehicleTypeGroup()
    {
        return $this->belongsTo("\App\Model\VehicleTypeGroup", "vehicle_type_group_id")->withDefault();
    }
    public function vehicleKind()
    {
        return $this->belongsTo("\App\Model\VehicleKind", "vehicle_kind_code", "vehicle_kind_code")->withDefault();
    }

    public function licAlphabet()
    {
        return $this->belongsTo("\App\Model\LicenseAlphabet", 'license_alphabet_id')->withDefault();
    }
    public function licAlphabetNext()
    {
        return $this->belongsTo("\App\Model\LicenseAlphabet", 'license_alphabet_next_id')->withDefault();
    }
    public function licAlphaControlStatus()
    {
        return $this->belongsTo("\App\Model\LicenseAlphabetControlStatus", "license_alphabet_control_status_id")->withDefault();
    }

    public function scopeAlphabetControl()
    {
        return  $this->whereNotNull('license_alphabet_id')->pluck('license_alphabet_id');
    }
}
