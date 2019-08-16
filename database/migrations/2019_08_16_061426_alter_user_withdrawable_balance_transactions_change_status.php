<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserWithdrawableBalanceTransactionsChangeStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE user_withdrawable_balance_transactions DROP CONSTRAINT user_withdrawable_balance_transactions_status_check');

        \DB::statement('ALTER TABLE user_withdrawable_balance_transactions ADD CONSTRAINT user_withdrawable_balance_transactions_status_check check ((status)::text = ANY
                   ((ARRAY [
                   \'pending\'::character varying, 
                   \'blocked_no_auth\'::character varying, 
                   \'auth\'::character varying, 
                   \'payout_pending\'::character varying, 
                   \'external_payout\'::character varying, 
                   \'internal_payout\'::character varying])::text[]))');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
