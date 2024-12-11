<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Permission as db_permission;
use App\Models\Parameter as ParameterModel;
use App\Models\User_groups;

class PermissionController extends Controller {

    private function user_permission() {
        return Controller::permission_user();
    }

    public function index(Request $request) {
        $user_access = $this->user_permission();
        $root_user = ParameterModel::where('id', 'ROOT')->first();
        $user_groups = User_groups::where('is_trash', 0)->where('id', '!=', $root_user->param_value)->get();
        return view('permission.index', compact('user_access', 'user_groups'));
    }

    public function json(Request $request) {
        $root_user = ParameterModel::where('id', 'ROOT')->first();
        if (!$this->user_permission()['read']) {
            return [
                'draw' => 0,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        }
        DB::enableQueryLog();
        $exec = User_groups::with('children', 'parent');
        $this->applyFilters($exec, $request);
        if (auth()->user()->role <> $root_user->param_value) {
            $exec->where('id', $root_user->param_value);
        }
        $exec->orderBy('id', 'asc');
        $dt_param = $exec->get();
        
$query = DB::getQueryLog();
$query = end($query);
//dd($query);
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
                $q->where('name', 'like', "%" . $request->keyword . "%")
                        ->orWhere('description', 'like', "%" . $request->keyword . "%");
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
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $row->id . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($this->user_permission()['delete'] && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(&apos;' . $row->id . '&apos;);">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(&apos;' . $row->id . '&apos;);">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        if ($this->user_permission()['delete']) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="configData(&apos;' . $row->id . '&apos;);">
                    <i class="bi bi-gear text-warning mx-2"></i> Config
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function edit(Request $request) {
        $exec = User_groups::where('id', $request->id)->first();
        if ($exec) {
            if ($request->input('q')) {
                return response()->json([
                            'success' => true,
                            'dt_permission' => $exec
                ]);
            } else {
                return response()->json([
                            'success' => true,
                            'dt_permission' => $exec
                ]);
            }
        } else {
            return response()->json([
                        'success' => false
            ]);
        }
    }

    public function store(Request $request) {
        if ($request->q == 'add') {
            $validator = Validator::make($request->all(), [
                'parenttxt' => 'required|integer',
                'nametxt' => 'required|string|max:50|unique:user_groups,name',
                'descriptontxt' => 'required|string'
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
                User_groups::create([
                    'parent_id' => $request->parenttxt,
                    'name' => $request->nametxt,
                    'description' => $request->descriptontxt,
                    'created_by' => auth()->user()->id
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
