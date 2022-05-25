<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'province' => isset($this->province->old_name)?$this->province->old_name:'unidentified',
            'purpose' => isset($this->vehicle_kind->name)?$this->vehicle_kind->name:'unidentified',
            'purpose_no' => isset($this->vehicle_kind_code)?$this->vehicle_kind_code:'unidentified',
            'division_no' => $this->division_no,
            'province_no' => $this->province_no,
            'owner_name' => $this->owner_name,
            'engine_no' => $this->engine_no,
            'chassis_no' => $this->chassis_no,
            'vehicle_type' =>isset($this->vtype->name)?$this->vtype->name:'unidentified',
            'brand' => isset($this->vbrand->name)?$this->vbrand->name:'unidentified',
            'model' => isset($this->vmodel->name)?$this->vmodel->name:'unidentified',
            'color' => isset($this->color->name)?$this->color->name:'unidentified',
            'issue_date' => $this->issue_date,
            'expire_date' => $this->expire_date,
            'district' => isset($this->district->name)?$this->district->name:'unidentified',
            'village' => $this->village_name,
            'vehicle_id' => $this->id,
            'province_abb' => isset($this->province->abb)?$this->province->abb:'unidentified',
            'province_abb_en' => isset($this->province->abb_en)?$this->province->abb_en:'unidentified',
           
        ];
    }
}
