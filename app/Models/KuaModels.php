<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuaModels extends Model
{
    use HasFactory;

    protected $table = 'dt_kua';

    protected $primaryKey = 'kode_kua';

    public $incrementing = false; // Assuming kode_kua is not auto-incrementing

    public $timestamps = true; // Enable timestamps for created_at and updated_at

    protected $fillable = [
        'nama_kua',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'latitude',
        'longitude',
        'alamat',
        'no_telp',
        'email',
        'luas_tanah',
        'status_tanah',
        'is_trash',
        'created_by',
        'updated_by',
    ];
}