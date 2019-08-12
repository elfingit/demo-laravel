<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'draw_date' => $this->draw_date,
            'price' => $this->price,
            'status' => $this->status,
            'brand' => $this->brand->name,
            'created_at' => $this->created_at
        ];
    }
}
