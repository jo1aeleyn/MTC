<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->string('recommended_by')->nullable()->after('partner_deduction');
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
            $table->dropColumn('recommended_by');
        });
    }
};
