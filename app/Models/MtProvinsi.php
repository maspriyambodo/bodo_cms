<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class MtProvinsi extends Model {

    use HasFactory,
        HasSpatial;

    protected $table = 'mt_provinsi';
    protected $primaryKey = 'id_provinsi'; // Specify the primary key
    protected $fillable = [
        'id_provinsi',
        'nama',
        'coordinates',
        'is_trash',
        'created_by',
        'updated_by',
    ];
    protected $casts = [
        'coordinates' => Point::class
    ];
}
