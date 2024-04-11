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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('nameMovie');
            $table->string('discription')->nullable();
            $table->integer('releaseYear');
            $table->integer('runningTime');
            $table->unsignedBigInteger('qualifiction');
            $table->foreign('qualifiction')->references('id')->on('qualify');
            $table->integer('limitedAge');
            $table->string('countries');
            $table->unsignedBigInteger('genre');
            $table->foreign('genre')->references('id')->on('genre');
            $table->string('photoDetail');
            $table->string('photoThumbnail');
            $table->string('type')->nullable();
            $table->string('video');
            $table->string('trailer')->nullable();
            $table->integer('idAdmin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre');
    }
};
