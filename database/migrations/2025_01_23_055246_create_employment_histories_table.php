<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('employment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('emp_num');
            $table->date('date');
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->string('superior');
            $table->string('department');
            $table->string('address');
            $table->string('company');
            $table->string('telephone');
            $table->text('reason_for_leaving');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_histories');
    }
}
