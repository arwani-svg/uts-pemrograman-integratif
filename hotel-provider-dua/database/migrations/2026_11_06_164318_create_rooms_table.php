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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name'); // Contoh: "Hotel Santika" atau "Grand Luxury"
            $table->string('room_type');  // Contoh: "Deluxe Room", "Suite Room"
            $table->decimal('price', 12, 2);
            $table->integer('stock');     // Stok kamar aktual di hotel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
