<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DtBank; // <-- Import model
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Menampilkan daftar semua bank.
     */
    public function index()
    {
        // Ambil semua data dari model DtBank
        $banks = DtBank::all();

        // Kembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Daftar data bank',
            'data' => $banks
        ]);
    }
}