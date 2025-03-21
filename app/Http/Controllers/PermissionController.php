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
use App\Models\UsergroupsModels;
use App\Models\Menu as db_menu;

class PermissionController extends Controller {

    private function root_user() {
        return ParameterModel::where('id', 'ROOT')->first();
    }

    public function index(Request $request) {
        $user_access = $this->permission_user();
        $root_user = $this->root_user();
        $user_groups = UsergroupsModels::where('is_trash', 0)->where('id', '!=', $root_user->param_value)->get();
        return view('permission.index', compact('user_access', 'user_groups'));
    }

    public function json2(Request $request) {
        $exec = db_permission::with('menu')->where('role_id', $request->role_id);
        $dt_param = $exec->get();
        if (count($dt_param)) {
            $dt_param = $exec->get();
        } else {
            $this->insert_permission($request->role_id);
            $dt_param = $exec->get();
        }
        return Datatables::of($dt_param)
                        ->addColumn('view', fn($row) => '<input type="hidden" name="id_menu[]" value="' . $row->menu->id . '"/>' . $this->generateCheckbox('viewtxt[]', $row->menu->id, $row->v, 'vtxt' . $row->menu->id))
                        ->addColumn('create', fn($row) => $this->generateCheckbox('createtxt[]', $row->menu->id, $row->c, 'ctxt' . $row->menu->id))
                        ->addColumn('read', fn($row) => $this->generateCheckbox('readtxt[]', $row->menu->id, $row->r, 'rtxt' . $row->menu->id))
                        ->addColumn('update', fn($row) => $this->generateCheckbox('updatetxt[]', $row->menu->id, $row->u, 'utxt' . $row->menu->id))
                        ->addColumn('delete', fn($row) => $this->generateCheckbox('deletetxt[]', $row->menu->id, $row->d, 'dtxt' . $row->menu->id))
                        ->rawColumns(['view', 'create', 'read', 'update', 'delete'])
                        ->make(true);
    }

    private function generateCheckbox($name, $menuId, $value, $id) {
        $checked = $value == 1 ? 'checked' : '';
        $onclick_event = '';
        if ($name == 'viewtxt[]') {
            $onclick_event = 'v_menu(' . $menuId . ');';
        } elseif ($name == 'createtxt[]') {
            $onclick_event = 'c_menu(' . $menuId . ');';
        } elseif ($name == 'readtxt[]') {
            $onclick_event = 'r_menu(' . $menuId . ');';
        } elseif ($name == 'updatetxt[]') {
            $onclick_event = 'u_menu(' . $menuId . ');';
        } else {
            $onclick_event = 'd_menu(' . $menuId . ');';
        }
        return '<div>
                <input name="' . $name . '" class="form-check-input" type="checkbox" id="' . $id . '" value="' . $value . '" onclick="' . $onclick_event . '" ' . $checked . '>
                    <input name="t' . $name . '" class="form-check-input" type="hidden" id="t' . $id . '" value="' . $value . '">
            </div>';
    }

