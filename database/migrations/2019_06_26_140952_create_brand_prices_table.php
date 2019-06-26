<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('combination_price');
            $table->decimal('number_shield_price');
            $table->string('currency', 4);
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
        Schema::dropIfExists('brand_prices');
    }
}
