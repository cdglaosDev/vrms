<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    protected $fillable=['app_number', 'status', 'counter', 'department_id', 'time_call'];

    public $timestamps = false;

    public function app_form()
    {
        return $this->belongsTo('\App\Model\AppForm', 'app_number', 'app_no')->withDefault();
    }
}
