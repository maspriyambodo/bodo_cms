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
        Schema::create('user_groups', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');
            $table->id(); // Auto-incrementing ID
            $table->string('name')->nullable(); // VARCHAR(255)
            $table->string('description')->nullable(); // VARCHAR(255)
            $table->integer('is_trash')->nullable()->comment('0. aktif 1. deleted'); // INT
            $table->timestamp('created_at')->nullable(); // TIME
            $table->integer('created_by')->nullable(); // INT
            $table->timestamp('updated_at')->nullable(); // TIMESTAMP
            $table->integer('updated_by')->nullable(); // INT
            
            $table->primary('id'); // Set primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groups');
    }
};
