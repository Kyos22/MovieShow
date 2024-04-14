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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_id');
            $table->string('payer_id');
            $table->string('payer_email');
            $table->float('amount', 10, 2);/*10 là tổng số chữ số mà trường này có thể lưu trữ (độ chính xác), bao gồm cả phần thập phân.
            2 là số chữ số sau dấu phẩy thập phân (quy mô), tức là bạn có thể lưu trữ các giá trị với hai chữ số thập phân.*/
            $table->string('currency');
            $table->string('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
