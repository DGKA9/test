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
            $table->uuid('orderID')->primary();
            $table->date('orderDate');
            $table->date('deliveryDate');
            $table->boolean('orderStatus');
            $table->double('totalInvoice');
            $table->uuid('customerID');
            $table->uuid('paymentID');
            $table->timestamps();

            $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('cascade');
            $table->foreign('paymentID')->references('paymentID')->on('payments')->onDelete('cascade');
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
