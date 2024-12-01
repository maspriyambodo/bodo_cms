<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Permission extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'sys_permissions';
}
