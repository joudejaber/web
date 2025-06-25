<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('damage_images', function (Blueprint $table) {
        $table->id();
        $table->foreignId('damage_id')->constrained('damages')->onDelete('cascade'); // Link to the 'damages' table
        $table->string('image_path'); // Store the path of the uploaded image
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_images');
    }
};
