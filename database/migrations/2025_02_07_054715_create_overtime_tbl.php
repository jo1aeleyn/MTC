<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_tbl', function (Blueprint $table) {
            $table->id();  // Auto-increment primary key
            $table->uuid('uuid')->unique();  // Unique UUID for identification
            $table->string('emp_num');  // Employee number
            $table->string('emp_name');
            $table->string('client_name');
            $table->date('date_filed');
            $table->integer('number_of_hours');
            $table->text('purpose')->nullable();
            
            $table->string('requested_by');
            $table->dateTime('request_date');
            
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_date')->nullable();

            $table->boolean('approved_wt_pay')->default(false);
            $table->boolean('approved_wo_pay')->default(false);
            $table->boolean('disapproved')->default(false);
            $table->text('reason')->nullable();
            
            $table->boolean('is_archived')->default(false);
            $table->string('archived_by')->nullable();
            $table->string('created_by');
            $table->dateTime('created_at');  // Explicit datetime column for created_at
            $table->dateTime('updated_at');  // Explicit datetime column for updated_at
            $table->string('edited_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overtime_tbl');
    }
};
