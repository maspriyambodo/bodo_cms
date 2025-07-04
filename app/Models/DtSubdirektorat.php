<?php

namespace App\Models;

use App\Models\MtDirektorat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DtSubdirektorat extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel's naming convention)
    protected $table = 'dt_subdirektorat';

    // Primary key (optional if 'id')
    protected $primaryKey = 'id';

    // Auto-incrementing (default is true)
    public $incrementing = true;

    // Key type
    protected $keyType = 'int';

    // Fillable fields (for mass assignment)
    protected $fillable = [
        'id_direktorat',
        'nama',
        'is_trash',
        'created_by',
        'updated_by',
    ];

    // Casts
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_trash' => 'integer',
    ];

    // Optionally, add relationships (example)
    public function direktorat()
    {
        return $this->belongsTo(MtDirektorat::class, 'id_direktorat');
    }
}
