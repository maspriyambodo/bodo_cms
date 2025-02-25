<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model {

    use HasFactory;

    protected $table = 'mt_provinsi'; // Specify the table name if it's not pluralized
    protected $primaryKey = 'id_provinsi'; // Specify the primary key
    protected $fillable = [
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
}
