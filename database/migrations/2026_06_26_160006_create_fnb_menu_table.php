<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fnb_menu', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name');
            $table->enum('category', ['food', 'beverage', 'snack']);
            $table->decimal('price', 10, 2);
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fnb_menu');
    }
};
