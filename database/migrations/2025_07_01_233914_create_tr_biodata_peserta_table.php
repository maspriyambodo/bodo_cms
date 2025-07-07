<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tr_biodata_peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kegiatan')->nullable();
            $table->string('nama', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('tempat_lahir', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('no_hp', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('utusan', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('jabatan', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('alamat_kantor', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('no_rekening', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->integer('id_bank')->nullable();
            $table->string('atas_nama_rek', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->string('ttd', 255)->nullable()->collation('utf8mb4_general_ci');
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
        Schema::dropIfExists('tr_biodata_peserta');
    }
};
