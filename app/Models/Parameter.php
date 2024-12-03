<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Parameter extends Model {

    use HasFactory,
        Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'sys_param';
}
