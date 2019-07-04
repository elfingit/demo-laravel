<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:14
 */

namespace App\Services\Contracts;

use App\Model\Brand;
use Illuminate\Foundation\Http\FormRequest;

interface BrandServiceContract
{
	public function store(FormRequest $request);
	public function list($per_page);
}