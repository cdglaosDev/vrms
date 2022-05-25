<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VehiclePrintDetail extends Model
{
    protected $table = "vehicle_print_detail";
    protected $fillable=['no' ,'date', 'permanent','temporary', 'old_license_no', 'license_no', 'dated', 'certificate_dated', 'send_to', 'transport_no', 'country_origin', 'note', 'vehicles_id', 'print_count', 'print_type', 'print_by'];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDatedAttribute($value)
    {
        $this->attributes['dated'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    public function getDatedAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setCertificateDatedAttribute($value)
    {
        $this->attributes['certificate_dated'] = isset($value) ? Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d') : $value;
    }

    public function getCertificateDatedAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}
