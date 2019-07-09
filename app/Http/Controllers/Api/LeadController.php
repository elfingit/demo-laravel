<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateLeadRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateLeadRequest;
use App\Http\Resources\Api\LeadResource;
use App\Model\Lead as LeadModel;

class LeadController extends Controller
{
    public function create(CreateLeadRequest $request)
    {
		$lead = \ApiLead::create($request);

		return new LeadResource($lead);
    }

    public function update(UpdateLeadRequest $request, LeadModel $lead)
    {
	    $lead = \ApiLead::update($request, $lead);

	    return new LeadResource($lead);
    }
}
