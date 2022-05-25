<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleCheckResult extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function AppForm()
    {
        return $this->belongsTo('App\Model\AppForm', 'app_form_id');
    }
}
