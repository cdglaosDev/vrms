<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DisplaySetting extends Model
{
    protected $table = "display_settings";
    protected $fillable = ["department_id", "text1", "text2", "text3", "title", "status", "created_by", "updated_by"];
}
