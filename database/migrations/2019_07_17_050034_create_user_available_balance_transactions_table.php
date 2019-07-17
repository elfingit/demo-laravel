<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAvailableBalanceTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_available_balance_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('transaction_id', 32);
            $table->decimal('amount', 12, 2);
            $table->text('notes');

			$table->unsignedBigInteger('available_balance_id');
			$table->timestamps();

			$table->foreign('available_balance_id')
					->references('id')
					->on('user_available_balances')
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
        Schema::dropIfExists('user_available_balance_transactions');
    }
}
