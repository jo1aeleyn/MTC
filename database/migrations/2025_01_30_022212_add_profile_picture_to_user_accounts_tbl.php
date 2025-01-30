<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('user_accounts_tbl', function (Blueprint $table) {
        $table->string('profile_picture')->nullable(); // For storing the filename of the profile picture
    });
}

public function down()
{
    Schema::table('user_accounts_tbl', function (Blueprint $table) {
        $table->dropColumn('profile_picture');
    });
}

};
