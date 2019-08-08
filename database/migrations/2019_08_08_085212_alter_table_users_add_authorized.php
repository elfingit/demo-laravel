<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersAddAuthorized extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_authorized')->default(false);
            $table->boolean('phone_confirmed')->default(false);
            $table->boolean('is_test_account')->default(false);
            $table->boolean('is_fraud_suspected')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_authorized');
            $table->dropColumn('phone_confirmed');
            $table->dropColumn('is_test_account');
            $table->dropColumn('is_fraud_suspected');
        });
    }
}
