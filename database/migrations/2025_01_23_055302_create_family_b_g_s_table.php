<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyBgsTable extends Migration
{
    public function up()
    {
        Schema::create('family_bg_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->string('name');
            $table->string('relationship');
            $table->string('occupation')->nullable();
            $table->date('birthdate')->nullable();
            $table->integer('age')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->foreign('emp_num')->references('emp_num')->on('employee_tbl')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_bg_tbl');
    }
}
