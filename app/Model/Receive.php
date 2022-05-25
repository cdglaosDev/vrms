<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
      protected $table = "tblreceive";
      
       protected $fillable = [
        'reg_id', 'srno', 'txt1', 'txt2',
        'txt3', 'txt4', 'title', 'amt'
    ];
}
