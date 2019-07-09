<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 11:34
 */

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface LeadServiceContract
{
	public function list(Request $request);
}