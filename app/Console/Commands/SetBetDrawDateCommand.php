<?php

namespace App\Console\Commands;

use App\Jobs\CalculateWinsJob;
use App\Model\Bet;
use App\Model\BrandResult;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetBetDrawDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bet:draw_date {bet} {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set draw date for bet';

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
        $betId = $this->argument('bet');
        $date = $this->argument('date');

        $bet = Bet::find($betId);

        if (!$bet) {
            $this->output->error('Bet with ID '. $betId . ' not found');
            return;
        }

        if ($bet->status != Bet::STATUS_WAITING_DRAW) {
            $this->output->error(
                "Bet must have status '". Bet::STATUS_WAITING_DRAW."''\n".
                "Current status '". $bet->status."'");
            return;
        }

        try {
            $date = Carbon::parse( $date );
        } catch (\Exception $e) {
            $this->output->error('Bad date');
            return;
        }

        $bet->draw_date = $date;
        $bet->save();

        $this->comment('Date was set.');

        $result = BrandResult::query()
            ->where('brand_id', $bet->brand_id)
            ->whereDate('draw_date', '<=', $date)
            ->orderBy('draw_date', 'desc')
            ->first();

        if (!$result) {
            $this->comment('Result for brand '. $bet->brand_id . ' at ' . $date->format(Carbon::DEFAULT_TO_STRING_FORMAT) . ' not found');
            return;
        }

        CalculateWinsJob::dispatch($result);

        $this->output->comment("Calculate job was started.\n
        It can will take a some time, please wait.");
    }
}
