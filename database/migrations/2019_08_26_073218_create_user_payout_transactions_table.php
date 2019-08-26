<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayoutTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payout_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('transaction_id', 32)->unique();
            $table->decimal('amount', 12, 2);
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('request_id');

            $table->timestamps();

            $table->foreign('request_id')
                    ->on('user_payout_requests')
                    ->references('id')
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
        Schema::dropIfExists('user_payout_transactions');
    }
}
