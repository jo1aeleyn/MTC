<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToOvertimeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Add the status column with a default value of 'pending'
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
            $table->dropColumn('status'); // Drop the status column in case of rollback
        });
    }
}
