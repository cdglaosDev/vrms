<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\StatusTrait;
class ITPRS extends Model
{
    use StatusTrait;
    protected $table = "tblitprs";

    protected $fillable = [
    'pass', 'type', 'number', 'vehicletype',
    'license_no', 'cat', 'make', 'model', 'color',
    "swheel", "motor_make", "cylinder", "cc","engine_no","chassis_no","width","length","height","seats","weight_empty","remark","name","village","unit","unit","district","province","telephone","fax","expire_date","doneat","issue_date","eexpire","edoneat","eissue","division_no","province_no","province_no","driverseat","energy","weight_filled","weight_total","axis","wheels","year_manufactured","import_permit_no","import_permit_date","industrial_doc_no","industrial_doc_date","commerce_permit","commerce_permit_no","commerce_permit_date","tax_no","tax_date","tax_payment_no","tax_payment_date","police_doc_no","police_doc_date","mistakeby","advance","fax1","tax_10_40","tax_exem","tax_12","tax_50","tax_receipt","tax_permit","import_permit_hsny","import_permit_invest","print_count","print_template_file","submit_by","submit_date","checked","date_collected","special","special_remark","special_date","log","printlog","changelog","encoder","user",'street','pro_code',"code_no","year","name_en","book_no_ref","vehicle_purpose_id"
    ];
    
    // protected $casts = [
    //     'vehicle_purpose' => 'array'
    // ];
 
    public function getBookNoAttribute()
    {
        return $this->pro_code."-".ltrim($this->code_no, '0')."/".$this->year;
    }
   
    public function kind()
    {
        return $this->belongsTo('\App\Model\VehicleKind','cat')->withDefault();
    }

    public function vehicle_type()
    {
        return $this->belongsTo('\App\Model\VehicleType','vehicletype')->withDefault();
    }

    public function brand()
    {
    	return $this->belongsTo('\App\Model\VehicleBrand','make')->withDefault();
    }

    public function vehicle_model()
    {
    	return $this->belongsTo('\App\Model\VehicleModel','model')->withDefault();
    }
    public function engine_brand()
    {
    	return $this->belongsTo('\App\Model\EngineBrand','motor_make')->withDefault();
    }

    public function dis()
    {
    	return $this->belongsTo('\App\Model\District','district','district_code')->withDefault();
    }

    public function pro()
    {
    	return $this->belongsTo('\App\Model\Province','province','province_code')->withDefault();
    }

    public function vill()
    {
        return $this->belongsTo('\App\Model\Village','village','village_code')->withDefault();
    }

    public function car_color()
    {
        return $this->belongsTo('\App\Model\Color','color')->withDefault();
    }

    public function done_at()
    {
    	return $this->belongsTo('\App\Model\Province','doneat','province_code')->withDefault();
    }
    public function vehicle_purpose()
    {
        return $this->belongsTo("\App\Model\VehiclePurpose",'vehicle_purpose_id')->withDefault();
    }
    public function users()
    {
        return $this->belongsTo("App\User",'user');
    }
}
