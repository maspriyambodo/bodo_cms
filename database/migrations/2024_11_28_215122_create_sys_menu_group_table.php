<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sys_menu_group', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing id column
            $table->string('nama', 255)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->string('description', 255)->nullable()->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->integer('order_no')->nullable();
            $table->integer('is_trash')->nullable()->comment('0. aktif 1. deleted');
            $table->timestamp('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();

            $table->primary('id'); // Set the primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sys_menu_group');
    }
};
