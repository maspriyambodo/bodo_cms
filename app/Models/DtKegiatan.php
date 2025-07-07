<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtKegiatan extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'dt_kegiatan';

    // Primary key is 'id' by default, so no need to specify unless different
    // Auto-incrementing primary key by default

    // Disable timestamps if your table doesn't have Laravel's default timestamps

    // Fillable fields for mass assignment
    protected $fillable = [
        'nama',
        'direktorat',
        'subdirektorat',
        'tanggal_mulai_kegiatan',
        'tanggal_selesai_kegiatan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'lokasi_acara',
        'link_biodata',
        'is_trash',
        'created_by',
        'updated_by',
    ];

    // Cast attributes to appropriate types
    protected $casts = [
        'id' => 'integer',
        'direktorat' => 'integer',
        'subdirektorat' => 'integer',
        'tanggal_mulai_kegiatan' => 'date:Y-m-d',
        'tanggal_selesai_kegiatan' => 'date:Y-m-d',
        'provinsi' => 'integer',
        'kabupaten' => 'integer',
        'kecamatan' => 'integer',
        'kelurahan' => 'integer',
        'is_trash' => 'integer',
        'created_at' => 'datetime',
        'update_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function peserta()
    {
        return $this->hasMany(TrBiodataPeserta::class, 'id_kegiatan');
    }
}
