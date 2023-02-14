<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class parkingSpotResource extends JsonResource
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
            'id' => $this->id,
            'size_id'=>$this->size->name,
            'floor'=>$this->floor,
            'number'=>(int)$this->number,
            'attributes'=> $this->spotAttributes->pluck('name')
        ];
    }
}
