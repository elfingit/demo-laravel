<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bet_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->json('line');
            $table->json('extra_balls')->nullable();
            $table->json('extra_games')->nullable();

            $table->unsignedSmallInteger('ticket_number');

            $table->boolean('number_shield')->default(false);

            $table->decimal('price')->default(0.0);

            $table->enum('status', [
                \App\Model\BetTicket::STATUS_WAIT,
                \App\Model\BetTicket::STATUS_PLAYED,
                \App\Model\BetTicket::STATUS_WIN
            ]);

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bet_id');

            $table->timestamps();

            $table->foreign('brand_id')
                  ->on('brands')
                  ->references('id');

            $table->foreign('user_id')
                  ->on('users')
                  ->references('id');

            $table->foreign('bet_id')
                  ->on('bets')
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
        Schema::dropIfExists('bet_tickets');
    }
}
