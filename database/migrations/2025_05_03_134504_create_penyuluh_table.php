<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyuluhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt_penyuluh', function (Blueprint $table) {
            $table->id(); // This will create an auto-incrementing 'id' column
            $table->integer('urut')->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('nipa', 20)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama', 255)->nullable();
            $table->string('agama', 255)->nullable();
            $table->string('tempat_lahir', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('tugas_provinsi', 255)->nullable();
            $table->string('tugas_kabupaten', 255)->nullable();
            $table->string('tugas_kecamatan', 255)->nullable();
            $table->string('tugas_kua', 255)->nullable();
            $table->enum('status_pegawai', ['PNS', 'NON PNS'])->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('pendidikan', 255)->nullable();
            $table->string('jurusan', 255)->nullable();
            $table->string('organisasi', 255)->nullable();
            $table->text('spesialisasi')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('swafoto', 255)->nullable();
            $table->integer('status')->nullable();
            $table->string('aktivasi', 255)->nullable();
            $table->string('verifikator', 20)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->timestamps(); // This will create 'created_at' and 'updated_at' columns

            // Indexes
            $table->index('nipa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dt_penyuluh');
    }
}