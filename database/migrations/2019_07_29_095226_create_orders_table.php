<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('host');
            $table->string('favicon_url');

            $table->decimal('price');
            $table->enum('status', [
                \App\Model\Order::STATUS_NEW,
                \App\Model\Order::STATUS_IN_PROGRESS,
                \App\Model\Order::STATUS_CANCELLED,
                \App\Model\Order::STATUS_PAID,
                \App\Model\Order::STATUS_REFUND,
                \App\Model\Order::STATUS_CLOSED
            ]);

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
        Schema::dropIfExists('orders');
    }
}
