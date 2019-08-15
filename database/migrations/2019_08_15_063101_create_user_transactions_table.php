<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_id');

            $table->string('transaction_type');

            $table->timestamps();
            $table->softDeletes();
        });

        $trans = DB::table('user_available_balance_transactions')
            ->select([
                'user_available_balance_transactions.id as tid',
                'user_available_balances.user_id'
            ])
            ->join('user_available_balances', 'user_available_balance_transactions.available_balance_id', '=', 'user_available_balances.id')
            ->get();


        foreach ($trans as $t) {
            \App\Model\UserTransaction::create([
                'user_id'           => $t->user_id,
                'transaction_id'    => $t->tid,
                'transaction_type'  => \App\Model\UserAvailableBalanceTransaction::class
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
}
