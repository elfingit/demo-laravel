<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 07:18
 */

namespace App\Services\Api;

use App\Model\Lead as LeadModel;
use App\Services\Api\Contracts\LeadServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class LeadService implements LeadServiceContract
{
	public function create( FormRequest $request )
	{
		$data = $request->only([
			'host', 'g_user_id', 'cart_items'
		]);

		$data['status'] = LeadModel::STATUS_NEW;

		return LeadModel::create($data);
	}

	public function update( FormRequest $request, LeadModel $lead )
	{
		$lead->cart_items = $request->get('cart_items');
		$lead->save();

		return $lead;
	}
}