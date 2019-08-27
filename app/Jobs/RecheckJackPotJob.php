<?php

namespace App\Jobs;

use App\Model\BrandResult as BrandResultModel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RecheckJackPotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var BrandResultModel */
    protected $brandResult;

    /**
     * Create a new job instance.
     *
     * @param BrandResultModel $result
     *
     * @return void
     */
    public function __construct(BrandResultModel $result)
    {
        $this->brandResult = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \BrandResult::recheckJackPot($this->brandResult);
    }
}
