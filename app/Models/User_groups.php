<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User_groups extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'user_groups';
    protected $fillable = [
        'name',
        'description',
        'is_trash',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
}
