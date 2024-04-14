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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('namePackage');
            $table->decimal('pricePerMonth');
            $table->boolean('flixTVOriginals')->default(false);
            $table->boolean('flexiblePlan')->default(false);
            $table->boolean('streamLive')->default(false);
            $table->boolean('tvChannels')->default(false);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
