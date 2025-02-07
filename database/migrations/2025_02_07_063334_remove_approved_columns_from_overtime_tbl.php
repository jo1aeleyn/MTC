<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveApprovedColumnsFromOvertimeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->dropColumn(['approved_wt_pay', 'approved_wo_pay', 'disapproved']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->boolean('approved_wt_pay')->default(false);
            $table->boolean('approved_wo_pay')->default(false);
            $table->boolean('disapproved')->default(false);
        });
    }
}
