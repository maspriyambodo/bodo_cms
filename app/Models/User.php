<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permission as SysPermission;
use App\Models\UsergroupsModels as UserGroup;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,
        HasFactory,
        Notifiable;

    protected $primaryKey = 'id';
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'email',
        'pict',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'email_verified_at',
        'password',
        'remember_token',
        'is _trash',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function group() {
        return $this->belongsTo(UserGroup::class, 'role', 'id');
    }

    public function hasPermission($role_user) {
        // Assuming you have a relationship to get user permissions
        return $this->permissions()->where('role_id', $role_user)->exists();
    }

    public function permissions() {
        return $this->hasMany(SysPermission::class, 'role_id', 'role');
    }

    public function provinsi() {
        return $this->belongsTo(MtProvinsi::class, 'id_provinsi', 'id_provinsi');
    }

    public function kabupaten() {
        return $this->belongsTo(MtKabupaten::class, 'id_kabupaten', 'id_kabupaten');
    }

    public function kecamatan() {
        return $this->belongsTo(MtKecamatan::class, 'id_kecamatan', 'id_kecamatan');
    }

    public function kelurahan() {
        return $this->belongsTo(MtKelurahan::class, 'id_kelurahan', 'id_kelurahan');
    }

    public static function getUserPermissions() {
        return DB::table('users')
                        ->join('sys_permissions', 'users.role', '=', 'sys_permissions.role_id')
                        ->join('sys_menu', 'sys_permissions.id_menu', '=', 'sys_menu.id')
                        ->select(
                                'users.id',
                                'users.role',
                                'sys_permissions.v',
                                'sys_permissions.c',
                                'sys_permissions.r',
                                'sys_permissions.u',
                                'sys_permissions.d',
                                'sys_menu.link'
                        )
                        ->get();
    }
}
