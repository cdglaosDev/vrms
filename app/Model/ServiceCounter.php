<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ServiceCounter extends Model
{

    protected $fillable = ['name', 'name_en', 'description', 'status', 'created_by', 'province_code'];

    public function PriceList()
    {
        return $this->hasMany('App\Model\PriceList');
    }
    
    public function userinfo()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function province()
    {
        return $this->belongsTo('\App\Model\Province', 'province_code', 'province_code');
    }

    public function scopeName($query, $id){
        return $query->whereId($id)->pluck('name')->first();
    }


     //get counter list by user level
   public  function scopeCounterList()
   {
     if(auth()->user()->user_level == "province"){
        return $this->whereProvinceCode(auth()->user()->user_info->province_code)->whereStatus(1)->get();
     }else {
         return $this->whereStatus(1)->get(); 
     }
   }
  

 }

