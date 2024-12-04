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
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'role_id',
        'id_menu',
        'v',
        'c',
        'r',
        'u',
        'd',
        'created_by',
        'updated_by',
    ];

    public function menu() {
        return $this->belongsTo(SysMenu::class, 'id_menu', 'id');
    }

    public function role() {
        return $this->belongsTo(UserGroup::class, 'role_id', 'id');
    }
}
