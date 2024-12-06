<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtKelurahan extends Model {

    use HasFactory;

    protected $table = 'mt_kelurahan';
    protected $fillable = [
        'id_kecamatan',
        'nama',
        'is_trash',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];

    // Define the relationship with MtKecamatan
    public function kecamatan() {
        return $this->belongsTo(MtKecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
