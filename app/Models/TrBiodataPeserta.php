<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrBiodataPeserta extends Model
{
    protected $table = 'tr_biodata_peserta';

    protected $fillable = [
        'id_kegiatan',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'utusan',
        'jabatan',
        'alamat_kantor',
        'no_rekening',
        'id_bank',
        'atas_nama_rek',
        'ttd',
        'is_trash',
        'created_by',
        'updated_by',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(DtKegiatan::class, 'id_kegiatan');
    }

    public function bank()
    {
        return $this->belongsTo(DtBank::class, 'id_bank');
    }
}
