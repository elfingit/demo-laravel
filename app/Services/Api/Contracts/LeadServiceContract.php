<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-09
 * Time: 07:17
 */

namespace App\Services\Api\Contracts;

use App\Model\Lead as LeadModel;
use Illuminate\Foundation\Http\FormRequest;

interface LeadServiceContract
{
	public function create(FormRequest $request);
	public function update(FormRequest $request, LeadModel $lead);
}