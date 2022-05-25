<?php

namespace App\Model;

use DB;
use Carbon\Carbon;
use App\Traits\LicenceNo;
use App\Traits\GeneralEnum;
use App\Traits\DivisionControl;
use App\Traits\ProvinceControl;
use App\Traits\SaveVehicleHistory;
use App\Traits\LicenseNoHistoryTrait;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use DivisionControl, ProvinceControl, LicenceNo, GeneralEnum, SaveVehicleHistory, LicenseNoHistoryTrait;
    protected $guarded = [];
    public static $generalenum = [
        "inspect_result" => ["pass" => "Pass", "not_pass" => "Not Pass", "none" => "None"]
    ];


    public function wasChanged($attributes = null)
    {
        return $this->hasChanges(
            $this->getChanges(),
            is_array($attributes) ? $attributes : func_get_args()
        );
    }

    public function vbrand()
    {
        return $this->belongsTo('\App\Model\VehicleBrand', 'brand_id')->withDefault();
    }

    public function illegalTrafic()
    {
        return $this->hasOne('\App\Model\IllegalTraffic')->withDefault();
    }

    public function moter_brand()
    {
        return $this->belongsTo('\App\Model\EngineBrand', 'motor_brand_id')->withDefault();
    }

    public function vmodel()
    {
        return $this->belongsTo('\App\Model\VehicleModel', 'model_id')->withDefault();
    }

    public function province()
    {
        return $this->belongsTo('\App\Model\Province', 'province_code', 'province_code')->withDefault();
    }

    public function district()
    {
        return $this->belongsTo('\App\Model\District', 'district_code', 'district_code')->withDefault();
    }

    public function vtype()
    {
        return $this->belongsTo('\App\Model\VehicleType', 'vehicle_type_id')->withDefault();
    }

    public function standard()
    {
        return $this->belongsTo('\App\Model\Standard', 'standard_id')->withDefault();
    }

    public function steering()
    {
        return $this->belongsTo('\App\Model\Steering', 'steering_id')->withDefault();
    }
    public function gas()
    {
        return $this->belongsTo('\App\Model\Gas', 'gas_id')->withDefault();
    }

    public function purpose()
    {
        return $this->belongsTo('\App\Model\VehiclePurpose', 'vehicle_purpose_id')->withDefault();
    }

    public function vehicle_kind()
    {
        return $this->belongsTo('\App\Model\VehicleKind', 'vehicle_kind_code', 'vehicle_kind_code')->withDefault();
    }

    public function currency()
    {
        return $this->belongsTo('\App\Model\MoneyUnit', 'money_unit_id');
    }

    public function inspection()
    {
        return $this->hasMany('\App\Model\VehicleInspection');
    }
    public function storedocument()
    {
        return $this->hasMany('\App\Model\StoreDocument');
    }

    public function licensehistory()
    {
        return $this->hasMany('App\Model\LicenseNoHistory');
    }

    public function veh_doc()
    {
        return $this->hasMany('App\Model\VehicleDocument', 'vehicle_id');
    }

    public function app_form()
    {
        return $this->hasOne('App\Model\AppForm', 'vehicle_id')->withDefault();
    }
    public function color()
    {
        return $this->belongsTo("App\Model\Color", 'color_id');
    }
    public function engine_type()
    {
        return $this->belongsTo("App\Model\EngineType", 'engine_type_id');
    }

    public function vehicleTenant()
    {
        return $this->hasOne("\App\Model\VehicleTenant", 'vehicle_id')->withDefault();
    }

    public function printLog($value)
    {
        return \App\Model\PrintLog::whereVehicleId($value)->sum('print_log_count');
    }

    public function inspectPlace()
    {
        return $this->belongsTo("App\Model\InspectPlace");
    }

    public function print_log()
    {
        return $this->hasMany('App\Model\PrintLog')->orderBy('print_log_datetime', 'desc');;
    }

    public static function searchVehicle()
    {

        $license_no = request('license_no');
        $general = request('general');
        $province_name = request('province_name');
        $village_name = request('village_name');
        $owner_name = request('owner_name');
        $vehicle_kind_code = request('vehicle_kind_code');
        $issue_date = request('issue_date');
        $sortBy = empty(request('sortBy')) ? 'id' : request('sortBy');

        $vehicle_type_name = request('vehicle_type_name');
        $brand_name = request('brand_name');
        $model_name = request('model_name');
        $engine_no = request('engine_no');
        $chassis_no = request('chassis_no');
        $color_name = request('color_name');
        $cc = request('cc');
        $year_manufactured = request('year_manufactured');
        $import_permit_no = request('import_permit_no');
        $industrial_doc_no = request('industrial_doc_no');
        $technical_doc_no = request('technical_doc_no');
        $commerce_permit_no = request('commerce_permit_no');

        $sql_query = "SELECT vehicles.*, vehicle_kinds.name as vehicle_kind_name, vehicle_brands.name as brand_name
        , vehicle_models.name as model_name, colors.name as color_name, districts.name as district_name
        , provinces.name as province_name FROM vehicles 
        LEFT JOIN provinces ON vehicles.province_code = provinces.province_code 
        LEFT JOIN vehicle_types ON vehicles.vehicle_type_id = vehicle_types.id
        LEFT JOIN vehicle_brands ON vehicles.brand_id = vehicle_brands.id
        LEFT JOIN vehicle_models ON vehicles.model_id = vehicle_models.id
        LEFT JOIN colors ON vehicles.color_id = colors.id
        LEFT JOIN vehicle_kinds ON vehicles.vehicle_kind_code = vehicle_kinds.vehicle_kind_code
        LEFT JOIN districts ON vehicles.district_code = districts.district_code WHERE ";
        if (!empty($license_no)) {
            $sql_query = $sql_query . "vehicles.licence_no like '%" . "$license_no" . "%' AND ";
        }
        if (!empty($province_name)) {
            $sql_query = $sql_query . "provinces.name like '%" . "$province_name" . "%' AND ";
        }
        if (!empty($village_name)) {
            $sql_query = $sql_query . "vehicles.village_name like '%" . "$village_name" . "%' AND ";
        }
        if (!empty($owner_name)) {
            $sql_query = $sql_query . "vehicles.owner_name like '%" . "$owner_name" . "%' AND ";
        }
        if (!empty($vehicle_kind_code)) {
            $sql_query = $sql_query . "vehicles.vehicle_kind_code like '%" . "$vehicle_kind_code" . "%' AND ";
        }
        if (!empty($issue_date)) {
            $sql_query = $sql_query . "vehicles.issue_date like '%" . "$issue_date" . "%' AND ";
        }
        if (!empty($vehicle_type_name)) {
            $sql_query = $sql_query . "vehicle_types.name like '%" . "$vehicle_type_name" . "%' AND ";
        }
        if (!empty($brand_name)) {
            $sql_query = $sql_query . "vehicle_brands.name like '%" . "$brand_name" . "%' AND ";
        }
        if (!empty($model_name)) {
            $sql_query = $sql_query . "vehicle_models.name like '%" . "$model_name" . "%' AND ";
        }
        if (!empty($engine_no)) {
            $sql_query = $sql_query . "vehicles.engine_no like '%" . "$engine_no" . "%' AND ";
        }
        if (!empty($chassis_no)) {
            $sql_query = $sql_query . "vehicles.chassis_no like '%" . "$chassis_no" . "%' AND ";
        }
        if (!empty($color_name)) {
            $sql_query = $sql_query . "colors.name like '%" . "$color_name" . "%' AND ";
        }
        if (!empty($cc)) {
            $sql_query = $sql_query . "vehicles.cc like '%" . "$cc" . "%' AND ";
        }
        if (!empty($year_manufactured)) {
            $sql_query = $sql_query . "vehicles.year_manufacture like '%" . "$year_manufactured" . "%' AND ";
        }
        if (!empty($import_permit_no)) {
            $sql_query = $sql_query . "vehicles.import_permit_no like '%" . "$import_permit_no" . "%' AND ";
        }
        if (!empty($industrial_doc_no)) {
            $sql_query = $sql_query . "vehicles.industrial_doc_no like '%" . "$industrial_doc_no" . "%' AND ";
        }
        if (!empty($technical_doc_no)) {
            $sql_query = $sql_query . "vehicles.technical_doc_no like '%" . "$technical_doc_no" . "%' AND ";
        }
        if (!empty($commerce_permit_no)) {
            $sql_query = $sql_query . "vehicles.comerce_permit_no like '%" . "$commerce_permit_no" . "%' AND ";
        }
        $sql_query = trim($sql_query, " WHERE "); //Sometime maybe all search conditions are blank. 
        $sql_query = trim($sql_query, " AND ") . " ORDER BY " . $sortBy . " ASC";
        //dd($sql_query);
        return  DB::select($sql_query);
    }

    public function setIssueDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }

        $this->attributes['issue_date'] = $d_value;
    }
    public function getIssueDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }

    public function setExpireDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }

        $this->attributes['expire_date'] = $d_value;
    }
    public function getExpireDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }

    public function setTaxDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }

        $this->attributes['tax_date'] = $d_value;
    }
    public function getTaxDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setImportPermitDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['import_permit_date'] = $d_value;
    }
    public function getImportPermitDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setIndustrialDocDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['industrial_doc_date'] = $d_value;
    }
    public function getIndustrialDocDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setTechnicalDocDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['technical_doc_date'] = $d_value;
    }
    public function getTechnicalDocDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setComercePermitDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['comerce_permit_date'] = $d_value;
    }
    public function getComercePermitDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setTaxPaymentDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['tax_payment_date'] = $d_value;
    }
    public function getTaxPaymentDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
    public function setPoliceDocDateAttribute($value)
    {
        $d_value = null;
        if(isset($value)){
            if ($value == "0000-00-00") {
                $d_value = $value;
            } else {
                $d_value = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        }
        $this->attributes['police_doc_date'] = $d_value;
    }
    public function getPoliceDocDateAttribute($value)
    {
        if (isset($value)) {
            if ($value == "0000-00-00") {
                return $value;
            } else {
                return Carbon::parse($value)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }


    public static function getLicenseOnly()
    {
        $license_no = \App\Model\Vehicle::whereNotNull('licence_no')->pluck('licence_no');
        return $license_no->map(function ($item, $key) {
            return preg_replace('/\s+/', '', $item);
        });
    }
    // check engine no for new modal form
    public static function getEngine()
    {
        return  \App\Model\Vehicle::whereNotNull('engine_no')->where([['engine_no', '!=', "-"], ['engine_no', '!=', "0"]])->pluck('engine_no');
    }
    // check chassis no for new modal form
    public static function getChassis()
    {
        return  \App\Model\Vehicle::whereNotNull('chassis_no')->where([['chassis_no', '!=', "-"], ['chassis_no', '!=', "0"]])->pluck('chassis_no');
    }

    // check engine no for edit modal form
    public static function getEngineNotCurrent($current_vehicle_id)
    {
        return  \App\Model\Vehicle::whereNotNull('engine_no')->where([['engine_no', '!=', "-"], ['engine_no', '!=', "0"], ['id', '!=', $current_vehicle_id]])->pluck('engine_no');
    }
    // check chassis no for edit modal form
    public static function getChassisNotCurrent($current_vehicle_id)
    {
        return  \App\Model\Vehicle::whereNotNull('chassis_no')->where([['chassis_no', '!=', "-"], ['chassis_no', '!=', "0"], ['id', '!=', $current_vehicle_id]])->pluck('chassis_no');
    }
    public static function getLicenseNotCurrent($current_vehicle_id)
    {
        $license_no = \App\Model\Vehicle::whereNotNull('licence_no')->where([['id', '!=', $current_vehicle_id]])->pluck('licence_no');
        return $license_no->map(function ($item, $key) {
            return preg_replace('/\s+/', '', $item);
        });
    }
}
