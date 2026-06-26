<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('housekeeping', function (Blueprint $table) {
            $table->id('housekeeping_id');
            $table->foreignId('unit_id')->constrained('unit_glamping', 'unit_id');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->enum('status', ['dirty', 'in_progress', 'ready'])->default('dirty');
            $table->timestamp('last_cleaned')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('housekeeping');
    }
};
