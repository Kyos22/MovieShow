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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('idCustomer');
           $table->foreign('idCustomer')->references('id')->on('accounts');
           $table->unsignedBigInteger('idPackage');
           $table->foreign('idPackage')->references('id')->on('packages');
           $table->integer('quantity')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
