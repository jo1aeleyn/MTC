<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('WFH_tbl', function (Blueprint $table) {
            // Rename client_id to client_name
            $table->renameColumn('client_id', 'client_name');

            // Change the column type to VARCHAR (string)
            $table->string('client_name')->change();
        });
    }

    public function down()
    {
        Schema::table('WFH_tbl', function (Blueprint $table) {
            // Revert back to integer and rename back to client_id
            $table->integer('client_name')->change();
            $table->renameColumn('client_name', 'client_id');
        });
    }
};
