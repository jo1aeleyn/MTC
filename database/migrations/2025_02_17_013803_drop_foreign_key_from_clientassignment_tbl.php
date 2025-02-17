<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyFromClientassignmentTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['emp_num']);
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
            // Re-add the foreign key constraint (if necessary)
            $table->foreign('emp_num')->references('emp_num')->on('employees');
        });
    }
}
