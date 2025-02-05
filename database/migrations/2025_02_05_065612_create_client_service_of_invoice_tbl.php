<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientServiceOfInvoiceTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_service_of_invoice_tbl', function (Blueprint $table) {
            $table->id(); // Primary Key 'id'
            $table->uuid('uuid'); // Foreign key referencing 'uuid' from client_tbl
            $table->string('client_id'); // Foreign key referencing 'client_id' from client_tbl
            $table->string('company_name'); // Registered Company Name
            $table->text('registered_address'); // Registered Address
            $table->string('tax_identification_number'); // Tax Identification Number
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign Key Constraints
            $table->foreign('uuid')->references('uuid')->on('client_tbl')->onDelete('cascade');
            $table->foreign('client_id')->references('client_id')->on('client_tbl')->onDelete('cascade');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_service_of_invoice_tbl');
    }
}
