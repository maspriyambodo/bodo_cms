<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyuluhModels extends Model
{
    use HasFactory;

    protected $table = 'dt_penyuluh';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'urut',
        'nip',
        'nipa',
        'password',
        'nik',
        'nama',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'tugas_provinsi',
        'tugas_kabupaten',
        'tugas_kecamatan',
        'tugas_kua',
        'status_pegawai',
        'no_hp',
        'email',
        'pendidikan',
        'jurusan',
        'organisasi',
        'spesialisasi',
        'photo',
        'swafoto',
        'is_trash',
        'aktivasi',
        'verifikator',
        'created_date',
        'approved_date',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_date' => 'datetime',
        'approved_date' => 'datetime',
    ];

    /**
     * Get the provinsi related to the penyuluh.
     */
    public function provinsi()
    {
        return $this->belongsTo(MtProvinsi::class, 'tugas_provinsi', 'id_provinsi');
    }

    /**
     * Get the kabupaten related to the penyuluh.
     */
    public function kabupaten()
    {
        return $this->belongsTo(MtKabupaten::class, 'tugas_kabupaten', 'id_kabupaten');
    }

    /**
     * Get the kecamatan related to the penyuluh.
     */
    public function kecamatan()
    {
        return $this->belongsTo(MtKecamatan::class, 'tugas_kecamatan', 'id_kecamatan');
    }

    /**
     * Get the tugas_kua related to the penyuluh.
     */
    public function tugas_kua()
    {
        return $this->belongsTo(KuaModels::class, 'tugas_kua', 'kode_kua');
    }
}
