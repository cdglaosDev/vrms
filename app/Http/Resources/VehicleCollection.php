<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\VehicleResource;
class VehicleCollection extends ResourceCollection
{
    public $collects = VehicleResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
