<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OldDocumentCategory extends Model
{
     use SoftDeletes;
   //Const DELETED_AT = "status";

    protected $fillable=['name', 'name_en', 'status'];


   public function olddocuments()
    {
        return $this->hasMany('\App\Model\OldDocument');
    }
}
