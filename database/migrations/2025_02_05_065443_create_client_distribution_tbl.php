<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDistributionTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_distribution_tbl', function (Blueprint $table) {
            $table->id(); // Primary Key 'id'
            $table->uuid('uuid'); // Foreign key referencing 'uuid' from client_tbl
            $table->string('client_id'); // Foreign key referencing 'client_id' from client_tbl
            $table->string('company_name'); // Company Name
            $table->text('delivery_address'); // Delivery Address
            $table->string('contact_person'); // Contact Person (Receiver of documents)
            $table->string('mobile_number'); // Mobile Number
            $table->string('email_address'); // Email Address
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
        Schema::dropIfExists('client_distribution_tbl');
    }
}
