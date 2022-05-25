<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OldDocument extends Model
{
   use SoftDeletes;
    //Const DELETED_AT = "status";

   protected $fillable=['department', 'file', 'type', 'date', 'remark', 'status'];

   public function departments()
   {
      return $this->belongsTo('App\Model\Department', 'department');
   }
   public function olds()
   {
      return $this->belongsTo('App\Model\OldDocumentCategory', 'type');
   }
}
