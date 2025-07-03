<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $position = Location::get();
        DB::table('dt_viewers')->insert([
            'user_agent' => $request->server('HTTP_USER_AGENT'),
            'ip_address' => $request->ip(),
            'ip_address2' => $position->ip,
            'countryName' => $position->countryName,
            'regionName' => $position->regionName,
            'cityName' => $position->cityName,
            'zipCode' => $position->zipCode,
            'latitude' => $position->latitude,
            'longitude' => $position->longitude,
            'created_at' => now(),
        ]);
        $dt_video = DB::table('dt_video')->get();
        return view('dashboardvid', compact('dt_video'));
    }
}