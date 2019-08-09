<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth_docs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('file_name');
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_rejected')->default(false);

            $table->string('type')->default('ID');

            $table->text('comments')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('user_id')
                    ->on('users')
                    ->references('id')
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
        Schema::dropIfExists('user_auth_docs');
    }
}
