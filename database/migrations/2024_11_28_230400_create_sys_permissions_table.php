<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sys_permissions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->integer('role_id')->nullable(); // INT
            $table->integer('id_menu')->nullable(); // INT
            $table->integer('is_trash')->nullable()->default(0)->comment('0. aktif 1. deleted');
            $table->integer('v')->nullable()->default(0)->comment('view'); // INT
            $table->integer('c')->nullable()->default(0)->comment('create'); // INT
            $table->integer('r')->nullable()->default(0)->comment('read'); // INT
            $table->integer('u')->nullable()->default(0)->comment('update'); // INT
            $table->integer('d')->nullable()->default(0)->comment('delete'); // INT
            $table->timestamp('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            // Set primary key
            $table->primary('id');
        });

        // Set charset and collation for the table
        DB::statement('ALTER TABLE sys_permissions CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sys_permissions');
    }
};
