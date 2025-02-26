<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Parameter as db_param;

class Parameter extends Controller {

    public function index(Request $request) {
        $user_access = $this->user_permission();
        return view('parameter.index', compact('user_access'));
    }

    private function user_permission() {
        return Controller::permission_user();
    }

    public function json(Request $request) {
        if (!$this->user_permission()['read']) {
            return response()->json([
                        'draw' => 0,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => []
            ]);
        }
        $exec = db_param::select('id AS id_param', 'param_group', 'param_value', 'param_desc', 'is_trash', 'created_at');
        $this->applyFilters($exec, $request);
        $exec->orderBy('param_group', 'asc');
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
                $q->where('id', 'like', "%" . $request->keyword . "%")
                        ->orWhere('param_group', 'like', "%" . $request->keyword . "%")
                        ->orWhere('param_value', 'like', "%" . $request->keyword . "%")
                        ->orWhere('param_desc', 'like', "%" . $request->keyword . "%");
            });
        }
    }

    private function getActionButtons($row) {
        if (!$this->user_permission()['update'] && !$this->user_permission()['delete']) {
            return '';
        }
        $buttons = '<a type="button" class="btn btn-secondary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true"><div class="menu-item px-3">
                <span class="text-center text-muted py-3">Menu Action</span>
            </div>';

        if ($this->user_permission()['update']) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $row->id_param . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($this->user_permission()['delete'] && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(&apos;' . $row->id_param . '&apos;);">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(&apos;' . $row->id_param . '&apos;);">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function edit(Request $request) {
        $exec = db_param::select('id AS id_param', 'param_group', 'param_value', 'param_desc', 'is_trash', 'created_at')->where('id', $request->id)->first();
        if ($exec) {
            return response()->json([
                        'success' => true,
                        'dt_param' => $exec
            ]);
        } else {
            return response()->json([
                        'success' => false
            ]);
        }
    }

    public function store(Request $request) {
        if ($request->q == 'add') {
            $validator = Validator::make($request->all(), [
                'idtxt' => 'required|string|max:255|unique:sys_param,id',
                'gruptxt' => 'required|string|max:255',
                'valtxt' => 'required|string|max:255',
                'desctxt' => 'required|string',
            ]);
        } elseif ($request->q == 'update') {
            $validator = Validator::make($request->all(), [
                'idtxt2' => 'required|string|max:255',
                'gruptxt2' => 'required|string|max:255',
                'valtxt2' => 'required|string|max:255',
                'desctxt2' => 'required|string',
            ]);
        } elseif ($request->q == 'delete') {
            $validator = Validator::make($request->all(), [
                'idtxt3' => 'required|string|max:255',
                'gruptxt3' => 'required|string|max:255',
                'valtxt3' => 'required|string|max:255',
                'desctxt3' => 'required|string',
            ]);
        } elseif ($request->q == 'restore') {
            $validator = Validator::make($request->all(), [
                'idtxt4' => 'required|string|max:255',
                'gruptxt4' => 'required|string|max:255',
                'valtxt4' => 'required|string|max:255',
                'desctxt4' => 'required|string',
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
                db_param::create([
                    'id' => $request->idtxt,
                    'param_group' => $request->gruptxt,
                    'param_value' => $request->valtxt,
                    'param_desc' => $request->desctxt,
                    'created_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'update') {
                db_param::where('id', $request->idtxt2)
                        ->update([
                            'param_group' => $request->gruptxt2,
                            'param_value' => $request->valtxt2,
                            'param_desc' => $request->desctxt2,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'delete') {
                db_param::where('id', $request->idtxt3)
                        ->where('param_value', $request->valtxt3)
                        ->update([
                            'is_trash' => 1,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'restore') {
                db_param::where('id', $request->idtxt4)
                        ->where('param_value', $request->valtxt4)
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
}
