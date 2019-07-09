<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateLeadRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateLeadRequest;
use App\Http\Resources\Api\LeadResource;
use App\Model\Lead as LeadModel;

class LeadController extends Controller
{
	/**
	 *
	 * @api {post} /api/v1/leads Create lead
	 * @apiVersion 1.0.0
	 * @apiName CreateLead
	 * @apiGroup Leads
	 * @apiPermission lead_create
	 *
	 * @apiParam {String} host Name of host
	 * @apiParam {String} g_user_id Google Analytics User ID
	 * @apiParam {Object[]} [cart_items]
	 *
	 * @apiSuccess {Number} id ID of lead
	 * @apiSuccess {Object[]} cart_items
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *  HTTP/1.1 200 OK
	 *  {
	 *      "data": {
	 *				"id": 3,
	 *				"cart_items": [{
	 *					"brand_id": "us_powerball",
	 *					"tickets": [3,4,5,6,23]
	 *				}]
	 *			}
	 *	}
	 *
	 * @apiErrorExample {json} Error-Response:
	 *  HTTP/1.1 422 Unprocessable Entity
	 *  {
	 *      "message": "The given data was invalid.",
	 *		"errors": {
	 *			"host": [
	 *				"The host field is required."
	 *			],
	 *			"g_user_id": [
	 *				"The g user id field is required."
	 *			]
	 *		}
	 *  }
	 *
	 */
	public function create(CreateLeadRequest $request)
    {
		$lead = \ApiLead::create($request);

		return new LeadResource($lead);
    }

	/**
	 *
	 * @api {put} /api/v1/leads/:lead Update lead
	 * @apiVersion 1.0.0
	 * @apiName UpdateLead
	 * @apiGroup Leads
	 * @apiPermission lead_update
	 *
	 * @apiParam {String} host Name of host
	 * @apiParam {Object[]} cart_items
	 *
	 * @apiSuccess {Number} id ID of lead
	 * @apiSuccess {Object[]} cart_items
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *  HTTP/1.1 200 OK
	 *  {
	 *      "data": {
	 *				"id": 3,
	 *				"cart_items": [{
	 *					"brand_id": "us_powerball",
	 *					"tickets": [3,4,5,6,23]
	 *				}]
	 *			}
	 *	}
	 *
	 * @apiErrorExample {json} Error-Response:
	 *  HTTP/1.1 422 Unprocessable Entity
	 *  {
	 *      "message": "The given data was invalid.",
	 *		"errors": {
	 *			"host": [
	 *				"The host field is required."
	 *			],
	 *			"cart_items": [
	 *				"The cart items field is required."
	 *			]
	 *		}
	 *  }
	 *
	 */
    public function update(UpdateLeadRequest $request, LeadModel $lead)
    {
	    $lead = \ApiLead::update($request, $lead);

	    return new LeadResource($lead);
    }
}
