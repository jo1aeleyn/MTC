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
            $table->dropColumn('number_of_hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->decimal('number_of_hours', 8, 2)->nullable(); // Add back if rollback is needed
        });
    }
};
