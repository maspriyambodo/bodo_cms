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
        Schema::create('mt_direktorat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 255)
                  ->nullable()
                  ->collation('utf8mb4_general_ci')
                  ->comment('nama_direktorat');
            $table->integer('is_trash')
                  ->default(0)
                  ->comment('0. aktif 1. deleted');
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
        Schema::dropIfExists('mt_direktorat');
    }
};
