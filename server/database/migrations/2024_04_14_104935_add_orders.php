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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCustomer');
            $table->foreign('idCustomer')->references('id')->on('accounts');
            $table->unsignedBigInteger('idPackage');
            $table->foreign('idPackage')->references('id')->on('packages');
            $table->unsignedBigInteger('idCart');
            $table->foreign('idCart')->references('id')->on('carts');
            $table->datetime('startDate')->useCurrent();
            $table->datetime('endDate')->useCurrent();
            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
