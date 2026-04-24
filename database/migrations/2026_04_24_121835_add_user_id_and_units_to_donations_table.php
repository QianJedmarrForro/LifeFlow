<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {

            if (!Schema::hasColumn('donations', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }

            if (!Schema::hasColumn('donations', 'units')) {
                $table->integer('units')->default(0);
            }

        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {

            if (Schema::hasColumn('donations', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('donations', 'units')) {
                $table->dropColumn('units');
            }

        });
    }
};