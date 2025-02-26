<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class MtKabupaten extends Model {

    use HasFactory;

    protected $table = 'mt_kabupaten';
    protected $primaryKey = 'id_kabupaten'; // Specify the primary key
    protected $fillable = [
        'id_kabupaten',
        'id_provinsi',
        'nama',
        'is_trash',
        'coordinates',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'coordinates' => Point::class
    ];

    // Define the relationship with MtProvinsi
    public function provinsi() {
        return $this->belongsTo(MtProvinsi::class, 'id_provinsi', 'id_provinsi');
    }
}
