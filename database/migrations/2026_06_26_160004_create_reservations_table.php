<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id');
            $table->foreignId('unit_id')->constrained('unit_glamping', 'unit_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->string('booking_code')->unique();
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->decimal('dp_amount', 12, 2)->nullable();
            $table->string('special_request')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
