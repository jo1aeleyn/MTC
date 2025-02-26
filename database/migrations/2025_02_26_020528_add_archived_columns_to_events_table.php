<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('IsArchived')->default(0);
            $table->unsignedBigInteger('ArchivedBy')->nullable();
            $table->timestamp('ArchivedDate')->nullable();
            
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['IsArchived', 'ArchivedBy', 'ArchivedDate']);
        });
    }
};

