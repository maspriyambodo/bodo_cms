<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Menu as SysMenu;

class MenuGroup extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'sys_menu_group';
    protected $fillable = [
        'nama',
        'description',
        'order_no',
        'is_trash',
        'created_by',
        'updated_by'
    ];

    public function menus() {
        return $this->hasMany(SysMenu::class, 'group_menu');
    }
}
