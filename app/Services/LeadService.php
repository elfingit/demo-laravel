<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 11:36
 */

namespace App\Services;

use App\Model\Lead as LeadModel;
use App\Model\User as UserModel;
use App\Services\Contracts\LeadServiceContract;
use Illuminate\Http\Request;

class LeadService implements LeadServiceContract
{
	public function list( Request $request )
	{
		return LeadModel::query()
			->orderBy('created_at', 'desc')
			->paginate(25);
	}

    public function getListByUser( UserModel $user )
    {
        $query = LeadModel::query();

        $query->where('user_id', $user->id)
            ->whereNull('order_id')
            ->orderBy('created_at', 'desc');

        return $query->paginate(25);
    }
}
