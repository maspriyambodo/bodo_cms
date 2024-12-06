<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtKabupaten extends Model {

    use HasFactory;

    protected $table = 'mt_kabupaten';
    protected $fillable = [
        'id_provinsi',
        'nama',
        'is_trash',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];

    // Define the relationship with MtProvinsi
    public function provinsi() {
        return $this->belongsTo(MtProvinsi::class, 'id_provinsi', 'id_provinsi');
    }
}
