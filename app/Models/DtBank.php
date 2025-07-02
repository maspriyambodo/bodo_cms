<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtBank extends Model
{
    protected $table = 'dt_bank'; // pastikan nama tabel sesuai
    public $timestamps = false;   // jika tabel tidak pakai created_at & updated_at
}
