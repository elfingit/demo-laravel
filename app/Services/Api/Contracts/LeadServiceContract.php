<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 07:17
 */

namespace App\Services\Api\Contracts;

use Illuminate\Foundation\Http\FormRequest;

interface LeadServiceContract
{
	public function create(FormRequest $request);
}