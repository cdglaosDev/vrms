<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Staff extends Model
{
	use SoftDeletes;
    protected $guarded = [];

    public function company()
    {
    	return $this->belongsTo("App\Model\Company",'company_id');
    }
    public function preregisters()
    {
    	return $this->hasMany("App\Model\PreRegisterApp");
    }

    public function getBirthDateAttribute($value)
    {
    	return Carbon::parse($value)->format('d-m-Y');
	}
}
