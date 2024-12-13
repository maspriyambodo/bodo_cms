<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Permission as db_permission;
use App\Models\Parameter as ParameterModel;
use App\Models\User_groups;
use App\Models\Menu as db_menu;
use App\Models\MenuGroup;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller {

    private function user_permission() {
        return Controller::permission_user();
    }

    private function root_user() {
        return ParameterModel::where('id', 'ROOT')->first();
    }

    public function index(Request $request) {
        $user_access = $this->user_permission();
        $menu_parent = db_menu::where('is_trash', 0)->get();
        $menu_group = MenuGroup::where('is_trash', 0)->get();
        return view('menu.index', compact('user_access', 'menu_parent', 'menu_group'));
    }

    public function json(Request $request) {
        $root_user = $this->root_user();
        $role_user = auth()->user()->role;
        if (!$this->user_permission()['read']) {
            return [
                'draw' => 0,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        }
        $exec = db_menu::with('parent', 'children', 'group');
        $this->applyFilters($exec, $request);
        if ($role_user <> $root_user->param_value) {
            $exec->where('id', $root_user->param_value);
            $exec->orWhere('parent_id', $role_user);
        }
        $exec->orderBy('id', 'asc');
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
                <span class="text-center text-muted py-3 mb-2">' . $row->name . ' Action</span>
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

        $buttons .= "</div>";

        return $buttons;
    }

    private function generate_permission($id_menu) {
        $root_user = $this->root_user();
        $userId = auth()->user()->id;
        $roleIds = User_groups::where('is_trash', 0)->pluck('id')->toArray();

        $form_data = [];

        foreach ($roleIds as $roleId) {
            $form_data[] = [
                'role_id' => $roleId,
                'id_menu' => $id_menu,
                'v' => $root_user->param_value == $roleId ? 1 : 0,
                'c' => $root_user->param_value == $roleId ? 1 : 0,
                'r' => $root_user->param_value == $roleId ? 1 : 0,
                'u' => $root_user->param_value == $roleId ? 1 : 0,
                'd' => $root_user->param_value == $roleId ? 1 : 0,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $userId,
            ];
        }
        db_permission::insert($form_data);
    }

    public function store(Request $request) {
        if ($request->q == 'add') {
            $validator = Validator::make($request->all(), [
                        'parenttxt' => 'nullable|integer|exists:sys_menu,id',
                        'namatxt' => 'required|string|max:50|unique:sys_menu,nama',
                        'linktxt' => 'required|string|max:50|unique:sys_menu,link',
                        'gruptxt' => 'required|integer|exists:sys_menu_group,id',
                        'vistxt' => 'required|integer'
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
                $order_no = db_menu::where('group_menu', $request->gruptxt)->orderBy('order_no', 'desc')->first();
                $dt_menu = db_menu::create([
                            'menu_parent' => $request->parenttxt,
                            'nama' => $request->namatxt,
                            'link' => $request->linktxt,
                            'order_no' => ($order_no->order_no + 1),
                            'group_menu' => $request->gruptxt,
                            'description' => $request->gruptxt,
                            'is_hide' => $request->vistxt,
                            'created_by' => auth()->user()->id
                ]);
                $lastInsertedId = $dt_menu->id;
                $this->generate_permission($lastInsertedId);
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
