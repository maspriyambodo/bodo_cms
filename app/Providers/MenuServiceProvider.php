<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User_groups;
use App\Models\Menu;

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
                    $menus = Menu::with('children')->whereNull('menu_parent')->get();

                    $view->with(compact('user', 'role_user', 'menus'));
                } else {
                    $view->with(['user' => null, 'role_user' => null, 'menus' => collect()]);
                }
            } catch (\Exception $e) {
                Log::error('Error in MenuServiceProvider: ' . $e->getMessage());
            }
        });
    }
}
