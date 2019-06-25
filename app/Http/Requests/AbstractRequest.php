<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-06-25
 * Time: 16:59
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class AbstractRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}
}