<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('company_tbl', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->date('AccessCard_release')->nullable();
            $table->date('AccesCard_return')->nullable();
            $table->string('CompanyEmail')->unique();
            $table->string('PayrollAccount')->nullable();
            $table->string('Cocolife_HMO')->nullable();
            $table->date('Cocolife_ReleaseDate')->nullable();
            $table->date('Cocolife_ReturnDate')->nullable();
            $table->foreign('emp_num')->references('emp_num')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_tbl');
    }
};
