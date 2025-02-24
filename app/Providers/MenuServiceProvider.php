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
                    $menus = Menu::with(['children', 'group', 'permissions' => function ($query) use ($user) {
                                    $query->where('is_trash', 0)
                                            ->where('v', 1)
                                            ->where('role_id', $user->role);
                                }])
                            ->whereNull('menu_parent')
                            ->where('is_trash', 0)
                            ->orderBy('order_no', 'asc')
                            ->orderBy('group_menu', 'asc')
                            ->get();
//                    dd($menus);
                    $view->with(compact('user', 'role_user', 'menus'));
                } else {
                    $view->with(['user' => null, 'role_user' => null, 'menus' => collect(), 'menugroup' => null]);
                }
            } catch (\Exception $e) {
                \Log::error('Error in MenuServiceProvider: ' . $e->getMessage());
            }
        });
    }
}
