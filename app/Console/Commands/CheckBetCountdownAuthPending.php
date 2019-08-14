<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckBetCountdownAuthPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bet:check_auth_pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking bets which got status, "Auth Pending", 14 days ago';

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
        \Bet::moveAuthPendingBetsToNotAuth();
    }
}
