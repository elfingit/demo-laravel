<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandJackpotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_jackpots', function (Blueprint $table) {
            $table->bigIncrements('id');

	        $table->date('next_draw');
	        $table->string('currency', 4);
	        $table->decimal('jackpot', 16, 2);
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
        Schema::dropIfExists('brand_jackpots');
    }
}
