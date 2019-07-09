<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateLeadRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LeadResource;

class LeadController extends Controller
{
    public function create(CreateLeadRequest $request)
    {
		$lead = \ApiLead::create($request);

		return new LeadResource($lead);
    }
}
