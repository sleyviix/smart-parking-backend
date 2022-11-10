<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class parkingPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'name'=> $this->name,
            'post'=> $this->postCode,
            'coordinates' => [

                'lng'=> $this->lng,
                'lat'=> $this->lat
            ],
            'total_spots' => $this->total_spots,
            'free_spots' => $this->free_spots,

        ];
    }

}
