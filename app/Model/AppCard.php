<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppCard extends Model
{

	use SoftDeletes;
    //Const DELETED_AT = "status";

    protected $fillable=['number','chip_number','car_number','expire_date','issue_date','app_form_id','status'];
    public function appforms()
    {
       return $this->belongsTo('\App\Model\AppForm','app_form_id');
    }
}
