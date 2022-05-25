<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentMatch extends Model
{
    protected $fillable =["app_purpose_id", "vehicle_cateogry_id", "price_item_id"];
}
