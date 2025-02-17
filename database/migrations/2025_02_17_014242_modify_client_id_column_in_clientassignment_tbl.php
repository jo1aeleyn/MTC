<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyClientIdColumnInClientassignmentTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            $table->string('client_id', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            $table->integer('client_id')->change();  // Revert back to INT if needed
        });
    }
}
