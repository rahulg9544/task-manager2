<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('title');
            $blueprint->text('description')->nullable();
            $blueprint->string('priority')->default('low'); // Use Enum values
            $blueprint->string('status')->default('pending'); // Use Enum values
            $blueprint->date('due_date');
            $blueprint->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $blueprint->text('ai_summary')->nullable();
            $blueprint->string('ai_priority')->nullable(); // Optional if AI calculates differently
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
