<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-22
 * Time: 09:34
 */

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandCheckDateResource extends JsonResource
{
	public function toArray( $request )
	{
		return [
			'next_check_date' => $this->next_check_date,
			'period'    => $this->period
		];
	}
}