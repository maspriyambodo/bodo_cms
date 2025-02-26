<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class MtKelurahan extends Model {

    use HasFactory,
        HasSpatial;

    protected $table = 'mt_kelurahan';
    protected $fillable = [
        'id_kelurahan',
        'id_kecamatan',
        'nama',
        'is_trash',
        'coordinates',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'coordinates' => Point::class
    ];

    // Define the relationship with MtKecamatan
    public function kecamatan() {
        return $this->belongsTo(MtKecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }
}
