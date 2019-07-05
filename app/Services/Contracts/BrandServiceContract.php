<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 17:14
 */

namespace App\Services\Contracts;

use App\Model\Brand as BrandModel;
use App\Model\BrandCheckDate as BrandCheckDateModel;
use Illuminate\Foundation\Http\FormRequest;

interface BrandServiceContract
{
	public function store(FormRequest $request);
	public function list($per_page);
	public function update(FormRequest $request, BrandModel $brand);

	public function fetchResult(BrandCheckDateModel $check_date);
}