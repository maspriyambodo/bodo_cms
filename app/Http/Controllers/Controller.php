<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use App\Models\Permission as user_permission;
use App\Models\Parameter as sys_param;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Dokumentasi API",
 *      description="Lorem Ipsum",
 *      @OA\Contact(
 *          email="hi.wasissubekti02@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 */
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

    public function Sistem_parameter() {
        $sysparam = sys_param::select('id as id_param', 'param_value')->where('is_trash', 0)->get();
        $param = [];
        foreach ($sysparam as $paramsys) {
            $param[$paramsys->id_param] = $paramsys->param_value;
        }
        return $param;
    }
}
