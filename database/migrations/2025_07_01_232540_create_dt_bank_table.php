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
        Schema::create('dt_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 255)->nullable();
            $table->string('kode', 3)->nullable();
            $table->string('logo', 255)->nullable();
            $table->integer('is_trash')->default(0)->comment('0. aktif 1. deleted');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            // If you want to set the initial AUTO_INCREMENT value to 155,
            // you will need to do this via a raw SQL statement after creation.
        });

        // Set AUTO_INCREMENT to 155
        DB::statement('ALTER TABLE dt_bank AUTO_INCREMENT = 155;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dt_bank');
    }
};
