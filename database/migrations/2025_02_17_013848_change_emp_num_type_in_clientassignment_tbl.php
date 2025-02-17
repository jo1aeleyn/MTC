<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEmpNumTypeInClientassignmentTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            // Change the column type of emp_num to VARCHAR
            $table->string('emp_num')->change();
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
            // Revert back to integer if necessary
            $table->integer('emp_num')->change();
        });
    }
}
