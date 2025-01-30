<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('user_accounts_tbl', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('user_role');
            $table->boolean('is_archived')->default(false);
            $table->unsignedBigInteger('archived_by')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_accounts_tbl');
    }
}
