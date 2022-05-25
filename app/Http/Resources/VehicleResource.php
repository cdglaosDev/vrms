<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
           
            'license_no' => $this->licence_no,
            'owner_name' => $this->owner_name,
            'division_no' => $this->division_no,
            'province_name' => isset($this->province->name)?$this->province->name:'unidentified',
            'province_code' =>$this->province_code,
            'vehicle_type' =>isset($this->vtype->name)?$this->vtype->name:'unidentified',
            'vehicle_type_id' => $this->vehicle_type_id,
            'engine_no' => $this->engine_no,
            'chassis_no' => $this->chassis_no,
            'brand' => isset($this->vbrand->name)?$this->vbrand->name:'unidentified',
            'model' => isset($this->vmodel->name)?$this->vmodel->name:'unidentified',
            'color' => isset($this->color->name)?$this->color->name:'unidentified',
            'issue_date' => $this->issue_date,
            'expire_date' => $this->expire_date,
            'tax_no' => $this->tax_no,
            'tax_date' => $this->tax_date ,
            'tax_payment_no' => $this->tax_payment_no,
            'tax_payment_date' => $this->tax_payment_date 
                 
        ];
    }
}
