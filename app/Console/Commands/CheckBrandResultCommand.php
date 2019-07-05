<?php

namespace App\Console\Commands;

use App\Jobs\FetchBrandResultJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBrandResultCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brand:check_result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check brand results';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$dates = \BrandCheckDate::getDates(new Carbon());

    	foreach ($dates as $date) {
			FetchBrandResultJob::dispatch($date);
	    }
    }
}
