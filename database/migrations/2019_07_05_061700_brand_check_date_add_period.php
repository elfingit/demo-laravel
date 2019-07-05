<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrandCheckDateAddPeriod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brand_check_dates', function (Blueprint $table) {
        	$table->unsignedSmallInteger('period')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('brand_check_dates', function (Blueprint $table) {
		    $table->dropColumn('period');
	    });
    }
}
