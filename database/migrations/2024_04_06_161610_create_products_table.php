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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('productID')->primary();
            $table->string('productName');
            $table->string('productImage');
            $table->string('productPrice');
            $table->string('productQuantity');
            $table->string('productDescription');
            $table->uuid('productTypeID');
            $table->uuid('supplierID');
            $table->timestamps();

            $table->foreign('productTypeID')->references('productTypeID')->on('product_types')->onDelete('cascade');
            $table->foreign('supplierID')->references('supplierID')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
