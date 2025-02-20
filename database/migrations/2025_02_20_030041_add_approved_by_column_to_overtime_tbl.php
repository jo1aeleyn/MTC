<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->string('approved_by')->nullable()->after('approved_date');
        });
    }
    
    public function down()
    {
        Schema::table('overtime_tbl', function (Blueprint $table) {
            $table->dropColumn('approved_by');
        });
    }
    
};