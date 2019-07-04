<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandCheckDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_check_dates', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->dateTime('check_date');
            $table->timestamp('next_check_date');
            $table->dateTime('last_check_date')->nullable();

            $table->unsignedBigInteger('brand_id');
            $table->timestamps();

            $table->foreign('brand_id')
	                ->references('id')
	                ->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_check_dates');
    }
}
