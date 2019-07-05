<?php

namespace App\Jobs;

use App\Model\BrandCheckDate as BrandCheckDateModel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchBrandResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $brand_check_date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BrandCheckDateModel $brand_check_date)
    {
        $this->brand_check_date = $brand_check_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	\Brand::fetchResult($this->brand_check_date);
    }
}
