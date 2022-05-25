<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LicenseAlphabet extends Model
{
    protected $fillable =["name", "name_en", "status", "created_by"];

    public function booking()
    {
        return $this->hasMany('App\Model\LicenseNoBooking');
    }

    public function alphabet_controls()
    {
        return $this->hasMany('App\Model\LicenseAlphabetControl');
    }

    public function LicenseNumberhistory()
    {
        return $this->hasMany('App\Model\LicenseNoHistory');
    }

    public function province()
    {
      return $this->belongsTo("App\Model\Province", 'province_id')->withDefault();
    }

    public function v_type()
    {
        return $this->belongsTo("App\Model\VehicleType", 'vehicle_type_id')->withDefault();
    }

    public function scopeAlphabet()
    {
        return  \App\Model\LicenseAlphabet::whereNotNull('name')->pluck('name');
    }
}
