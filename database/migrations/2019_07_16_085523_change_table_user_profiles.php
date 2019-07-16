<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableUserProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
        	$table->string('honorific', 6)->default('mr');
			$table->string('first_name')->default(' ');
			$table->string('last_name')->default(' ');
			$table->date('date_of_birth')->nullable();
			$table->string('country')->default(' ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('user_profiles', function (Blueprint $table) {
		    $table->dropColumn('honorific');
		    $table->dropColumn('first_name');
		    $table->dropColumn('last_name');
		    $table->dropColumn('date_of_birth');
		    $table->dropColumn('country');
	    });
    }
}
