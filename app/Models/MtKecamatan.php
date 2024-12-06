<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtKecamatan extends Model {

    use HasFactory;

    protected $table = 'mt_kecamatan';
    protected $fillable = [
        'id_kabupaten',
        'nama',
        'is_trash',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];

    // Define the relationship with MtKabupaten
    public function kabupaten() {
        return $this->belongsTo(MtKabupaten::class, 'id_kabupaten', 'id_kabupaten');
    }
}
