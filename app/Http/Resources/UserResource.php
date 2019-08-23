<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-17
 * Time: 11:04
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	public static $wrap = 'user';

	public function toArray( $request )
	{
		return [
			'id'    => $this->id,
			'email' => $this->email,
			'balance' => [
				'available_amount' => 0,
				'withdrawable_amount' => 0,
			]
		];
	}
}
