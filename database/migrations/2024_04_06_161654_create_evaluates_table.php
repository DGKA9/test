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
        Schema::create('evaluates', function (Blueprint $table) {
            $table->uuid('evaluateID')->primary();
            $table->integer('rating');
            $table->string('comment');
            $table->date('lastUpdate');
            $table->uuid('productID');
            $table->uuid('CustomerID');
            $table->timestamps();

            $table->foreign('productID')->references('productID')->on('products')->onDelete('cascade');
            $table->foreign('CustomerID')->references('CustomerID')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluates');
    }
};
