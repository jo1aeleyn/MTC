<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('WFH_tbl', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('emp_num');
            $table->unsignedBigInteger('client_id');
            $table->date('Date_filed');
            $table->date('Date_WFH');
            $table->string('Engagement');
            $table->integer('Budgetted_time');
            $table->text('Details')->nullable();
            $table->text('SummaryOfWorkDone')->nullable();
            $table->time('TimeSubmitted')->nullable();
            $table->string('PreparedBy');
            $table->string('ApprovedBy');
            $table->date('PreparedDate')->nullable();
            $table->date('ApprovedDate')->nullable();
            $table->string('Status');
            $table->text('Reason')->nullable();
            $table->boolean('IsArchived')->default(false);
            $table->date('ArchivedDate')->nullable();
            $table->unsignedBigInteger('CreatedBy');
            $table->unsignedBigInteger('EditedBy')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('WFH_tbl');
    }
};
