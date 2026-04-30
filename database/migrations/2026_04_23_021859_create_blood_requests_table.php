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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('hospital');
            $table->string('blood_type');
            $table->integer('units');
            $table->string('priority');
            $table->date('needed_by');
            $table->string('patient_name');
            $table->text('reason')->nullable(); // Set to nullable in case reason is empty
            
            // --- THE FIX: ADD THIS COLUMN ---
            $table->string('status')->default('pending'); 
            // --------------------------------
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};