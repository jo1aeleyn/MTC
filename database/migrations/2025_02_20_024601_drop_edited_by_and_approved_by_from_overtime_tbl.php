<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropEditedByAndApprovedByFromOvertimeTbl extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            if (Schema::hasColumn('overtime_tbl', 'edited_by')) {
                $table->dropColumn('edited_by');
            }
            if (Schema::hasColumn('overtime_tbl', 'Approvedby')) {
                $table->dropColumn('Approvedby');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            if (!Schema::hasColumn('overtime_tbl', 'edited_by')) {
                $table->string('edited_by')->nullable();
            }
            if (!Schema::hasColumn('overtime_tbl', 'Approvedby')) {
                $table->string('Approvedby')->nullable();
            }
        });
    }
}
