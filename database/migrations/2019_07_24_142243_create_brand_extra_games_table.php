<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandExtraGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_extra_games', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('game_name');
            $table->string('system_name');

            $table->decimal('game_price');

	        $table->unsignedBigInteger('brand_id');

            $table->timestamps();

	        $table->foreign('brand_id')
	              ->references('id')
	              ->on('brands')
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
        Schema::dropIfExists('brand_extra_games');
    }
}
