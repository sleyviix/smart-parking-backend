<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'uuid' => $this->uuid,
            'parking_spot_id'    => $this->parking_spot_id,
            'start'      => $this->start,
            'end'        => $this->end,
            'paid_at'    => $this->paid_at,
            'paid_amount'    => $this->paid_amount /100,
            'created_at' => $this->created_at,
            'parking_place_name' => $this->parkingSpot->parkingPlace->name,
            'parking_place_postcode' => $this->parkingSpot->parkingPlace->postCode,
            'parking_place_lat' => $this->parkingSpot->parkingPlace->lat,
            'parking_place_lng' => $this->parkingSpot->parkingPlace->lng,
//            'user_name' => $this->User->name,
//            'user_email' => $this->User->email,
//            'user_id' => $this->User->id,
            'spot' => $this->parkingSpot,


        ];
    }
}
