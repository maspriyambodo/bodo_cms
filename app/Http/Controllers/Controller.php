<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use App\Models\Permission as user_permission;

class Controller extends BaseController {

    use AuthorizesRequests,
        ValidatesRequests;

    public function permission_user() {
        $menu_link = Route::currentRouteName();
        $exec = user_permission::select('sys_menu.nama AS nama_menu', 'sys_menu.link AS link_menu', 'sys_permissions.role_id', 'sys_permissions.id_menu', 'sys_permissions.v', 'sys_permissions.c', 'sys_permissions.r', 'sys_permissions.u', 'sys_permissions.d')
                ->join('users', 'sys_permissions.role_id', '=', 'users.role')
                ->join('sys_menu', 'sys_permissions.id_menu', '=', 'sys_menu.id')
                ->where('users.role', auth()->user()->role)
                ->where('sys_menu.link', $menu_link)
                ->get();
        $data = [];
        foreach ($exec as $dt_user) {
            $data['view'] = $dt_user->v;
            $data['create'] = $dt_user->c;
            $data['read'] = $dt_user->r;
            $data['update'] = $dt_user->u;
            $data['delete'] = $dt_user->d;
        }

        return $data;
    }
}
