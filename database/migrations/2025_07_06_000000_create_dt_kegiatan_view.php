<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDtKegiatanView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_dt_kegiatan AS
            SELECT 
                dt_kegiatan.id AS id,
                dt_kegiatan.nama AS nama,
                dt_kegiatan.direktorat AS direktorat,
                dt_kegiatan.tanggal_mulai_kegiatan AS tanggal_mulai_kegiatan,
                dt_kegiatan.tanggal_selesai_kegiatan AS tanggal_selesai_kegiatan,
                CONCAT(
                    IFNULL(CONCAT(mt_provinsi.nama, ', '), ''),
                    IFNULL(CONCAT(mt_kabupaten.nama, ', '), ''),
                    IFNULL(CONCAT(mt_kecamatan.nama, ', '), ''),
                    IFNULL(CONCAT(mt_kelurahan.nama, ', '), ''),
                    dt_kegiatan.lokasi_acara
                ) AS lokasi_acara,
                dt_kegiatan.link_biodata AS link_biodata,
                dt_kegiatan.is_trash AS is_trash
            FROM dt_kegiatan
            JOIN mt_provinsi ON dt_kegiatan.provinsi = mt_provinsi.id_provinsi
            JOIN mt_kabupaten ON dt_kegiatan.kabupaten = mt_kabupaten.id_kabupaten
            JOIN mt_kecamatan ON dt_kegiatan.kecamatan = mt_kecamatan.id_kecamatan
            JOIN mt_kelurahan ON dt_kegiatan.kelurahan = mt_kelurahan.id_kelurahan
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vw_dt_kegiatan");
    }
}
