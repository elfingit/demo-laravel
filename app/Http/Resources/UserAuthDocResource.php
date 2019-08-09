<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthDocResource extends JsonResource
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
            'id'    => $this->id,
            'file_name' => $this->file_name,
            'is_approved' => $this->is_approved,
            'is_rejected' => $this->is_rejected,
            'type' => $this->type,
            'comments' => $this->comments,
            'created_at' => $this->created_at,
            'user_id'   => $this->user_id
        ];
    }
}
