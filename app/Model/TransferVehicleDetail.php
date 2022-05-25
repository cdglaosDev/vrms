<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransferVehicleDetail extends Model
{
    protected $fillable=['transfer_vehicle_id', 'doc_name', 'note', 'status','unit'];
    
}
