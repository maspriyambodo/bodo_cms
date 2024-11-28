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
            $table->id(); // Auto-incrementing ID
            $table->string('name')->nullable()->collate('utf8mb4_general_ci'); // VARCHAR(255) with collation
            $table->string('description')->nullable()->collate('utf8mb4_general_ci'); // VARCHAR(255) with collation
            $table->integer('is_trash')->nullable()->comment('0. aktif 1. deleted'); // INT
            $table->timestamp('created_at')->nullable(); // TIMESTAMP
            $table->integer('created_by')->nullable(); // INT
            $table->timestamp('updated_at')->nullable(); // TIMESTAMP
            $table->integer('updated_by')->nullable(); // INT
            
            $table->primary('id'); // Set primary key
        });

        // Set charset and collation for the table
        DB::statement('ALTER TABLE user_groups CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_groups');
    }
};
