<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('damageimages', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->foreignId('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('damageId')->references('id')->on('damagedocumentations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
