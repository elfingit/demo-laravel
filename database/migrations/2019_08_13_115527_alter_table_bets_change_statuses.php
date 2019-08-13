<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableBetsChangeStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('ALTER TABLE bets DROP CONSTRAINT bets_status_check');
        \DB::statement('ALTER TABLE bets ADD CONSTRAINT bets_status_check check ((status)::text = ANY
                   ((ARRAY [\'paid\'::character varying, 
                   \'waiting_draw\'::character varying, 
                   \'played\'::character varying, 
                   \'win\'::character varying, 
                   \'refund\'::character varying, 
                   \'auth_pending\'::character varying, 
                   \'not_auth\'::character varying, 
                   \'payout_pending\'::character varying, 
                   \'payout\'::character varying, 
                   \'cancelled\'::character varying, 
                   \'closed\'::character varying])::text[]))');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
