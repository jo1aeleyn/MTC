<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->string('activitycode')->after('existing_column')->nullable();
            $table->string('activityname')->after('activitycode')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->dropColumn(['activitycode', 'activityname']);
        });
    }
};
