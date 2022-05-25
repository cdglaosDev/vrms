<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AppRoadTax extends Model
{
    use SoftDeletes;
    //Const DELETED_AT = "status";

    protected $fillable=['amount', 'currency', 'file', 'date', 'remark', 'app_form_id', 'status'];
    
    public function appforms()
    {
       return $this->belongsTo('\App\Model\AppForm', 'app_form_id');
    }
}
