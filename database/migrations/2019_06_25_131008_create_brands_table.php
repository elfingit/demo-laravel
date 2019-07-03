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

            $table->boolean('jackpot_multiplier');
            $table->boolean('number_shield');

            $table->json('default_quick_pick');

            $table->unsignedMediumInteger('primary_pool');
            $table->unsignedMediumInteger('primary_pool_combination');
            $table->unsignedMediumInteger('special_pool')->nullable();
            $table->unsignedMediumInteger('special_pool_combination')->nullable();
            $table->string('name_of_special_pool')->nullable();

            $table->boolean('duration');
            $table->boolean('subscription');
            $table->boolean('jackpot_hut');
            $table->boolean('participation');
            $table->boolean('extra_game');

            //$table->unsignedInteger('refresh_data_time')->default(0);

            //$table->string('country')->nullable();
            //$table->string('state')->nullable();

            /*$table->unsignedMediumInteger('main_min')->default(0);
            $table->unsignedMediumInteger('main_max')->default(0);
            $table->unsignedMediumInteger('main_drawn')->default(0);

            $table->unsignedMediumInteger('bonus_min')->default(0);
            $table->unsignedMediumInteger('bonus_max')->default(0);
            $table->unsignedMediumInteger('bonus_drawn')->default(0);

			$table->enum('same_balls', ['Y', 'N'])->default('N');

	        $table->unsignedMediumInteger('digits')->default(0);
	        $table->unsignedMediumInteger('drawn')->default(0);

	        $table->string('option_desc')->nullable();*/

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
