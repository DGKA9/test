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
        Schema::create('booking_service', function (Blueprint $table) {
            $table->uuid('bookingID');
            $table->uuid('serviceID');
            $table->timestamps();

            $table->primary(['bookingID', 'serviceID']);
            $table->foreign('bookingID')->references('bookingID')->on('bookings')->onDelete('cascade');
            $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_service');
    }
};
