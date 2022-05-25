<?php

namespace App\Model;
use Carbon\Carbon;
use App\Traits\GeneralEnum;
use Illuminate\Database\Eloquent\Model;

class TransferVehicle extends Model
{
   use GeneralEnum;
    protected $fillable=['app_form_id', 'transfer_no', 'transfer_from', 'transfer_date', 'transfer_to', 'old_vehicle_number', 'new_vehicle_number', 'remark', 'status', 'apply_by', 'approved_officer','app_request_no'];
    
    protected $attributes = [
        'status' => 1
    ];
 
    public static $generalenum = [
        "status" => ["inprogress" => "Inprogress", "complete_transfer" => "Complete Transfer",  "cancel_transfer" => "Cancel Transfer"]
       
    ];

    public function province_tran_from()
    {
       return $this->belongsTo("App\Model\Province", "transfer_from");
    }

    public function province_tran_to()
    {
       return $this->belongsTo("App\Model\Province", "transfer_to");
    }
     
    public function AppForm()
    {
        return $this->belongsTo("App\Model\AppForm", "app_form_id");
    }

    public function users_apply()
    {
        return $this->belongsTo("App\User", "apply_by");
    }

    public function users_approve()
    {
        return $this->belongsTo("App\User", "approved_officer");
    }
    
    public function transfer_detail()
    {
        return $this->hasMany("App\Model\TransferVehicleDetail", "transfer_vehicle_id");
    }
   
    public function setTransferDateAttribute($value)
    {
        $this->attributes['transfer_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getTransferDateAttribute($value)
    {
        return ($value == "0000-00-00" || $value == null) ? null : Carbon::parse($value)->format('d/m/Y');
    }
}

