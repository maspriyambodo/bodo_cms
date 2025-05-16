<?php

namespace App\Http\Controllers;

use App\Models\MtKabupaten;
use App\Models\PenyuluhModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function chartData()
    {
        $data = MtKabupaten::select('mt_kabupaten.nama as kabupaten', DB::raw('COUNT(dt_penyuluh.id) as value'))
            ->join('dt_penyuluh', 'mt_kabupaten.id_kabupaten', '=', 'dt_penyuluh.tugas_kabupaten')
            ->where('mt_kabupaten.id_provinsi', 33)
            ->groupBy('dt_penyuluh.tugas_kabupaten', 'mt_kabupaten.id_kabupaten', 'mt_kabupaten.nama')
            ->orderBy('dt_penyuluh.tugas_kabupaten', 'asc')
            ->get();

        return response()->json($data);
    }

    public function chartData2()
    {
        $data = PenyuluhModels::select('dt_penyuluh.jenis_kelamin', DB::raw('COUNT(dt_penyuluh.id) as value'))
            ->where('dt_penyuluh.tugas_provinsi', 33)
            ->groupBy('dt_penyuluh.jenis_kelamin')
            ->get();
        return response()->json($data);
    }

    public function chartData3()
    {
        $data = PenyuluhModels::select('dt_penyuluh.status_pegawai', DB::raw('COUNT(dt_penyuluh.id) as value'))
            ->where('dt_penyuluh.tugas_provinsi', 33)
            ->groupBy('dt_penyuluh.status_pegawai')
            ->orderBy('value', 'desc')
            ->get();
        return response()->json($data);
    }
}
