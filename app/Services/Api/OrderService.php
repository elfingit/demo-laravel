<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-29
 * Time: 16:36
 */
namespace App\Services\Api;

use App\Model\Order as OrderModel;
use App\Model\User as UserModel;
use App\Services\Api\Contracts\OrderServiceContract;
use Illuminate\Foundation\Http\FormRequest;

class OrderService implements OrderServiceContract
{
    public function create( FormRequest $request, UserModel $user )
    {
        $orderData = $request->only('host', 'favicon_url');

        $this->calculateOrderPrice($request->get('cart_items'));

        $order = OrderModel::create($orderData);

        //\Brand::getBrandByApiCode($request->);
    }

    protected function calculateOrderPrice(array $items)
    {
        foreach ($items as $item) {
            $brand = \ApiBrand::getBrand($item['brand_id']);
        }
    }

}
