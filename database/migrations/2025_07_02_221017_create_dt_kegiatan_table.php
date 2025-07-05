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
        Schema::create('dt_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->integer('direktorat')->nullable();
            $table->date('tanggal_mulai_kegiatan')->nullable();
            $table->date('tanggal_selesai_kegiatan')->nullable();
            $table->integer('provinsi')->nullable();
            $table->integer('kabupaten')->nullable();
            $table->integer('kecamatan')->nullable();
            $table->integer('kelurahan')->nullable();
            $table->string('lokasi_acara', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('link_biodata', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted'); // Kolom `is_trash`
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_kegiatan');
    }
};
