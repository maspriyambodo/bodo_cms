<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MtDirektorat extends Model
{
    // Nama tabel
    protected $table = 'mt_direktorat';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'nama',
        'is_trash',
        'created_by',
        'updated_by',
    ];

}
