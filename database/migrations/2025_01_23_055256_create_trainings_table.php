<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends Migration
{
    public function up()
    {
        Schema::create('training_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->string('title');
            $table->string('inclusive_dates');
            $table->string('conducted_by');
            $table->string('venue');
            $table->foreign('emp_num')->references('emp_num')->on('employee_tbl')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_tbl');
    }
}
