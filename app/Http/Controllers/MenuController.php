<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User_groups;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MenuController extends Controller {

    public function index(Request $request): View {
        $user = Auth::user();
//        dd($user->role);
        $role_user = User_groups::where('id', $user->role)->first();
        $menus = Menu::with('children')->whereNull('menu_parent')->get();
        return view('menu.index', [
            'user' => $request->user(),
            'role_user' => $role_user,
            'menus' => $menus
        ]);
    }

    public function getMenu() {
        $menus = Menu::with('children')->whereNull('menu_parent')->get();
        return view('layouts.admin_template', compact('menus'));
    }
}
