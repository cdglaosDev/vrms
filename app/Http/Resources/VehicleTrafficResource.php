<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTrafficResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id' => $this->id,
            'traffic_accident_id' => $this->traffic_accident_id,
            'vehicle_id' => $this->vehicle_id,
            'license_no' => $this->license_no,
            'place' => $this->place,
            'offender_name' =>$this->offender_name,
            'officer_name' =>$this->officer_name,
            'date' => $this->date,
            'remark' =>$this->remark,
            'user_id' =>$this->user_id
        ];
    }
}
