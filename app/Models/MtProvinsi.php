<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtProvinsi extends Model {

    use HasFactory;

    protected $table = 'mt_provinsi';
    protected $fillable = [
        'nama',
        'is_trash',
        'latitude',
        'longitude',
        'created_by',
        'updated_by',
    ];
}
