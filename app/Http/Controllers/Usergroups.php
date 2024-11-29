<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usergroups extends Controller {

    public function index(Request $request) {
        return view('usergroups.index');
    }
}
