<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWithdrawableBalanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_withdrawable_balance_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('transaction_id', 32)->unique();
            $table->decimal('amount', 12, 2);
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('balance_id');
            $table->unsignedBigInteger('bet_id');

            $table->enum('status', [
                \App\Model\UserWithdrawableBalanceTransaction::STATUS_PENDING,
                \App\Model\UserWithdrawableBalanceTransaction::STATUS_BLOCKED_NO_AUTH,
                \App\Model\UserWithdrawableBalanceTransaction::STATUS_AUTH
            ]);

            $table->timestamps();

            $table->foreign('balance_id')
                  ->references('id')
                  ->on('user_withdrawable_balances')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_withdrawable_balance_transactions');
    }
}
