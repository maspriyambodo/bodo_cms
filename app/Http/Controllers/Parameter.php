<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Parameter extends Controller
{
    public function index(Request $request) {
        return view('parameter.index');
    }
}
