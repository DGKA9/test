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
        Schema::create('detail__products', function (Blueprint $table) {
            $table->uuid('productID');
            $table->uuid('orderID');
            $table->timestamps();

            $table->primary(['productID', 'orderID']);
            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('orderID')->references('orderID')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail__products');
    }
};
