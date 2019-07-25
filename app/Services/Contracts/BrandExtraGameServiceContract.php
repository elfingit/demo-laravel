<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-25
 * Time: 09:48
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use Illuminate\Foundation\Http\FormRequest;

interface BrandExtraGameServiceContract
{
	public function store(BrandModel $brand, FormRequest $request);
}