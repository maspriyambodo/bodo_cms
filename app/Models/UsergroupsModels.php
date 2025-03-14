<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Permission as SysPermission;

class UsergroupsModels extends Model {

    use HasFactory,
        Notifiable;

    protected $table = 'user_groups';
    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'is_trash',
        'created_by',
        'updated_by',
    ];

    public function users() {
        return $this->hasMany(User::class, 'role', 'id');
    }

    public function permissions() {
        return $this->hasMany(SysPermission::class, 'role_id');
    }

    public function parent() {
        return $this->belongsTo(UsergroupsModels::class, 'parent_id');
    }

    // Define the relationship with the child groups
    public function children() {
        return $this->hasMany(UsergroupsModels::class, 'parent_id', 'id');
    }
}
