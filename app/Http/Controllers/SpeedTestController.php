<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpeedTestController extends Controller {

    public function index(Request $request) {
        return view('speedtest');
    }

    public function json() {
        // URL of the test file (make sure this file exists and is accessible)
        $testFileUrl = asset('src/media/misc/checkspeed.dat');

        // Start time
        $startTime = microtime(true);

        // Use file_get_contents to download the file
        $data = file_get_contents($testFileUrl);

        // End time
        $endTime = microtime(true);

        // Calculate the time taken
        $timeTaken = $endTime - $startTime;

        // Get the size of the downloaded data in bytes
        $dataSize = strlen($data);

        // Calculate speed in bits per second
        $speedBps = ($dataSize * 8) / $timeTaken; // bits per second
        $speedKbps = $speedBps / 1024; // kilobits per second
        $speedMbps = $speedKbps / 1024; // megabits per second
        // Display the results
        return response()->json([
                    'download_speed_mbps' => round($speedMbps, 2),
                    'time_taken_seconds' => round($timeTaken, 2),
                    'data_size_bytes' => $dataSize,
        ]);
    }
}
