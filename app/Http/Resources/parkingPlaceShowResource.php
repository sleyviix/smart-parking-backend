<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class parkingPlaceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name'=> $this->name,
            'postcode'=> $this->postCode,
//            'attributes' => $this->parkingSpotAttribute->pluck('pivot.hourly_price'),
            'attributes' => $this->parkingSpotAttribute,
        ];
    }
}
