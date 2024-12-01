<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User_groups;
use App\Models\Menu;
use App\Models\MenuGroup;

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
                    $role_user = User_groups::find($user->role);
                    $menus = Menu::with(['children'])
                            ->select('sys_menu.menu_parent', 'sys_menu.nama', 'sys_permissions.role_id', 'sys_permissions.v', 'sys_permissions.c', 'sys_permissions.r', 'sys_permissions.u', 'sys_permissions.d')
                            ->join('sys_permissions', 'sys_menu.id', '=', 'sys_permissions.id_menu')
                            ->whereNull('menu_parent')
                            ->where(['is_trash' => 0, 'sys_permissions.v' => 1])
                            ->get();
                    $menugroup = MenuGroup::where(['is_trash' => 0])->get();
                    $view->with(compact('user', 'role_user', 'menus', 'menugroup'));
                } else {
                    $view->with(['user' => null, 'role_user' => null, 'menus' => collect(), 'menugroup' => null]);
                }
            } catch (\Exception $e) {
                \Log::error('Error in MenuServiceProvider: ' . $e->getMessage());
            }
        });
    }
}
