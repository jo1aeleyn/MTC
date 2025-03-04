<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('financial_req_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_req_id')->constrained('financial_reqs')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('financial_req_images');
    }
};

