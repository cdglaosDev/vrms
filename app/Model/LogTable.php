<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogTable extends Model
{
    protected $fillable =["table_name", "user_id", "record_id", "ip_address", 'action', 'action_detail', 'date', 'vehicle_id'];
    protected $dates = ['date'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
