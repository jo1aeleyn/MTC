<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateClientTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_tbl', function (Blueprint $table) {
            $table->id(); // Primary Key - 'id'
            $table->uuid('uuid')->unique(); // Unique UUID for each record
            $table->string('client_id')->unique(); // Unique ClientID
            $table->string('registered_company_name'); // Registered Company Name
            $table->text('registered_address'); // Registered Address
            $table->year('engagement_year'); // Engagement Year
            $table->enum('type_of_engagement', ['Accounting', 'Agreed-upon', 'Audit', 'Tax']); // Type of Engagement
            $table->string('authorized_personnel'); // Authorized Personnel
            $table->string('position_of_authorized_personnel'); // Position of Authorized Personnel
            $table->string('email_address_of_authorized_personnel'); // Email Address of Authorized Personnel
            $table->decimal('revenue_for_current_year', 15, 2); // Revenue for Current Year
            $table->string('prior_years_auditor')->nullable(); // Prior Year's Auditor (nullable if not MTC)
            $table->timestamps(); // Created at and updated at timestamps

            // Automatically generate UUIDs when a new client is created
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
        Schema::dropIfExists('client_tbl');
    }
}
