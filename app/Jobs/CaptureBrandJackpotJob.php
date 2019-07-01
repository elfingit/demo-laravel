<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CaptureBrandJackpotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $brand;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($brand)
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
	    \BrandJackpot::fetchJackpot($this->brand);
    }
}
