<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandResultsCollection extends ResourceCollection
{

	public $collects = BrandResultResource::class;

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
