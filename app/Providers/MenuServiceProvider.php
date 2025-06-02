<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UsergroupsModels;
use App\Models\Menu;
use App\Models\Parameter;

class MenuServiceProvider extends ServiceProvider {

    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        View::composer('*', function ($view) {
            try {
                if (Auth::check()) {
                    $user = Auth::user();

                    $role_user = UsergroupsModels::find($user->role);
                    $menus = Menu::with(['children', 'permissions' => function ($query) use ($user) {
                                    $query->where('is_trash', 0)
                                            ->where('v', 1)
                                            ->where('role_id', $user->role);
                                }])
                            ->whereNull('menu_parent')
                            ->where('is_trash', 0)
                            ->where('is_hide', 0)
                            ->orderBy('order_no', 'asc')
                            ->orderBy('group_menu', 'asc')
                            ->get();
                    $sysparam = Parameter::select('id as id_param', 'param_value')->where('is_trash', 0)->get();
                    $paramsys = $this->dir_parameter($sysparam);
                    $view->with(compact('user', 'role_user', 'menus', 'paramsys'));
                } else {
                    $view->with(['user' => null, 'role_user' => null, 'menus' => collect(), 'menugroup' => null]);
                }
            } catch (\Exception $e) {
                \Log::error('Error in MenuServiceProvider: ' . $e->getMessage());
            }
        });
    }

    private function dir_parameter($sysparam) {
        $param = [];
        foreach ($sysparam as $paramsys) {
            $param[$paramsys->id_param] = $paramsys->param_value;
        }
        return $param;
    }
}
