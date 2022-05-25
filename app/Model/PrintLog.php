<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PrintLog extends Model
{
    protected $table = "print_logs";
    protected $fillable = ["print_log_datetime", "print_log_count", "user_id", "vehicle_id","print_log_type", "security_pin"];
    
    protected $dates = ['print_log_datetime'];
    
    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo('\App\Model\Vehicle', 'vehicle_id');
    }


}
