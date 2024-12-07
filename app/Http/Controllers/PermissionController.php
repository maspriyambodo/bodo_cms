<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Permission extends Controller
{
    public function index(Request $request) {
        return view('permission.index');
    }
}