    public function json(Request $request) {
        $root_user = $this->root_user();
        $role_user = auth()->user()->role;
        if (!$this->permission_user()['read']) {
            return response()->json([
                        'draw' => 0,
                        'recordsTotal' => 0,
                        'recordsFiltered' => 0,
                        'data' => []
            ]);
        }
        $exec = UsergroupsModels::with('children', 'parent');
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
        if (!$this->permission_user()['update'] && !$this->permission_user()['delete']) {
            return '';
        }
        $buttons = '<a type="button" class="btn btn-secondary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true"><div class="menu-item px-3">
                <span class="text-center text-muted py-3 mb-2">' . $row->name . ' Action</span>
            </div>';

        if ($this->permission_user()['update']) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $row->id . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($this->permission_user()['delete'] && $row->is_trash == 0) {
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

        if ($this->permission_user()['delete'] && $row->is_trash == 0) {
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
        $exec = UsergroupsModels::where('id', $request->id)->first();
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
        } elseif ($request->q == 'update') {
            $validator = Validator::make($request->all(), [
                'parenttxt2' => 'required|integer',
                'nametxt2' => 'required|string|max:50',
                'descriptontxt2' => 'required|string'
            ]);
        } elseif ($request->q == 'delete') {
            $validator = Validator::make($request->all(), [
                'd_id' => 'required|integer',
            ]);
        } elseif ($request->q == 'setpermission') {
            $validator = Validator::make($request->all(), [
                'setidtxt' => 'required|integer',
            ]);
        } elseif ($request->q == 'restore') {
            $validator = Validator::make($request->all(), [
                'delidtxt' => 'required|integer',
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
                $User_groups = UsergroupsModels::create([
                    'parent_id' => $request->parenttxt,
                    'name' => $request->nametxt,
                    'description' => $request->descriptontxt,
                    'created_by' => auth()->user()->id
                ]);
                $lastInsertedId = $User_groups->id;
                $this->insert_permission($lastInsertedId);
            } elseif ($request->q == 'update') {
                UsergroupsModels::where('id', $request->idtxt2)
                        ->update([
                            'parent_id' => $request->parenttxt2,
                            'name' => $request->nametxt2,
                            'description' => $request->descriptontxt2,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->q == 'delete') {
                UsergroupsModels::where('id', $request->d_id)
                        ->update([
                            'is_trash' => 1,
                            'updated_by' => auth()->user()->id
                ]);
                $this->delete_permission($request->d_id);
            } elseif ($request->q == 'setpermission') {
                $setpermission = $this->set_permission($request);
            } elseif ($request->q == 'restore') {
                UsergroupsModels::where('id', $request->delidtxt)
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

    private function set_permission($data) {
        for ($index = 0; $index < count($data->id_menu); $index++) {
            $id_menu = $data->id_menu[$index];
            $role_id = $data->setidtxt;
            $form_data[$index] = [
                'role_id' => $role_id,
                'id_menu' => $id_menu,
                'v' => $data->tviewtxt[$index],
                'c' => $data->tcreatetxt[$index],
                'r' => $data->treadtxt[$index],
                'u' => $data->tupdatetxt[$index],
                'd' => $data->tdeletetxt[$index],
                'updated_by' => auth()->user()->id
            ];
        }

        foreach ($form_data as $permissionData) {
            db_permission::updateOrCreate(
                    [
                        'role_id' => $permissionData['role_id'],
                        'id_menu' => $permissionData['id_menu'],
                    ],
                    [
                        'v' => $permissionData['v'],
                        'c' => $permissionData['c'],
                        'r' => $permissionData['r'],
                        'u' => $permissionData['u'],
                        'd' => $permissionData['d'],
                        'updated_by' => $permissionData['updated_by'],
                    ]
            );
        }
        return [
            'role_id' => $role_id,
            'id_menu' => $id_menu,
            $form_data
        ];
    }

    private function delete_permission($id_role) {
        $tot_menu = db_menu::all();
        for ($index = 0; $index < count($tot_menu); $index++) {
            db_permission::where('role_id', $id_role)
                    ->update([
                        'is_trash' => 1,
                        'v' => 0,
                        'c' => 0,
                        'r' => 0,
                        'u' => 0,
                        'd' => 0,
                        'updated_by' => auth()->user()->id
            ]);
        }
        return true;
    }

    private function insert_permission($id_role) {
        $tot_menu = db_menu::where('is_trash', 0)->get();
        for ($index = 0; $index < count($tot_menu); $index++) {
            $permission = new db_permission();
            $permission->role_id = $id_role;
            $permission->id_menu = $tot_menu[$index]->id;
            $permission->v = 0;
            $permission->c = 0;
            $permission->r = 0;
            $permission->u = 0;
            $permission->d = 0;
            $permission->created_by = auth()->user()->id;
            $permission->save();
        }
    }
}
