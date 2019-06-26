<?php

namespace App\Jobs;

use App\Lib\Mangayo\Contracts\GameDataContract;
use App\Model\Brand;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CaptureBrandDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $brand;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	try {
		    /** @var GameDataContract $gameData */
    		$gameData = \LotteryRemoteApi::getGameInfo($this->brand->api_code);

    		if ($gameData->hasError()) {
    			$this->errSync($gameData->getErrorDescription());
    			return;
		    }

    		$this->brand->country = $gameData->getCountry();
    		$this->brand->state = $gameData->getState();
    		$this->brand->main_min = $gameData->getMainMin();
    		$this->brand->main_max = $gameData->getMainMax();
    		$this->brand->main_drawn = $gameData->getMainDrawn();

    		$this->brand->bonus_min = $gameData->getBonusMin();
    		$this->brand->bonus_max = $gameData->getBonusMax();
    		$this->brand->bonus_drawn = $gameData->getBonusDrawn();

    		$this->brand->same_balls = $gameData->getSameBalls();
    		$this->brand->digits = $gameData->getDigits();
    		$this->brand->drawn = $gameData->getDrawn();

    		if ($gameData->isOption()) {
    			$this->brand->option_desc = $gameData->getOptionDescription();
		    }

    		$this->brand->status = Brand::STATUS_SYNCED;
    		$this->brand->save();

		} catch (\Exception $e) {
		    $this->errSync($e->getMessage());
		}
    }

    protected function errSync($message)
    {
	    //TODO need log this
	    $this->brand->status = Brand::STATUS_ERR_SYNC;
	    $this->brand->save();
    }
}
