<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateBiodataPesertaView extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW vw_biodata_peserta AS
            SELECT 
                tr_biodata_peserta.id AS id_peserta,
                tr_biodata_peserta.id_kegiatan AS id_kegiatan,
                dt_kegiatan.nama AS nama_kegiatan,
                dt_kegiatan.slug AS slug,
                tr_biodata_peserta.nama AS nama_peserta,
                tr_biodata_peserta.tempat_lahir AS tempat_lahir,
                tr_biodata_peserta.tanggal_lahir AS tanggal_lahir,
                tr_biodata_peserta.alamat AS alamat,
                tr_biodata_peserta.no_hp AS no_hp,
                tr_biodata_peserta.utusan AS utusan,
                tr_biodata_peserta.jabatan AS jabatan,
                tr_biodata_peserta.alamat_kantor AS alamat_kantor,
                tr_biodata_peserta.no_rekening AS no_rekening,
                tr_biodata_peserta.atas_nama_rek AS atas_nama_rek,
                tr_biodata_peserta.ttd AS ttd,
                dt_bank.nama AS nama_bank
            FROM tr_biodata_peserta
            JOIN dt_kegiatan ON tr_biodata_peserta.id_kegiatan = dt_kegiatan.id
            JOIN dt_bank ON tr_biodata_peserta.id_bank = dt_bank.id
        ");
    }

    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vw_biodata_peserta');
    }
}
