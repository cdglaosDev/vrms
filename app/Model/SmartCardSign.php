<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class SmartCardSign extends Model
{

	
    //Const DELETED_AT = "status";

    protected $fillable=['province_code', 'sign_img', 'status'];

    public function province()
    {
       return $this->belongsTo('\App\Model\Province', 'province_code');
    }
}
