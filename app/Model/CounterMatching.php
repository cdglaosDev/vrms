<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CounterMatching extends Model
{
    protected $fillable = ["service_counter_id","province_code",'staff_id', 'start_bill_no', 'bill_no_present'];

    public function service_counter()
    {
        return $this->belongsTo("App\Model\ServiceCounter", "service_counter_id", "id")->withDefault();
    }

    public function user()
    {
        return $this->belongsTo("App\User", "staff_id", "id")->withDefault();
    }

    public function province()
    {
        return $this->belongsTo("App\Model\Province", "province_code", "province_code")->withDefault();
    }

    
}
