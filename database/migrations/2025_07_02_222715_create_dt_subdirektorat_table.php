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
        Schema::create('dt_subdirektorat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_direktorat'); // Not nullable as per your SQL
            $table->string('nama', 255)->nullable()->collation('utf8mb4_general_ci');
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted'); // Kolom `is_trash`
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            // Optional: Add foreign key constraint if 'mt_direktorat' table exists
            // $table->foreign('id_direktorat')->references('id')->on('mt_direktorat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_subdirektorat');
    }
};
