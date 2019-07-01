<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        	'id'        => $this->id,
	        'email'     => $this->email,
	        'role'      => UserRoleResource::make($this->role),
	        'profile'   => UserProfileResource::make($this->profile)
        ];
    }
}
