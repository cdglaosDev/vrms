<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadDataResource extends JsonResource
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
            'license_no' => $this->license_no,
            'province' =>$this->province,
            'division_no' => $this->division_no,
            'province_no' => $this->province_no,
            'name' => $this->name,
            'engine_no' => $this->engine_no,
            'chassis_no' => $this->chassis_no,
            'vehicle_type' =>$this->vehicle_type,
            'brand' => $this->brand,
            'model' => $this->model,
            'color' => $this->color,
            'issue_date' => $this->issue_date,
            'expire_date' => $this->expire_date,
            'district' => $this->district,
            'village' => $this->village,
            'card_no' => $this->card_no,
            'vehicle_kind' => $this->vehicle_kind,
            'vehicle_code' => $this->vehicle_code,
            
        ];
    }
}
