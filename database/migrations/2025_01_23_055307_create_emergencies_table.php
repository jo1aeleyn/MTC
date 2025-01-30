<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciesTable extends Migration
{
    public function up()
    {
        Schema::create('emergency_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->string('name');
            $table->string('relationship');
            $table->text('address')->nullable();
            $table->string('contact_num');
            $table->foreign('emp_num')->references('emp_num')->on('employee_tbl')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emergency_tbl');
    }
}
