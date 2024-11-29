<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupMenu extends Controller
{
    public function index(Request $request) {
        return view('grupmenu.index');
    }
}
