<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PriceListDisplaySetting extends Model
{
    protected $table = "price_list_display_setting";
    protected $fillable=['logo1', 'logo2', 'text1', 'text2', 'text3'];

}
