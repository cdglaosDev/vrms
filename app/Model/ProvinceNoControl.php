<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GeneralEnum;
class ProvinceNoControl extends Model
{
    use GeneralEnum;
    protected $fillable = ['province_code', 'province_no_start', 'present_province_no', 'status', 'create_by'];

    public static $generalenum = [
        "status" => ["uses" => "Uses", "not uses" => "Not Uses", "availables" => "Available"]
    ];

    public function province()
    {
    return $this->belongsTo('\App\Model\Province', 'province_code', "province_code");
    }
   

   
}
