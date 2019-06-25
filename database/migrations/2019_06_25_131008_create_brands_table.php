<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('api_code')->unique();
            $table->string('logo');
            $table->unsignedInteger('refresh_data_time');

            $table->string('country')->nullable();
            $table->string('state')->nullable();

            $table->unsignedMediumInteger('main_min');
            $table->unsignedMediumInteger('main_max');
            $table->unsignedMediumInteger('main_drawn');

            $table->unsignedMediumInteger('bonus_min');
            $table->unsignedMediumInteger('bonus_max');
            $table->unsignedMediumInteger('bonus_drawn');

			$table->enum('same_balls', ['Y', 'N']);

	        $table->unsignedMediumInteger('digits');
	        $table->unsignedMediumInteger('drawn');

	        $table->string('option_desc')->nullable();

	        $table->bigInteger('owner_id')->index();

	        $table->enum('status', [
	        	'in_sync',
		        'synced',
		        'err_sync',
		        'disabled'
	        ]);

            $table->timestamps();

            $table->foreign('owner_id')
	            ->references('id')
	            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
