<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Parameter extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'sys_param';
    protected $fillable = [
        'id',
        'param_group',
        'param_value',
        'param_desc',
        'is_trash',
        'created_by',
        'updated_by'
    ];
}
