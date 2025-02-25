<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            $table->string('client_type')->default('main')->after('client_id'); // Adjust the column position if needed
        });
    }

    public function down()
    {
        Schema::table('clientassignment_tbl', function (Blueprint $table) {
            $table->dropColumn('client_type');
        });
    }
};

