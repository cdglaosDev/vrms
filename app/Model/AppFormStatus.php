<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AppFormStatus extends Model
{
    protected $table = "app_form_status";
    protected $fillable = ["name", "name_en"];

}
