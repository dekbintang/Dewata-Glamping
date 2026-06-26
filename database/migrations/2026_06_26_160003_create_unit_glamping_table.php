<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_glamping', function (Blueprint $table) {
            $table->id('unit_id');
            $table->string('unit_name');
            $table->enum('unit_type', ['tent', 'cabin', 'dome', 'treehouse']);
            $table->decimal('price_per_night', 12, 2);
            $table->enum('status', ['available', 'occupied', 'maintenance', 'cleaning'])->default('available');
            $table->text('description')->nullable();
            $table->integer('capacity')->default(2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unit_glamping');
    }
};
