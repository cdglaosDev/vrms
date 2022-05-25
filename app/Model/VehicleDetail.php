<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helpers\getData;
use Carbon\Carbon;
class VehicleDetail extends Model
{
    
   protected $table = 'vehicle_details';
   protected $guarded = [];
   public function type()
   {
   return $this->belongsTo("App\Model\VehicleType", 'vehicle_type_id')->withDefault();
   }
      
   public function brand()
   {
      return $this->belongsTo("App\Model\VehicleBrand", 'brand_id')->withDefault();
   }
   public function vehicleKind()
   {
      return $this->belongsTo("App\Model\VehicleKind", 'vehicle_kind_code', 'vehicle_kind_code')->withDefault();
   }

   public function model()
   {
      return $this->belongsTo("App\Model\VehicleModel", 'model_id')->withDefault();
   }
   public function color()
   {
      return $this->belongsTo("App\Model\Color", 'color_id')->withDefault();
   }

   public function regapps()
   {
      return $this->hasOne("App\Model\PreRegisterApp", 'vehicle_detail_id')->withDefault();
   }
   public function district()
   {
      return $this->belongsTo('\App\Model\District', "district_code", "district_code")->withDefault();
   }
   public function province()
   {
      return $this->belongsTo('\App\Model\Province', "province_code", "province_code")->withDefault();
   }
   
   public function steering()
   {
      return $this->belongsTo('\App\Model\Steering', 'steering_id')->withDefault();
   }
   
   public function appdocument()
   {
      return $this->hasMany('\App\Model\AppDocument');
   }
    
   public function gas()
   {
      return $this->belongsTo('\App\Model\Gas', 'gas_id')->withDefault();
   }

   public function apppurpose()
   {
      return $this->belongsTo('\App\Model\VehiclePurpose', 'purpose_id')->withDefault();
   }

   public function engine_type()
   {
      return $this->belongsTo("App\Model\EngineType", 'engine_type_id')->withDefault();
   }

   public function engine_brand()
   {
      return $this->belongsTo("App\Model\EngineBrand", 'motor_brand_id')->withDefault();
   }

   public function vehicleDetailTenant()
    {
        return $this->hasOne("\App\Model\VehicleDetailTenant", 'vehicle_detail_id')->withDefault();
    }
   
   //vehicle detail show
   public static function detailData($id)
   {
      $data['vehicle'] = VehicleDetail::find($id);
      $data['detail_tenant'] = \App\Model\VehicleDetailTenant::whereVehicleDetailId($id)->first();
      $data['data'] = getData::vehInfo();
      $data['app_doc'] = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
      if ( $data['app_doc']->isNotEmpty()) {
         $data['app_doc'] = AppDocument::whereVehicleDetailId($id)->pluck('filename','doc_type_id');
      } else {
         $data['app_doc'] = null;
      }
      return $data;
   
   }

   public  function ScopeEngineNo()
   {
      return $this->pluck('engine_no')->toArray();
     
   }

   public  function ScopeChassisNo()
   {
      return $this->pluck('chassis_no')->toArray();
   }

   // check licnese no for new modal form
   public static function getLicenseOnly()
   {
      $license_no = \App\Model\VehicleDetail::whereNotNull('licence_no_need')->pluck('licence_no_need');
         return $license_no->map(function($item, $key) {
            return preg_replace('/\s+/', '', $item);
         });
   }
     // check engine no for new modal form
   public static function getEngine()
   {
      return  \App\Model\VehicleDetail::whereNotNull('engine_no')->where([ ['engine_no', '!=', "-"], ['engine_no', '!=', "0"],['engine_no', '!=', ""] ])->pluck('engine_no');
    
   }
     // check chassis no for new modal form
   public static function getChassis()
   {
      
      return  \App\Model\VehicleDetail::whereNotNull('chassis_no')->where([ ['chassis_no', '!=', "-"], ['chassis_no', '!=', "0"],['chassis_no', '!=', ""] ])->pluck('chassis_no');
      
   }
   /* mutator and accessor for tax date */
   public function setTaxDateAttribute($value)
   {
      $this->attributes['tax_date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
   }
   
   public function getTaxDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for import permit date */
   public function setImportPermitDateAttribute($value)
   {
      $this->attributes['import_permit_date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'): $value;
   }

   public function getImportPermitDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for Industrial date */
   public function setIndustrialDocDateAttribute($value)
   {
      $this->attributes['industrial_doc_date'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'):$value;
   }

   public function getIndustrialDocDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for Technical doc date */
   public function setTechnicalDocDateAttribute($value)
   {
      $this->attributes['technical_doc_date'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') :$value;
   }
   public function getTechnicalDocDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for commerce Permit date */
   public function setComercePermitDateAttribute($value)
   {
      $this->attributes['comerce_permit_date'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
   }
   public function getComercePermitDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for tax payment date */
   public function setTaxPaymentDateAttribute($value)
   {
      $this->attributes['tax_payment_date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d'): $value;
   }
   public function getTaxPaymentDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }

   /* mutator and accessor for Police doc date */
   public function setPoliceDocDateAttribute($value)
   {
      $this->attributes['police_doc_date'] = isset($value)? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
     
   }
   public function getPoliceDocDateAttribute($value)
   {
      return isset($value)? Carbon::parse($value)->format('d/m/Y'):null;
   }
  
}
