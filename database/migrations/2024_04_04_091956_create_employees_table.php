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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('employeeID')->primary();
            $table->string('firstName', 50);
            $table->string('lastName', 100);
            $table->string('image');
            $table->date('workDay');
            $table->uuid('branchID');
            $table->uuid('userID');
            $table->timestamps();

            $table->foreign('branchID')->references('branchID')->on('branches')->onDelete('cascade');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
