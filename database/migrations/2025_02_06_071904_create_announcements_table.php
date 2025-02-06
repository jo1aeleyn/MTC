<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            // Create an auto-incrementing primary key 'id'
            $table->id(); 

            // Create UUID column
            $table->uuid('uuid')->unique();
            
            // Custom announcement ID field
            $table->string('announcementID')->unique();
            
            // Announcement title
            $table->string('title');
            
            // Announcement content
            $table->text('content');
            
            // Category for the announcement
            $table->string('category');
            
            // Image column for the announcement
            $table->string('image')->nullable();  // The image field
            
            // Foreign key for the user who created the announcement
            $table->unsignedBigInteger('createdBy');
            $table->unsignedBigInteger('editedBy')->nullable();
            $table->unsignedBigInteger('ArchivedBy')->nullable();

            // Archived status
            $table->boolean('IsArchived')->default(false);
            
            // Timestamps for created and updated dates
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
