<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\BrandResultsCollection;
use App\Http\Resources\Api\BrandsCollection;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
	/**
	 * @api {get} /api/v1/brands Get list of brands
	 * @apiVersion 1.0.0
	 * @apiName ListOfBrands
	 * @apiGroup Brands
	 *
	 * @apiSuccess {String} id code of brand
	 * @apiSuccess {String} name name of brand
	 * @apiSuccess {String} logo url of brand logo
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *  HTTP/1.1 200 OK
	 *  {
	 *      "data": [
	 *			{
	 *				"id": "us_powerball",
	 *				"name": "Powerball",
	 *				"logo": "http://localhost/images/logos/us_powerball-logo.png"
	 *			}
	 *		]
	 *	}
	 */
	public function index()
	{
		return new BrandsCollection(\ApiBrand::list());
	}


	/**
	 * @api {get} /api/v1/brands/:brand Get brand data
	 * @apiVersion 1.0.0
	 * @apiName BrandData
	 * @apiGroup Brands
	 *
	 * @apiParam {String} brand code of brand
	 *
	 * @apiSuccess {String} id code of brand
	 * @apiSuccess {String} name name of brand
	 * @apiSuccess {String} logo url of brand logo
	 * @apiSuccess {Boolean} jackpot_multiplier
	 * @apiSuccess {String[]} default_quick_pick
	 * @apiSuccess {Number} primary_pool
	 * @apiSuccess {Number} primary_pool_combination
	 * @apiSuccess {Number} special_pool
	 * @apiSuccess {Number} special_pool_combination
	 * @apiSuccess {String} name_of_special_pool
	 * @apiSuccess {Boolean} duration
	 * @apiSuccess {Boolean} jackpot_hut
	 * @apiSuccess {Boolean} participation
	 * @apiSuccess {Boolean} extra_game
	 * @apiSuccess {Number} tickets_count
	 *
	 *
	 *
	 * @apiSuccessExample {json} Success-Response:
	 *  HTTP/1.1 200 OK
	 *  {
	 *      "data":
	 *			{
	 *				"id": "us_powerball",
	 *				"name": "Powerball",
	 *				"logo": "http://localhost/images/logos/us_powerball-logo.png",
	 *				"jackpot_multiplier": true,
	 *				"number_shield": true,
	 *				"default_quick_pick": [
	 *				    "3"
	 *				],
	 *				"primary_pool": 69,
	 *				"primary_pool_combination": 5,
	 *				"special_pool": 26,
	 *				"special_pool_combination": 1,
	 *				"name_of_special_pool": "Powerball",
	 *				"duration": true,
	 *				"subscription": true,
	 *				"jackpot_hut": true,
	 *				"participation": true,
	 *				"extra_game": true,
	 *				"tickets_count": 6
	 *			}
	 *	}
	 *
	 * @apiErrorExample {json} Error-Response:
	 *  HTTP/1.1 404 Not Found
	 *  {
	 *      "message": "Not found"
	 *  }
	 */
	public function show($brand)
	{
		$brandObject = \ApiBrand::getBrand($brand);

		if (!$brandObject) {
			abort(404);
		}

		return new BrandResource($brandObject);
	}

	/**
	 * @api {get} /api/v1/brands/:brand/results Get brand results
	 * @apiVersion 1.0.0
	 * @apiName BrandResults
	 * @apiGroup Brands
	 *
	 * @apiParam {String} brand code of brand
	 *
	 * @qpiSuccess {String} draw_date
	 * @apiSuccess {Object} results
	 * @apiSuccess {String} extra_ball
	 * @apiSuccess {Object} additional_games
	 *
	 * * @apiSuccessExample {json} Success-Response:
	 *  HTTP/1.1 200 OK
	 *  {
	 *      "data":[
	 *			{
	 *				"draw_date": "2019-07-06",
	 *				"results": {
	 *	                "main_result": [
	 *                      "04",
	 *                      "08",
	 *                      "23",
	 *                      "46",
	 *                      "65"
	 *                  ]
	 *              },
	 *				"extra_ball": "01",
	 *				"additional_games": {
	 *				    "megaplier": "2"
	 *				}
	 *			}
	 *      ]
	 *	}
	 *
	 * @apiErrorExample {json} Error-Response:
	 *  HTTP/1.1 404 Not Found
	 *  {
	 *      "message": "Not found"
	 *  }
	 *
	 */
	public function results($brand)
	{
		$results = \ApiBrand::getResults($brand);

		if (!$results) {
			abort(404);
		}

		return new BrandResultsCollection($results);

	}
}
