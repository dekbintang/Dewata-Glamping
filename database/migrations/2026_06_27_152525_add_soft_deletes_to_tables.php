<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('unit_glamping', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->softDeletes();
        });

        if (Schema::hasTable('fnb_menus')) {
            Schema::table('fnb_menus', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        Schema::table('unit_glamping', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        if (Schema::hasTable('fnb_menus')) {
            Schema::table('fnb_menus', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};
