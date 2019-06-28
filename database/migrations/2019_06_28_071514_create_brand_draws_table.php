<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandDrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_draws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('draw_date');
            $table->unsignedBigInteger('brand_id');

            $table->enum('status', ['new', 'checked', 'expired', 'error_check'])
                ->default('new');

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
        Schema::dropIfExists('brand_draws');
    }
}
