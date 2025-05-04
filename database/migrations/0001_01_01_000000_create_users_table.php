<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Membuat kolom `id` sebagai BIGINT UNSIGNED AUTO_INCREMENT
            $table->integer('role')->nullable(false); // Kolom `role`
            $table->string('name')->nullable(false); // Kolom `name` tidak boleh NULL
            $table->string('email')->unique(); // Kolom `email` dengan UNIQUE constraint
            $table->integer('id_provinsi')->nullable(); // Kolom `is_trash`
            $table->integer('id_kabupaten')->nullable(); // Kolom `is_trash`
            $table->integer('id_kecamatan')->nullable(); // Kolom `is_trash`
            $table->bigInteger('id_kelurahan')->nullable(); // Kolom `is_trash`
            $table->string('pict')->default('src/media/avatars/blank.png')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Kolom `email_verified_at`
            $table->string('password'); // Kolom `password`
            $table->string('remember_token', 100)->nullable(); // Kolom `remember_token`
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted'); // Kolom `is_trash`
            $table->timestamps(); // Membuat kolom `created_at` dan `updated_at`
            $table->integer('created_by')->nullable(); // Kolom `created_by`
            $table->integer('updated_by')->nullable(); // Kolom `updated_by`
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
