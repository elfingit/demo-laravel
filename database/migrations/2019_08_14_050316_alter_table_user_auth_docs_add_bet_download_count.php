<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserAuthDocsAddBetDownloadCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_auth_docs', function (Blueprint $table) {
            $table->unsignedBigInteger('bet_id')->nullable();
            $table->unsignedMediumInteger('download_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_auth_docs', function (Blueprint $table) {
            $table->dropColumn(['bet_id', 'download_count']);
        });
    }
}
