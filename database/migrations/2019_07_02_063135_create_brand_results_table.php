<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_results', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('draw_date');
            $table->json('results');

            $table->bigInteger('brand_id');

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
        Schema::dropIfExists('brand_results');
    }
}
