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
        Schema::create('branches', function (Blueprint $table) {
            $table->uuid('branchID')->primary();
            $table->string('branchName', 100);
            $table->string('branchAddress', 200);
            $table->string('branchPhone', 11);
            $table->uuid('workingHoursID');
            $table->timestamps();

            $table->foreign('workingHoursID')->references('workingHoursID')->on('working__hours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
