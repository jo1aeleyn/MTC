<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOvertimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('Approvedby')->nullable();
            $table->decimal('TotalDuration', 8, 2)->nullable();
            $table->decimal('DeductedDuration', 8, 2)->nullable();
            $table->string('Type_of_Day')->nullable();
            $table->string('ActivityCode')->nullable();
            $table->string('ActivityName')->nullable();
            $table->text('reason')->nullable()->change();
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
            $table->dropColumn([
                'start_time',
                'end_time',
                'Approvedby',
                'TotalDuration',
                'DeductedDuration',
                'Type_of_Day',
                'ActivityCode',
                'ActivityName'
            ]);
        });
    }
}
