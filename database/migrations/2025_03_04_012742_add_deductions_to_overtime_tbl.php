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
            $table->double('sup_deduction')->nullable()->after('DeductedDuration');
            $table->double('partner_deduction')->nullable()->after('sup_deduction');
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
            $table->dropColumn(['sup_deduction', 'partner_deduction']);
        });
    }
};
