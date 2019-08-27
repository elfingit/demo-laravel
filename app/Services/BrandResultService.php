<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-07-05
 * Time: 16:59
 */

namespace App\Services;

use App\Jobs\CalculateWinsJob;
use App\Jobs\RecheckJackPotJob;
use App\Model\Brand as BrandModel;
use App\Model\BrandResult as BrandResultModel;
use App\Services\Contracts\BrandResultContract;
use App\Services\Exceptions\BrandResultExistsException;

class BrandResultService implements BrandResultContract
{
	public function store( $data, BrandModel $brand )
	{
		$result = BrandResultModel::isExists($data->date, $brand)->first();

		if ($result) {
			throw new BrandResultExistsException('Result already exists ' . $brand->id . '|' . $data->date );
		}

		if (!isset($data->additional_games)) {
			$data->additional_games = [];
		}

        if (!isset($data->jack_pot)) {
            $data->jack_pot = 0;
        }

		$brandResult = new BrandResultModel([
			'draw_date' => $data->date,
			'jack_pot'  => $data->jack_pot,
			'results' => [
				'main_result' => $data->main_result,
				'extra_ball' => $data->extra_ball,
				'additional_games' => $data->additional_games
			]
		]);

		$brand->results()->save($brandResult);

        CalculateWinsJob::dispatch($brandResult);

        if ($brand->api_code == 'de_lotto' && $brandResult->jack_pot == 0) {
            RecheckJackPotJob::dispatch($brandResult)
                ->delay(now()->addHour());
        }

		return $brandResult;
	}

    public function recheckJackPot( BrandResultModel $result )
    {
        $result = \RemoteApi::fetchResult($result->brand->api_code);
        $data = json_decode( $result->getBody() );

        if ($data->jack_pot == 0) {
            RecheckJackPotJob::dispatch($result)
                             ->delay(now()->addHour());
        } else {
            $result->jack_pot = $data->jack_pot;
            $result->save();
        }
    }
}
