<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ClientAssignment_tbl', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // Add UUID column
            $table->foreignId('emp_num')->constrained('employees')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('client_tbl')->onDelete('cascade');
            $table->foreignId('assigned_by')->nullable()->constrained('user_accounts_tbl')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('user_accounts_tbl')->onDelete('set null');
            $table->foreignId('edited_by')->nullable()->constrained('user_accounts_tbl')->onDelete('set null');
            $table->boolean('is_archived')->default(false);
            $table->foreignId('archived_by')->nullable()->constrained('user_accounts_tbl')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ClientAssignment_tbl');
    }
};

