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

            $table->json('line');
            $table->json('extra_balls')->nullable();
            $table->json('extra_games')->nullable();

            $table->unsignedSmallInteger('ticket_number');

            $table->boolean('number_shield')->default(false);

            $table->date('draw_date');

            $table->decimal('price')->default(0.0);

            $table->enum('status', [
                \App\Model\Bet::STATUS_PENDING,
                \App\Model\Bet::STATUS_PAID,
                \App\Model\Bet::STATUS_PLAYED,
                \App\Model\Bet::STATUS_REFUND,
                \App\Model\Bet::STATUS_CHARGE_BACK,
                \App\Model\Bet::STATUS_CANCELLED,
                \App\Model\Bet::STATUS_AUTH_PENDING,
            ]);

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('brand_id')
                    ->on('brands')
                    ->references('id');

            $table->foreign('user_id')
                    ->on('users')
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
