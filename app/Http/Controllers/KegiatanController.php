<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DtKegiatan;
use App\Models\DetailKegiatan;
use App\Models\MtDirektorat;
use App\Models\DtSubdirektorat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    // Main index view
    public function index(Request $request)
    {
        $user_access = $this->permission_user();
        $direktorats = MtDirektorat::where('is_trash', 0)->get();
        
        return view('kegiatan.kegiatan_index', compact(
            'user_access', 
            'direktorats'
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

        $exec = DetailKegiatan::orderBy('id', 'asc');
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
                <span class="text-center text-muted py-3 mb-2">' . $row->nama . ' Action</span>
            </div>';

        if ($canUpdate) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="bidodataPeserta(\'' . $row->id . '\');">
                    <i class="bi bi-file-text text-default mx-2"></i> Biodata Peserta
                </a>
            </div>
            <div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="editData(\'' . $row->id . '\');">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($canDelete && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="deleteData(\'' . $row->id . '\');">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" 
                    onclick="restoreData(\'' . $row->id . '\');">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        $buttons .= '</div>';

        return $buttons;
    }

    // Store/update/delete data
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
            Log::error('Failed to process Kegiatan operation: ' . $exc->getMessage(), [
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
                    'nmatxt' => 'required|string|max:255|unique:dt_kegiatan,nama',
                    'nmadir' => 'required|integer|exists:mt_direktorat,id',
                    'subdittxt' => 'required|integer|exists:dt_subdirektorat,id',
                    'tglmulaitxt' => 'required|date',
                    'tglendtxt' => 'required|date',
                    'loktxt' => 'required|string',
                ]);
                
            case 'update':
                return Validator::make($request->all(), [
                    'eid' => 'required|integer',
                    'nmatxt2' => 'required|string|max:255',
                    'nmadir2' => 'required|integer|exists:mt_direktorat,id',
                    'subdittxt2' => 'required|integer|exists:dt_subdirektorat,id',
                    'tglmulaitxt2' => 'required|date',
                    'tglendtxt2' => 'required|date',
                    'loktxt2' => 'required|string',
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
                DtKegiatan::create([
                    'nama' => $request->nmatxt,
                    'slug' => Str::slug($request->nmatxt),
                    'direktorat' => $request->nmadir,
                    'subdirektorat' => $request->subdittxt,
                    'tanggal_mulai_kegiatan' => $request->tglmulaitxt,
                    'tanggal_selesai_kegiatan' => $request->tglendtxt,
                    'lokasi_acara' => $request->loktxt,
                    'is_trash' => 0,
                    'created_by' => auth()->user()->id
                ]);
                break;
                
            case 'update':
                DtKegiatan::where('id', $request->eid)->update([
                    'nama' => $request->nmatxt2,
                    'direktorat' => $request->nmadir2,
                    'subdirektorat' => $request->subdittxt2,
                    'tanggal_mulai_kegiatan' => $request->tglmulaitxt2,
                    'tanggal_selesai_kegiatan' => $request->tglendtxt2,
                    'lokasi_acara' => $request->loktxt2,
                    'updated_by' => auth()->user()->id
                ]);
                break;
                
            case 'delete':
                DtKegiatan::where('id', $request->d_id)->update([
                    'is_trash' => 1,
                    'updated_by' => auth()->user()->id
                ]);
                break;
                
            case 'restore':
                DtKegiatan::where('id', $request->delidtxt)->update([
                    'is_trash' => 0,
                    'updated_by' => auth()->user()->id
                ]);
                break;
        }
    }

    // Edit data retrieval
    public function edit(Request $request)
    {
        $exec = DtKegiatan::where('id', $request->id)->first();

        if (!$exec) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'dt_kegiatan' => $exec
        ]);
    }

    // Get subdirektorat by direktorat ID
    public function getSubdit(Request $request, $id)
    {
        $subdirektorats = DtSubdirektorat::where('id_direktorat', $id)
            ->where('is_trash', 0)
            ->get(['id', 'nama']);
        return response()->json($subdirektorats);
    }

    // Check if kegiatan name already exists
    public function cekNama(Request $request, $nama)
    {
        $exists = DtKegiatan::where('nama', $nama)
            ->where('is_trash', 0)
            ->exists();
        return response()->json(['exists' => $exists]);
    }
    
    public function detailKegiatan(Request $request, $nama)
    {
        // $kegiatan = DtKegiatan::find($nama);
        // if (!$kegiatan) {
        //     return response()->json(['success' => false, 'message' => 'Kegiatan not found'], 404);
        // }
        $detail = DetailKegiatan::where('slug', $nama)->get();
        if ($detail->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Detail Kegiatan not found'], 404);
        } else {
            // Optionally, you can format the detail data if needed
            $detail = $detail->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'slug' => $item->slug,
                    'direktorat' => $item->direktorat,
                    'subdirektorat' => $item->subdirektorat,
                    'tanggal_mulai_kegiatan' => $item->tanggal_mulai_kegiatan,
                    'tanggal_selesai_kegiatan' => $item->tanggal_selesai_kegiatan,
                    'lokasi_acara' => $item->lokasi_acara,
                ];
            });
        }
        return response()->json(['success' => true, 'detail' => $detail]);
    }

}
