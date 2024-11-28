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
        Schema::create('sys_menu', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing id column
            $table->integer('menu_parent')->nullable();
            $table->string('nama', 50)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->string('link', 255)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->integer('order_no')->nullable();
            $table->integer('group_menu')->nullable()->comment('1. applications\r\n2. report\r\n3. systems');
            $table->string('icon', 50)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->string('description', 255)->nullable()->charset('utf8mb4')->collation('utf8mb4_bin');
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted');
            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->primary('id'); // Set the primary key
        });
        DB::statement('ALTER TABLE sys_menu CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sys_menu');
    }
};
