<?php

namespace App\Http\Controllers\Penyuluh;

use App\Http\Controllers\Controller;
use App\Models\PenyuluhModels;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PenyuluhController extends Controller {

    private function root_user() {
        return Parameter::where('id', 'ROOT')->first();
    }

    public function json(Request $request) {
        $root_user = $this->root_user();
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
        $TotalRecords = PenyuluhModels::count();
        $exec = PenyuluhModels::with('provinsi', 'kabupaten', 'kecamatan', 'tugas_kua')->orderBy('tugas_kua', 'asc');
        if (auth()->user()->role <> $root_user->param_value) {
            $exec->where('is_trash', 0);
        }
        $this->applyFilters($exec, $request);
        $users = $exec->offset($offset)->limit($limit)->get();
        if($request->keyword) {
            $FilteredRecords = count($users);
        } else {
            $FilteredRecords = $TotalRecords;
        }
        return Datatables::of($users)
                        ->addIndexColumn()
                        ->editColumn('created_at', fn($row) => \Carbon\Carbon::parse($row->created_date)->format('d/M/Y'))
                        ->editColumn('tanggal_lahir', fn($row) => \Carbon\Carbon::parse($row->tanggal_lahir)->translatedFormat('d F Y'))
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
                $q->where('dt_penyuluh.nama', 'like', "%" . $request->keyword . "%")
                        ->orWhere('dt_penyuluh.nip', 'like', "%" . $request->keyword . "%")
                        ->orWhere('dt_penyuluh.nipa', 'like', "%" . $request->keyword . "%")
                        ->orWhere('dt_penyuluh.nik', 'like', "%" . $request->keyword . "%")
                        ->orWhere('dt_penyuluh.email', 'like', "%" . $request->keyword . "%");
            });
            $query->whereHas('provinsi', function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
            });
            $query->whereHas('kabupaten', function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
            });
            $query->whereHas('kecamatan', function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
            });
            $query->whereHas('tugas_kua', function ($q) use ($request) {
                $q->where('nama', 'like', "%" . $request->keyword . "%");
            });
        }
    }

    private function getActionButtons($row) {
        $encIdUser = encrypt($row->id);
        $permissions = $this->permission_user();
        $canUpdate = $permissions['update'];
        $canDelete = $permissions['delete'];
        if (!$canUpdate && !$canDelete) {
            return '';
        }
        $buttons = '<a type="button" class="btn btn-secondary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="right-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true"><div class="menu-item px-3">
                <span class="text-center text-muted py-3">Menu Action</span>
            </div>';

        if ($canUpdate) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="editData(&apos;' . $encIdUser . '&apos;);">
                    <i class="bi bi-pencil-square text-warning mx-2"></i> Edit
                </a>
            </div>';
        }

        if ($canDelete) {
            if ($row->is_trash == 0) {
                $buttons .= '<div class="menu-item px-3 border">
                            <a href="javascript:void(0);" class="menu-link px-3" onclick="deleteData(\'' . $encIdUser . '\');">
                                <i class="bi bi-trash text-danger mx-2"></i> Delete
                            </a>
                          </div>';
            } else {
                $buttons .= '<div class="menu-item px-3 border">
                            <a href="javascript:void(0);" class="menu-link px-3" onclick="restoreData(\'' . $encIdUser . '\');">
                                <i class="bi bi-recycle text-success mx-2"></i> Activate
                            </a>
                          </div>';
            }
        }

        if ($canDelete) {
            $buttons .= '<div class="menu-item px-3 border">
                <a href="javascript:void(0);" class="menu-link px-3" onclick="detailPenyuluh(&apos;' . $encIdUser . '&apos;);">
                    <i class="fas fa-eye text-info mx-2"></i> Detail
                </a>
            </div>';
        }

        $buttons .= "</div>";

        return $buttons;
    }

    public function index(Request $request) {
        $user_access = $this->permission_user();
        return view('penyuluh.index', compact('user_access'));
    }

    public function edit(Request $request) {
        $dec_id_user = decrypt($request->id);
        $exec = PenyuluhModels::where('id', $dec_id_user)->first();
        if ($exec) {
            $enc_id_user = encrypt($exec->id); // generate new id encryption
            return response()->json([
                'success' => true,
                'new_id' => $enc_id_user,
                'dt_user' => $exec,
            ]);
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
