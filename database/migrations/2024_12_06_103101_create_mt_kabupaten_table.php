<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mt_kabupaten', function (Blueprint $table) {
            $table->integer('id_kabupaten')->primary();
            $table->integer('id_provinsi')->index(); // Foreign key to mt_provinsi
            $table->tinyText('nama')->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted'); // Kolom `is_trash`
            $table->double('latitude')->default(0)->nullable();
            $table->double('longitude')->default(0)->nullable();
            $table->timestamps(); // Membuat kolom `created_at` dan `updated_at`
            $table->integer('created_by')->nullable(); // Kolom `created_by`
            $table->integer('updated_by')->nullable(); // Kolom `updated_by`
//            $table->foreign('id_provinsi')->references('id_provinsi')->on('mt_provinsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kabupaten');
    }
};
