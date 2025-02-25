<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\MtProvinsi;
use Yajra\DataTables\Facades\DataTables;

class Provinsi extends Controller {

    private function user_permission() {
        return Controller::permission_user();
    }

    public function index(Request $request) {
        $user_access = $this->user_permission();
        return view('master.provinsi.provinsi_index', compact('user_access'));
    }

    public function json(Request $request) {
        if (!$this->user_permission()['read']) {
            return [
                'draw' => 0,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        }
        $exec = MtProvinsi::orderBy('id_provinsi', 'asc');
        $this->applyFilters($exec, $request);
        $dt_param = $exec->get();
        return Datatables::of($dt_param)
                        ->editColumn('created_at', fn($row) => date('d M Y', strtotime($row->created_at)))
                        ->addColumn('status_aktif', fn($row) => $row->is_trash == 0 ? "<span class=\"badge badge-success w-100\">aktif</span>" : "<span class=\"badge badge-light-dark w-100\">deleted</span>")
                        ->addColumn('button', fn($row) => $this->getActionButtons($row))
                        ->rawColumns(['status_aktif', 'button'])
                        ->make(true);
    }

    private function applyFilters($query, Request $request) {
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
                $q->orWhere('id_provinsi', 'like', "%" . $request->keyword . "%");
            });
        }
    }

    private function getActionButtons($row) {
        $permissions = $this->user_permission();
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
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $row->id_provinsi . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($canDelete && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(&apos;' . $row->id_provinsi . '&apos;);">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(&apos;' . $row->id_provinsi . '&apos;);">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function store(Request $request) {
        if ($request->q == 'add') {
            $validator = Validator::make($request->all(), [
                'kdtxt' => 'required|integer|unique:mt_provinsi,id_provinsi',
                'nmatxt' => 'required|string',
                'lattxt' => 'nullable|double',
                'longtxt' => 'nullable|double',
            ]);
        } elseif ($request->q == 'update') {
            $validator = Validator::make($request->all(), [
                'eid' => 'required|integer',
                'kdtxt2' => 'required|integer',
                'nmatxt2' => 'required|string',
                'lattxt2' => 'nullable|double',
                'longtxt2' => 'nullable|double',
            ]);
        } elseif ($request->q == 'delete') {
            $validator = Validator::make($request->all(), [
                'd_id' => 'required|integer'
            ]);
        } elseif ($request->q == 'restore') {
            $validator = Validator::make($request->all(), [
                'delidtxt' => 'required|integer'
            ]);
        }

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                            ], 422);
        }
        DB::beginTransaction(); // Start transaction
        try {
            if ($request->q == 'add') {
                MtProvinsi::create([
                    'id_provinsi' => $request->kdtxt,
                    'nama' => $request->nmatxt,
                    'is_trash' => 0,
                    'latitude' => $request->lattxt,
                    'longitude' => $request->longtxt,
                    'created_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'update') {
                MtProvinsi::where('id_provinsi', $request->eid)
                        ->update([
                            'id_provinsi' => $request->kdtxt2,
                            'nama' => $request->nmatxt2,
                            'latitude' => $request->lattxt2,
                            'longitude' => $request->longtxt2,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'delete') {
                MtProvinsi::where('id_provinsi', $request->d_id)
                        ->update([
                            'is_trash' => 1,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'restore') {
                MtProvinsi::where('id_provinsi', $request->delidtxt)
                        ->update([
                            'is_trash' => 0,
                            'updated_by' => auth()->user()->id
                ]);
            }

            DB::commit(); // Commit transaction
            return response()->json([
                        'success' => true
            ]);
        } catch (Exception $exc) {
            DB::rollBack(); // Rollback transaction
            Log::error('Failed to create or update user: ' . $exc->getMessage(), [
                'user_id' => auth()->user()->id,
                'request_data' => $request->all(),
            ]);
            return response()->json([
                        'success' => false,
                        'message' => 'Failed to create user.',
                        'error' => $exc->getMessage() // Optionally log the error for debugging
                            ], 500);
        }
    }

    public function edit(Request $request) {
        $exec = MtProvinsi::where('id_provinsi', $request->id)->first();
        if ($exec) {
            if ($request->input('q')) {
                return response()->json([
                            'success' => true,
                            'dt_provinsi' => $exec
                ]);
            } else {
                return response()->json([
                            'success' => true,
                            'dt_provinsi' => $exec
                ]);
            }
        } else {
            return response()->json([
                        'success' => false
            ]);
        }
    }
}
