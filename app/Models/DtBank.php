<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtBank extends Model
{
    protected $table = 'dt_bank'; // Table name
    public $timestamps = true;   // No created_at & updated_at

    protected $fillable = [
        'nama',
        'kode',
        'logo',
        'is_trash',
        'created_by',
        'updated_by',
    ];

    public function peserta()
    {
        return $this->hasMany(TrBiodataPeserta::class, 'id_bank');
    }
}
