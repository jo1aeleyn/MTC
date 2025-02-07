<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('DepartmentID')->unique();
            $table->uuid('uuid')->unique();
            $table->string('DepartmentName');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by');
            $table->boolean('archived')->default(false);
            $table->unsignedBigInteger('archived_by')->nullable();
            $table->timestamp('date_of_archived')->nullable();
            $table->timestamps();

            // Optionally, you can add foreign key constraints for the 'created_by' and 'edited_by' fields if they reference the users table
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('edited_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
