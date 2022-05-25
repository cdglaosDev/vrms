<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CardSignResource extends JsonResource
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
            'department' => $this->dept_name,
            'officer' =>$this->officer_name,
            'logo' => $this->logo,
            'sign' => $this->sign
        ];
    }
}
