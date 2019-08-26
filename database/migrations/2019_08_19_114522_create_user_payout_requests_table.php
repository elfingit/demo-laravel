<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayoutRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payouts');

        Schema::create('user_payout_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');

            $table->enum('status', [
                \App\Model\UserPayoutRequest::STATUS_PENDING,
                \App\Model\UserPayoutRequest::STATUS_DECLINED,
                \App\Model\UserPayoutRequest::STATUS_APPROVED
            ]);

            $table->decimal('amount', 12, 2);

            $table->enum('type', [
                \App\Model\UserPayoutRequest::TYPE_EXTERNAL,
                \App\Model\UserPayoutRequest::TYPE_INTERNAL
            ]);

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
        Schema::dropIfExists('user_payout_requests');
    }
}
