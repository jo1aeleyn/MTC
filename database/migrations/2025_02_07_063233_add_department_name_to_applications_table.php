<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentNameToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Adding the DepartmentName column as a string
            $table->string('DepartmentName')->nullable(); // Use nullable if the field can be empty
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            // Drop the DepartmentName column if the migration is rolled back
            $table->dropColumn('DepartmentName');
        });
    }
}
