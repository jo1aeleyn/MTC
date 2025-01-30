<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num'); // Foreign key referencing Employee_tbl
            $table->string('referred_by')->nullable();
            $table->date('date_applied')->nullable();
            $table->date('date_hired')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
            $table->foreign('emp_num')->references('emp_num')->on('employee_tbl')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
