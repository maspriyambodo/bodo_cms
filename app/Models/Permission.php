<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Menu;

class Permission extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'sys_permissions';
}
