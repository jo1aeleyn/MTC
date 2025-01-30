<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employee_tbl', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('emp_num')->unique();
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('nickname')->nullable();
            $table->date('birthdate');
            $table->string('birthplace')->nullable();
            $table->integer('age');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('nationality');
            $table->string('religion')->nullable();
            $table->string('blood_type')->nullable();
            $table->text('address');
            $table->string('contact_num');
            $table->string('email')->unique();
            $table->string('tin_num')->nullable();
            $table->string('sss_num')->nullable();
            $table->string('pag_ibig_num')->nullable();
            $table->string('philhealth_num')->nullable();
            $table->string('tax_status')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->unsignedBigInteger('archived_by')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_tbl');
    }
}
