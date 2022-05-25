<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CardSign extends Model
{
    protected $table = "card-sign";
    protected $fillable = ["dept_name", "officer_name", "logo", "sign"];
}
