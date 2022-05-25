<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VehicleDocument extends Model
{
    protected $table = "vehicle_documents";
    protected $fillable=['vehicle_id', 'doc_type_id', 'filename', 'location', 'floor', 'channel', 'row', 'location_note', 'date', 'status','link', 'note'];
    
    public function doc_type()
    {
    	return $this->belongsTo('\App\Model\ApplicationDocType', 'doc_type_id', 'id' );
    }
}
