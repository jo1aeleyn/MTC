<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsArchivedToFinancialReqTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('FinancialReq_tbl', function (Blueprint $table) {
            $table->boolean('IsArchived')->default(false)->after('Date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('FinancialReq_tbl', function (Blueprint $table) {
            $table->dropColumn('IsArchived');
        });
    }
}
