<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UsergroupsModels;
use App\Models\Menu;
use App\Models\Parameter;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                if (Auth::check()) {
                    $user = Auth::user();
                    $role_user = UsergroupsModels::find($user->role);
                    
                    $menus = Menu::with([
                        'children',
                        'permissions' => function ($query) use ($user) {
                            $query->where('is_trash', 0)
                                  ->where('v', 1)
                                  ->where('role_id', $user->role);
                        }
                    ])
                    ->whereNull('menu_parent')
                    ->where('is_trash', 0)
                    ->where('is_hide', 0)
                    ->orderBy('order_no')
                    ->orderBy('group_menu')
                    ->get();

                    $sysparam = Parameter::select('id as id_param', 'param_value')
                        ->where('is_trash', 0)
                        ->get();
                        
                    $view->with([
                        'user' => $user,
                        'role_user' => $role_user,
                        'menus' => $menus,
                        'paramsys' => $this->dirParameter($sysparam)
                    ]);
                } else {
                    $view->with([
                        'user' => null,
                        'role_user' => null,
                        'menus' => collect(),
                        'menugroup' => null
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('MenuServiceProvider Error: ' . $e->getMessage());
            }
        });
    }

    private function dirParameter($sysparam): array
    {
        return $sysparam->mapWithKeys(fn ($param) => [
            $param->id_param => $param->param_value
        ])->all();
    }
}
