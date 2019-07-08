<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandsCollection extends ResourceCollection
{
    public $collects = BrandShortResource::class;

	/**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        	'data'  => $this->collection
        ];
    }
}