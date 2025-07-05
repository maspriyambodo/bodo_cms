<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\MenuGroup as SysMenuGroup;
use App\Models\Permission as SysPermission;

class Menu extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'sys_menu';
    protected $fillable = [
        'menu_parent',
        'nama',
        'link',
        'order_no',
        'group_menu',
        'icon',
        'description',
        'is_hide',
        'is_trash',
        'created_by',
        'updated_by'
    ];

    // Define the relationship for child menus
    public function children() {
        return $this->hasMany(Menu::class, 'menu_parent', 'id'); // Assuming 'menu_parent' is the foreign key
    }

    public function parent() {
        return $this->belongsTo(Menu::class, 'menu_parent');
    }

    public function group() {
        return $this->belongsTo(SysMenuGroup::class, 'group_menu');
    }

    public function permissions() {
        return $this->hasMany(SysPermission::class, 'id_menu');
    }
}
