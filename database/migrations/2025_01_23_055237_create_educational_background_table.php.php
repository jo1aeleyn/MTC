<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalBackgroundTable extends Migration
{
    public function up()
    {
        Schema::create('educational_bg_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->string('level');
            $table->string('school');
            $table->string('degree')->nullable();
            $table->year('year_attended_from');
            $table->year('year_attended_to');
            $table->string('honors_received')->nullable();
            $table->foreign('emp_num')->references('emp_num')->on('employee_tbl')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('educational_bg_tbl');
    }
}
