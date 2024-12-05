<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('sys_param', function (Blueprint $table) {
            $table->string('id', 32)->primary(); // VARCHAR(32) as primary key
            $table->string('param_group', 32)->nullable(); // VARCHAR(32)
            $table->string('param_value', 32)->nullable(); // VARCHAR(32)
            $table->string('param_desc', 128)->nullable(); // VARCHAR(128)
            $table->integer('is_trash')->nullable()->default(0)->comment('0. aktif 1. deleted');
            $table->timestamp('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            // Unique key for 'id' is already set as primary key
        });

        // Set charset and collation for the table
        DB::statement('ALTER TABLE sys_param CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;ALTER TABLE `laracms`.`sys_param` ADD UNIQUE INDEX(`id`) USING BTREE;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('sys_param');
    }
};
