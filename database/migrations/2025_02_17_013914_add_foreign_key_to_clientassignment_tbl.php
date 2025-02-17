<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToClientassignmentTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            $table->foreign('emp_num')->references('emp_num')->on('employees');
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
            $table->dropForeign(['emp_num']);
        });
    }
}
