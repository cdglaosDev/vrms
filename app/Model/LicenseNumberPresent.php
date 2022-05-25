<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneralEnum;
class LicenseNumberPresent extends Model
{
    use GeneralEnum;
    protected $table="license_no_presents";
    protected $fillable = ["province_code","vehicle_type_group_id","license_alphabet_id","license_no_present_number","status","created_by", "vehicle_kind_code", "alert_license_present", "alert_at"];

    public static $generalenum = [
        "status" => ["uses" => "Uses", "not uses" => "Not Uses", "availables" => "Available"]
        ];

    public function province()
    {
        return $this->belongsTo("\App\Model\Province", 'province_code', 'province_code')->withDefault();
    }
    public function vehicleTypeGroup()
    {
        return $this->belongsTo("\App\Model\VehicleTypeGroup", 'vehicle_type_group_id')->withDefault();
    }
    public function licenseAlphabet()
    {
        return $this->belongsTo("\App\Model\LicenseAlphabet", 'license_alphabet_id')->withDefault();
    }
    public function vehicleKind()
    {
        return $this->belongsTo("\App\Model\VehicleKind", 'vehicle_kind_code', 'vehicle_kind_code')->withDefault();
    }
}
