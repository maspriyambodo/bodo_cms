<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiodataPeserta;
use App\Models\DtBank;
use App\Models\TrBiodataPeserta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BiodataPesertaController extends Controller
{
    public function index(Request $request)
    {
        $user_access = $this->permission_user();
        $id_kegiatan = $request->get('q', null);
        $banks = DtBank::where('is_trash', 0)
            ->orderBy('nama')
            ->get();
        return view('datapeserta.datapeserta_index', compact(
            'user_access',
            'id_kegiatan',
            'banks'
        ));
    }

    // DataTables JSON endpoint
    public function json(Request $request)
    {
        if (!$this->permission_user()['read']) {
            return response()->json([
                'draw' => 1,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
        }
        
        $exec = BiodataPeserta::where('id_kegiatan', $request->id_kegiatan)
                                ->orderBy('id_peserta');
        $this->applyFilters($exec, $request);
        $dt_param = $exec->get();

        return Datatables::of($dt_param)
            ->addColumn('status_aktif', function ($row) {
                return $row->is_trash == 0
                    ? '<span class="badge badge-success w-100">aktif</span>'
                    : '<span class="badge badge-light-dark w-100">deleted</span>';
            })
            ->addColumn('url_form_biodata', function ($row) {
                return url('form-biodata/' . $row->slug);
            })
            ->addColumn('button', function ($row) {
                return $this->getActionButtons($row);
            })
            ->rawColumns(['status_aktif', 'button', 'url_form_biodata'])
            ->make(true);
    }

    // Apply filters to query
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->keyword}%")
                    ->orWhere('provinsi', 'like', "%{$request->keyword}%")
                    ->orWhere('kabupaten', 'like', "%{$request->keyword}%")
                    ->orWhere('kecamatan', 'like', "%{$request->keyword}%")
                    ->orWhere('kelurahan', 'like', "%{$request->keyword}%")
                    ->orWhere('lokasi_acara', 'like', "%{$request->keyword}%");
            });
        }
    }

    // Generate action buttons
    private function getActionButtons($row)
    {
        $permissions = $this->permission_user();
        $canUpdate = $permissions['update'];
        $canDelete = $permissions['delete'];

        if (!$canUpdate && !$canDelete) {
            return '';
        }

        $buttons = '<a type="button" class="btn btn-secondary btn-sm" 
            data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a>
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 
            menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
            <div class="menu-item px-3">
                <span class="text-center text-muted py-3 mb-2">' . $row->nama_peserta . ' Action</span>
            </div>';

        if ($canUpdate) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="cetakBiodata(\'' . $row->id_peserta . '\');">
                    <i class="bi bi-file-text text-default mx-2"></i> Cetak Form Biodata
                </a>
            </div>
            <div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="detailPeserta(\'' . $row->id_peserta . '\');">
                    <i class="bi bi-file-text text-default mx-2"></i> Detail Peserta
                </a>
            </div>
            <div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="editData(\'' . $row->id_peserta . '\');">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($canDelete && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="deleteData(\'' . $row->id_peserta . '\');">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="restoreData(\'' . $row->id_peserta . '\');">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        $buttons .= '</div>';

        return $buttons;
    }

    public function store(Request $request)
    {
        // Validation rules based on operation type
        $validator = $this->getValidator($request);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        
        DB::beginTransaction();
        
        try {
            $this->processOperation($request);
            DB::commit();
            
            return response()->json(['success' => true]);
        } catch (\Exception $exc) {
            DB::rollBack();
            Log::error('Failed to process Peserta operation: ' . $exc->getMessage(), [
                'user_id' => auth()->user()->id,
                'request_data' => $request->all(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Operation failed.',
                'error' => $exc->getMessage()
            ], 500);
        }
    }

    // Get validation rules based on operation type
    private function getValidator(Request $request)
    {
        switch ($request->q) {
            case 'add':
                return Validator::make($request->all(), [
                    'id_kegiatan2' => 'required|integer|exists:dt_kegiatan,id',
                    'nmatxt' => 'required|string|max:255',
                    'tmplahirtxt' => 'required|string|max:255',
                    'tgllahirtxt' => 'required|date',
                    'alamattxt' => 'required|string',
                    'nohptxt' => 'required|string|max:15',
                    'utustxt' => 'required|string',
                    'jabtxt' => 'required|string',
                    'almktrtxt' => 'required|string',
                    'rektxt' => 'required|integer',
                    'banktxt' => 'required|integer|exists:dt_bank,id',
                    'antxt' => 'required|string',
                    'ttdtxt' => 'required|string',
                ]);
                
            case 'update':
                return Validator::make($request->all(), [
                    'eid' => 'required|integer',
                    'nmatxt2' => 'required|string|max:255',
                    'tmplahirtxt2' => 'required|string|max:255',
                    'tgllahirtxt2' => 'required|date',
                    'alamattxt2' => 'required|string',
                    'nohptxt2' => 'required|string|max:15',
                    'utustxt2' => 'required|string',
                    'jabtxt2' => 'required|string',
                    'almktrtxt2' => 'required|string',
                    'rektxt2' => 'required|integer',
                    'banktxt2' => 'required|integer|exists:dt_bank,id',
                    'antxt2' => 'required|string',
                    'ttdtxt2' => 'required|string',
                ]);
                
            case 'delete':
                return Validator::make($request->all(), [
                    'd_id' => 'required|integer'
                ]);
                
            case 'restore':
                return Validator::make($request->all(), [
                    'delidtxt' => 'required|integer'
                ]);
                
            default:
                return Validator::make([], []);
        }
    }

    // Process database operations
    private function processOperation(Request $request)
    {
        switch ($request->q) {
            case 'add':
                TrBiodataPeserta::create([
                    'id_kegiatan' => $request->id_kegiatan2,
                    'nama' => $request->nmatxt,
                    'tempat_lahir' => $request->tmplahirtxt,
                    'tanggal_lahir' => $request->tgllahirtxt,
                    'alamat' => $request->alamattxt,
                    'no_hp' => $request->nohptxt,
                    'utusan' => $request->utustxt,
                    'jabatan' => $request->jabtxt,
                    'alamat_kantor' => $request->almktrtxt,
                    'no_rekening' => $request->rektxt,
                    'id_bank' => $request->banktxt,
                    'atas_nama_rek' => $request->antxt,
                    'ttd' => $request->ttdtxt,
                    'is_trash' => 0,
                    'created_by' => auth()->user()->id
                ]);
                break;
                
            case 'update':
                TrBiodataPeserta::where('id', $request->eid)->update([
                    'nama' => $request->nmatxt2,
                    'tempat_lahir' => $request->tmplahirtxt2,
                    'tanggal_lahir' => $request->tgllahirtxt2,
                    'alamat' => $request->alamattxt2,
                    'no_hp' => $request->nohptxt2,
                    'utusan' => $request->utustxt2,
                    'jabatan' => $request->jabtxt2,
                    'alamat_kantor' => $request->almktrtxt2,
                    'no_rekening' => $request->rektxt2,
                    'id_bank' => $request->banktxt2,
                    'atas_nama_rek' => $request->antxt2,
                    'ttd' => $request->ttdtxt2,
                    'updated_by' => auth()->user()->id
                ]);
                break;
                
            case 'delete':
                TrBiodataPeserta::where('id', $request->d_id)->update([
                    'is_trash' => 1,
                    'updated_by' => auth()->user()->id
                ]);
                break;
                
            case 'restore':
                TrBiodataPeserta::where('id', $request->delidtxt)->update([
                    'is_trash' => 0,
                    'updated_by' => auth()->user()->id
                ]);
                break;
        }
    }

    public function detailPeserta(Request $request)
    {
        $peserta = TrBiodataPeserta::with('bank')
            ->where('id', $request->id)
            ->where('is_trash', 0)
            ->firstOrFail();
        return response()->json([
            'success' => true,
            'data' => $peserta,
            'message' => 'Detail peserta retrieved successfully.'
        ]);
    }
}