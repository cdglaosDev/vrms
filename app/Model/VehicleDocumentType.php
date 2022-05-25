<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleDocumentType extends Model
{
    protected $table = "vehicle_docment_types";
    protected $fillable=['name', 'name_en', 'status'];
}
