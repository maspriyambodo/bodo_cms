<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User_groups;
use App\Models\Menu;

class MenuController extends Controller {

    public function index(Request $request) {
        return view('menu.index');
    }

    public function getMenu() {
        $menus = Menu::with('children')->whereNull('menu_parent')->get();
        return view('layouts.admin_template', compact('menus'));
    }
}
