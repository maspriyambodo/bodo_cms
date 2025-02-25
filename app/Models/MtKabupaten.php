<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtKabupaten extends Model {

    use HasFactory;

    protected $table = 'mt_kabupaten';
    protected $primaryKey = 'id_kabupaten'; // Specify the primary key
    protected $fillable = [
        'id_kabupaten',
        'id_provinsi',
        'nama',
        'is_trash',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'is_trash' => 'integer',
    ];

    // Define the relationship with MtProvinsi
    public function provinsi() {
        return $this->belongsTo(MtProvinsi::class, 'id_provinsi', 'id_provinsi');
    }
}
