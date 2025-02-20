<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->boolean('WithPay')->default(false)->after('status'); // Adding the WithPay column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->dropColumn('WithPay');
        });
    }
};
