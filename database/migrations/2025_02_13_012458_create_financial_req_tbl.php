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
        Schema::create('FinancialReq_tbl', function (Blueprint $table) {
            $table->id();                              // Auto-incremented primary key
            $table->uuid('uuid')->unique();            // UUID column
            $table->string('emp_num', 50);             // Employee number
            $table->string('payee', 255)->nullable();  // Payee
            $table->string('Chargeto', 255)->nullable();
            $table->string('PaymentForm', 50)->nullable();
            $table->string('RequestType', 100)->nullable();
            $table->decimal('Ammount', 18, 2)->nullable();
            $table->text('purpose')->nullable();
            $table->string('RequestedBy', 100)->nullable();
            $table->string('ApprovedBy', 100)->nullable();
            $table->string('PaymentReceivedBy', 100)->nullable();
            $table->date('Date')->nullable();
            $table->timestamps();                      // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FinancialReq_tbl');
    }
};
