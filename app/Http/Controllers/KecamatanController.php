<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\MtKecamatan;
use App\Models\MtKabupaten;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Yajra\DataTables\Facades\DataTables;
use App\Models\MtKelurahan;
use Exeption;

class KecamatanController extends Controller {

    public function index(Request $request) {
        $user_access = $this->permission_user();
        $kabupaten = MtKabupaten::where('is_trash', 0)->get();
        return view('master.kecamatan.kecamatan_index', compact('user_access', 'kabupaten'));
    }

    public function json(Request $request) {
        if (!$this->permission_user()['read']) {
            return response()->json([
                        'draw' => 0,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => []
            ]);
        }
        $offset = $request->start;
        $limit = $request->length;
        $TotalRecords = MtKecamatan::where('is_trash', 0)->count();
        $exec = MtKecamatan::orderBy('id_kecamatan', 'asc');
        $this->applyFilters($exec, $request);
        $dt_param = $exec->offset($offset)->limit($limit)->get();
        if ($request->keyword) {
            $FilteredRecords = count($dt_param);
        } else {
            $FilteredRecords = $TotalRecords;
        }
        return Datatables::of($dt_param)
                        ->addIndexColumn()
                        ->editColumn('created_at', fn($row) => date('d M Y', strtotime($row->created_at)))
                        ->addColumn('longitude', fn($row) => $row->coordinates->longitude)
                        ->addColumn('latitude', fn($row) => $row->coordinates->latitude)
                        ->addColumn('status_aktif', fn($row) => $row->is_trash == 0 ? "<span class=\"badge badge-success w-100\">aktif</span>" : "<span class=\"badge badge-light-dark w-100\">deleted</span>")
                        ->addColumn('button', fn($row) => $this->getActionButtons($row))
                        ->rawColumns(['status_aktif', 'button'])
                        ->skipPaging()
                        ->setTotalRecords($TotalRecords)
                        ->setFilteredRecords($FilteredRecords)
                        ->make(true);
    }

    private function applyFilters($query, Request $request) {
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
                $q->orWhere('id_kecamatan', 'like', "%" . $request->keyword . "%");
                $q->orWhere('id_kabupaten', 'like', "%" . $request->keyword . "%");
            });
        }
    }

    private function getActionButtons($row) {
        $permissions = $this->permission_user();
        $canUpdate = $permissions['update'];
        $canDelete = $permissions['delete'];
        if (!$canUpdate && !$canDelete) {
            return '';
        }
        $buttons = '<a type="button" class="btn btn-secondary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true"><div class="menu-item px-3">
                <span class="text-center text-muted py-3 mb-2">' . $row->nama . ' Action</span>
            </div>';

        if ($canUpdate) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $row->id_kecamatan . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($canDelete && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(&apos;' . $row->id_kecamatan . '&apos;);">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(&apos;' . $row->id_kecamatan . '&apos;);">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function store(Request $request) {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                            ], 422);
        }

        DB::beginTransaction(); // Start transaction
        try {
            $longtxt = $request->longtxt ?? 0;
            $lattxt = $request->lattxt ?? 0;
            $longtxt2 = $request->longtxt2 ?? 0;
            $lattxt2 = $request->lattxt2 ?? 0;

            switch ($request->q) {
                case 'add':
                    MtKecamatan::create([
                        'id_kecamatan' => $request->kdtxt,
                        'id_kabupaten' => $request->kabtxt,
                        'nama' => $request->nmatxt,
                        'is_trash' => 0,
                        'coordinates' => new Point($longtxt, $lattxt),
                        'created_by' => auth()->user()->id
                    ]);
                    break;

                case 'update':
                    MtKecamatan::where('id_kecamatan', $request->eid)
                            ->update([
                                'id_kecamatan' => $request->kdtxt2,
                                'id_kabupaten' => $request->provtxt2,
                                'nama' => $request->nmatxt2,
                                'coordinates' => new Point($longtxt2, $lattxt2),
                                'updated_by' => auth()->user()->id
                    ]);
                    break;

                case 'delete':
                    MtKecamatan::where('id_kecamatan', $request->d_id)
                            ->update([
                                'is_trash' => 1,
                                'updated_by' => auth()->user()->id
                    ]);
                    break;

                case 'restore':
                    MtKecamatan::where('id_kecamatan', $request->delidtxt)
                            ->update([
                                'is_trash' => 0,
                                'updated_by' => auth()->user()->id
                    ]);
                    break;
            }

            DB::commit(); // Commit transaction
            return response()->json(['success' => true]);
        } catch (Exception $exc) {
            DB::rollBack(); // Rollback transaction
            Log::error('Failed to create or update user: ' . $exc->getMessage(), [
                'user_id' => auth()->user()->id,
                'request_data' => $request->all(),
            ]);
            return response()->json([
                        'success' => false,
                        'message' => 'Failed to process request.',
                        'error' => $exc->getMessage()
                            ], 500);
        }
    }

    private function validateRequest(Request $request) {
        switch ($request->q) {
            case 'add':
                return Validator::make($request->all(), [
                            'kabtxt' => 'required|integer',
                            'kdtxt' => 'required|integer|unique:mt_kecamatan,id_kecamatan',
                            'nmatxt' => 'required|string',
                            'lattxt' => 'nullable|string',
                            'longtxt' => 'nullable|string',
                ]);
            case 'update':
                return Validator::make($request->all(), [
                            'eid' => 'required|integer',
                            'provtxt2' => 'required|integer',
                            'kdtxt2' => 'required|integer',
                            'nmatxt2' => 'required|string',
                            'lattxt2' => 'nullable|string',
                            'longtxt2' => 'nullable|string',
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
                return Validator::make([], []); // No validation needed
        }
    }
    
    public function search(Request $request) {
        if ($request->search) {
            $exec = MtKabupaten::select('id_kabupaten as id', 'nama as text')->where('is_trash', 0)
                    ->where('nama', 'like', "%" . $request->search . "%")
                    ->get();
            return response()->json([
                        'results' => $exec
            ]);
        }
    }

    public function edit(Request $request) {
        $exec = MtKecamatan::with('kabupaten')->where('id_kecamatan', $request->id)->first();
        if ($exec) {
            if ($request->input('q')) {
                return response()->json([
                            'success' => true,
                            'dt_kecamatan' => $exec
                ]);
            } else {
                return response()->json([
                            'success' => true,
                            'dt_kecamatan' => $exec
                ]);
            }
        } else {
            return response()->json([
                        'success' => false
            ]);
        }
    }

    public function get_kelurahan(Request $request) {
        $exec = MtKelurahan::select('id_kelurahan as id', 'nama as text')->where('is_trash', 0)
                ->where('id_kecamatan', $request->id_kecamatan)
                ->get();
        return response()->json([
                    'results' => $exec
        ]);
    }
}
