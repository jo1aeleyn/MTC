<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('user_accounts_tbl', function (Blueprint $table) {
            $table->string('email')->unique()->after('username');
        });
    }

    public function down()
    {
        Schema::table('user_accounts_tbl', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};
