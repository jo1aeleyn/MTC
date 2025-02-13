<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('leaves_tbl', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('emp_num');
            $table->string('name');
            $table->date('DateOfLeave');
            $table->integer('TotalDays');
            $table->string('TypeOfLeave');
            $table->text('Remarks')->nullable();
            $table->string('Status')->default('Pending');
            $table->text('ReasonForDisapproved')->nullable();
            $table->string('ReviewedBy')->nullable();
            $table->dateTime('ReviewedDate')->nullable();
            $table->integer('LeavesCredits')->default(0);
            $table->integer('LessApproedDays')->default(0);
            $table->integer('RemainingLeaves')->default(0);
            $table->boolean('WithPay')->default(false);
            $table->boolean('WithoutPay')->default(false);
            $table->string('FilledUpBy');
            $table->dateTime('FilledUpDate');
            $table->boolean('IsArchived')->default(false);
            $table->dateTime('DateOfArchived')->nullable();
            $table->string('EditedBy')->nullable();
            $table->string('CreatedBy');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaves_tbl');
    }
};
