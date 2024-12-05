<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_groups;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller {

    private function user_permission() {
        return Controller::permission_user();
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
        $exec = DB::table(DB::raw('(SELECT @row := 0) AS a, users'))->select(DB::raw('(@row := @row + 1) AS no_urut'), 'users.id', 'users.pict', 'users.name', 'users.email', 'users.is_trash', 'users.created_at', 'user_groups.name AS role_name')
                ->join('user_groups', 'users.role', '=', 'user_groups.id');
        if (auth()->user()->role <> 9) {
            $exec->where('is_trash', 0);
        }
        $this->applyFilters($exec, $request);
        $exec->orderBy('users.name', 'asc');
        $users = $exec->get();
        return Datatables::of($users)
                        ->editColumn('created_at', fn($row) => date('d/M/Y', strtotime($row->created_at)))
                        ->addColumn('status_aktif', fn($row) => $row->is_trash == 0 ? "<span class=\"badge badge-success w-100\">aktif</span>" : "<span class=\"badge badge-light-dark w-100\">deleted</span>")
                        ->addColumn('button', fn($row) => $this->getActionButtons($row))
                        ->addColumn('picture', fn($row) => $this->getPictUser($row))
                        ->rawColumns(['status_aktif', 'button', 'picture'])
                        ->make(true);
    }

    private function applyFilters($query, Request $request) {
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('users.name', 'like', "%" . $request->keyword . "%")
                        ->orWhere('users.email', 'like', "%" . $request->keyword . "%")
                        ->orWhere('user_groups.name', 'like', "%" . $request->keyword . "%");
            });
        }
    }

    private function getPictUser($row) {
        if ($row->pict) {
            $picture = '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <a href="' . asset($row->pict) . '" data-lightbox="user-picture" data-title="' . $row->name . '">
                                                            <div class="symbol-label">
                                    <img src="' . asset($row->pict) . '" alt="' . asset($row->name) . '" class="w-100">
                                </div>
                                                    </a>
                    </div>';
        } else {
            $picture = '';
        }
        return $picture;
    }

    private function getActionButtons($row) {
        $enc_id_user = encrypt($row->id);
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
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $enc_id_user . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($this->user_permission()['delete'] && $row->is_trash == 0) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(&apos;' . $enc_id_user . '&apos;);">
                    <i class="bi bi-trash text-danger mx-2"></i> Delete
                </a>
            </div>';
        } else {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(&apos;' . $enc_id_user . '&apos;);">
                    <i class="bi bi-recycle text-success mx-2"></i> Activate
                </a>
            </div>';
        }

        if ($this->user_permission()['delete']) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="resetPassword(&apos;' . $enc_id_user . '&apos;);">
                    <i class="bi bi-key text-info mx-2"></i> Reset Password
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function index(Request $request) {
        $default_password = Parameter::where('id', 'DEFAULT_PASSWORD')->first();
        $root_user = Parameter::where('id', 'ROOT')->first();
        $dt_role = User_groups::where('is_trash', 0)->where('id', '!=', $root_user->param_value)->get();
        $user_access = $this->user_permission();
        return view('users.index', compact('default_password', 'dt_role', 'user_access'));
    }

    public function create() {
        return view('users.create');
    }

    public function edit(Request $request) {
        $dec_id_user = decrypt($request->id);
        $default_password = Parameter::where('id', 'DEFAULT_PASSWORD')->first();
        $exec = User::where('id', $dec_id_user)->first();
        if ($exec) {
            $enc_id_user = encrypt($exec->id); // generate new id encryption
            if ($request->input('q')) {
                return response()->json([
                            'success' => true,
                            'new_id' => $enc_id_user,
                            'dt_user' => $exec,
                            'default_password' => $default_password->param_value
                ]);
            } else {
                return response()->json([
                            'success' => true,
                            'new_id' => $enc_id_user,
                            'dt_user' => $exec,
                ]);
            }
        } else {
            return response()->json([
                        'success' => false
            ]);
        }
    }

    public function store(Request $request) {
        if ($request->e_id) {
            $dec_id_user = decrypt($request->e_id);
            $validator = Validator::make($request->all(), [
                'namatxt2' => 'required|string|max:255',
                'mailtxt2' => 'required|email|max:255',
                'leveltxt2' => 'required|integer|exists:user_groups,id', // Assuming 'roles' is your roles table
            ]);
        } elseif ($request->d_id) {
            $dec_id_user2 = decrypt($request->d_id); // delete id user
            $validator = Validator::make($request->all(), [
                'd_id' => 'required',
            ]);
        } elseif ($request->d_id2) {
            $dec_id_user3 = decrypt($request->d_id2); // delete id user
            $validator = Validator::make($request->all(), [
                'd_id2' => 'required',
            ]);
        } elseif ($request->d_id3) {
            $dec_id_user4 = decrypt($request->d_id3); // delete id user
            $validator = Validator::make($request->all(), [
                'd_id3' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'namatxt' => 'required|string|max:255',
                'mailtxt' => 'required|email|max:255|unique:users,email', // Ensure the email is unique
                'pwtxt' => 'required|string|min:6', // Adjust the validation rules as needed
                'leveltxt' => 'required|integer|exists:user_groups,id', // Assuming 'roles' is your roles table
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
            if ($request->e_id) {
                User::where('id', $dec_id_user)
                        ->update([
                            'name' => $request->namatxt2,
                            'email' => $request->mailtxt2,
                            'role' => $request->leveltxt2,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->d_id) {
                User::where('id', $dec_id_user2)
                        ->update([
                            'is_trash' => 1,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->d_id2) {
                User::where('id', $dec_id_user3)
                        ->update([
                            'is_trash' => 0,
                            'updated_by' => auth()->user()->id
                ]);
            } elseif ($request->d_id3) {
                $default_password = Parameter::where('id', 'DEFAULT_PASSWORD')->first();
                User::where('id', $dec_id_user4)
                        ->update([
                            'password' => Hash::make($default_password->param_value),
                            'updated_by' => auth()->user()->id
                ]);
            } else {
                User::create([
                    'name' => $request->namatxt,
                    'email' => $request->mailtxt,
                    'password' => Hash::make($request->pwtxt),
                    'role' => $request->leveltxt,
                    'created_by' => auth()->user()->id
                ]);
            }
            DB::commit(); // Commit transaction
            return response()->json([
                        'success' => true
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction
            Log::error('Failed to create or update user: ' . $e->getMessage(), [
                'user_id' => auth()->user()->id,
                'request_data' => $request->all(),
            ]);
            return response()->json([
                        'success' => false,
                        'message' => 'Failed to create user.',
                        'error' => $e->getMessage() // Optionally log the error for debugging
                            ], 500);
        }
    }

    public function destroy(User $user) {
        $user->update(['is_trash' => 1]);
        return redirect()->route('users.index')->with('success', 'User  deleted successfully.');
    }
}
