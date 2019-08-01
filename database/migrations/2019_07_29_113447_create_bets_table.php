<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->date('draw_date');

            $table->decimal('price')->default(0.0);

            $table->enum('status', [
                \App\Model\Bet::STATUS_PAID,
                \App\Model\Bet::STATUS_WAITING_DRAW,
                \App\Model\Bet::STATUS_PLAYED,
                \App\Model\Bet::STATUS_WIN,
                \App\Model\Bet::STATUS_REFUND,
                \App\Model\Bet::STATUS_AUTH_PENDING,
                \App\Model\Bet::STATUS_NOT_AUTH,
                \App\Model\Bet::STATUS_PAYOUT_PENDING,
                \App\Model\Bet::STATUS_PAYOUT,
                \App\Model\Bet::STATUS_CLOSED
            ]);

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id');

            $table->timestamps();

            $table->foreign('brand_id')
                    ->on('brands')
                    ->references('id');

            $table->foreign('user_id')
                    ->on('users')
                    ->references('id');

            $table->foreign('order_id')
                  ->on('orders')
                  ->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
}
