<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('CompanyPositions_tbl', function (Blueprint $table) {
            $table->id(); // This automatically creates an auto-increment BIGINT PRIMARY KEY
            $table->uuid('uuid')->unique();
            $table->string('Position_name')->unique();
            $table->boolean('IsArchived')->default(false);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->unsignedBigInteger('archived_by')->nullable();
            $table->timestamp('date_of_archived')->nullable();
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('CompanyPositions_tbl');
    }
};
