<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

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
        'description',
        'is_trash',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    public function children() {
        return $this->hasMany(Menu::class, 'menu_parent');
    }

    public function parent() {
        return $this->belongsTo(Menu::class, 'menu_parent');
    }
}
