<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class MtKecamatan extends Model {

    use HasFactory,
        HasSpatial;

    protected $table = 'mt_kecamatan';
    protected $fillable = [
        'id_kabupaten',
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

    // Define the relationship with MtKabupaten
    public function kabupaten() {
        return $this->belongsTo(MtKabupaten::class, 'id_kabupaten', 'id_kabupaten');
    }
}
