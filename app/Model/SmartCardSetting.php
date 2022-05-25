<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SmartCardSetting extends Model
{
    protected $table = "smartcard_settings";
    protected $fillable = ["code", "updated_by", "security_pin"];
}
