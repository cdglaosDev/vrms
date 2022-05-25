<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AppFormPurpose extends Model
{
	protected $table = "app_form_purposes";
    protected $fillable = ['app_purpose_id', 'app_form_id'];

    public function appform()
    {
        return $this->belongsTo('\App\Model\AppForm', 'app_form_id')->withDefault();
    }
    
    public function app_purpose()
    {
        return $this->belongsTo('\App\Model\AppPurpose', 'app_purpose_id')->withDefault();
    }
   
}
