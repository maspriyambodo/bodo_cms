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
        Schema::create('mt_kelurahan', function (Blueprint $table) {
            $table->bigInteger('id_kelurahan')->primary();
            $table->integer('id_kecamatan')->index(); // Foreign key to mt_kecamatan
            $table->tinyText('nama')->charset('utf8mb4')->collation('utf8mb4_general_ci');
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted'); // Kolom `is_trash`
            $table->geometry('coordinates')->nullable()->comment('longitude, latitude');
            $table->timestamps(); // Membuat kolom `created_at` dan `updated_at`
            $table->integer('created_by')->nullable(); // Kolom `created_by`
            $table->integer('updated_by')->nullable(); // Kolom `updated_by`
//            $table->foreign('id_kecamatan')->references('id_kecamatan')->on('mt_kecamatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mt_kelurahan');
    }
};
