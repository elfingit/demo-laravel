<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserWithdrawableBalanceTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_withdrawable_balance_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('bet_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_withdrawable_balance_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('bet_id')->nullable(false)->change();
        });
    }
}
