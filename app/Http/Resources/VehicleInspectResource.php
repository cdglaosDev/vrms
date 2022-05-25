<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleInspectResource extends JsonResource
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
           
            'inspect_no' => $this->inspect_number,
            'request_no' => $this->app_request_no,
            'inspect_date' => $this->date,
            'inspect_result' => $this->result,
            'inspect_type' =>$this->type,
            'inspect_comment' =>$this->comment,
            'vehicle_license_no' => isset($this->vehicle->licence_no)?$this->vehicle->licence_no:'unidentified'
              
        ];
    }
}
