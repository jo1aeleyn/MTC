<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('client_tbl', function (Blueprint $table) {
            $table->string('NewClient')->nullable();
            $table->string('LAFS')->nullable();
            $table->string('TBCY')->nullable();
            $table->string('BIR_CoR')->nullable();
            $table->boolean('IsArchived')->default(false);
            $table->unsignedBigInteger('ArchivedBy')->nullable();
            $table->dateTime('ArchivedDate')->nullable();
            $table->unsignedBigInteger('CreatedBy')->nullable();
            $table->unsignedBigInteger('EditedBy')->nullable();

            $table->foreign('ArchivedBy')->references('id')->on('users')->onDelete('set null');
            $table->foreign('CreatedBy')->references('id')->on('users')->onDelete('set null');
            $table->foreign('EditedBy')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('client_tbl', function (Blueprint $table) {
            $table->dropForeign(['ArchivedBy']);
            $table->dropForeign(['CreatedBy']);
            $table->dropForeign(['EditedBy']);

            $table->dropColumn([
                'NewClient', 'LAFS', 'TBCY', 'BIR_CoR', 
                'IsArchived', 'ArchivedBy', 'ArchivedDate', 
                'CreatedBy', 'EditedBy'
            ]);
        });
    }
};
