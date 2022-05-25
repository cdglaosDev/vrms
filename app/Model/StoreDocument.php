<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StoreDocument extends Model
{

	use SoftDeletes;
    //Const DELETED_AT = "status";

   protected $fillable=['license_no', 'doc_type_id', 'filename', 'date', 'status', 'province_code', 'location', 'floor', 'channel', 'link', 'note'];

   public function vehicle()
   {
      return $this->belongsTo('\App\Model\Vehicle', 'license_no');
   }
   
   public function doctype()
   {
      return $this->belongsTo('\App\Model\ApplicationDocType', 'doc_type_id');
   }

   public function province()
   {
      return $this->belongsTo('\App\Model\Province', "province_code", "province_code");
   }
}
