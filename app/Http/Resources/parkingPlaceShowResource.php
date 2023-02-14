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
            'sizes'      => $this->parkingPrices->transform(function ($entry) {
                return
                    [
                            'name' => $entry->size->name,
                            'price' => $entry->basePrice,
                            'rates' => $entry->dailyRate
                    ];
            }),
            'attributes' => $this->spotAttributes->pluck('pivot.hourly_price', 'name'),
        ];
    }
}
