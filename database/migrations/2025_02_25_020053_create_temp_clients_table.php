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
    Schema::create('temp_client_tbl', function (Blueprint $table) {
        $table->id(); // Primary Key (Auto Increment)
        $table->string('emp_num'); // Employee Number
        $table->string('requested_by'); // User ID who requested
        $table->string('DepartmentID'); // Department ID
        $table->string('client_id'); // Client ID
        $table->string('status'); // Status of the request
        $table->text('purpose'); // Purpose of the request
        $table->timestamps(); // Created_at & Updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_client_tbl');
    }
};
