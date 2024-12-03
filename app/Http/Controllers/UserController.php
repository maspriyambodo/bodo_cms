<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_groups;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {

    public function json(Request $request) {
        DB::enableQueryLog();
        $exec = User::select('users.id', 'users.name', 'users.email', 'users.is_trash', 'users.created_at', 'user_groups.name AS role_name')
                ->join('user_groups', 'users.role', '=', 'user_groups.id');
        $this->applyFilters($exec, $request);
        $users = $exec->latest()->get();
        $query = DB::getQueryLog();
        $query = end($query);
        return Datatables::of($users)
                        ->editColumn('created_at', fn($row) => date('d/M/Y', strtotime($row->created_at)))
                        ->addColumn('status_aktif', fn($row) => $row->is_trash == 0 ? "<span class=\"badge badge-success w-100\">aktif</span>" : "<span class=\"badge badge-light-dark w-100\">deleted</span>")
                        ->addColumn('button', fn($row) => $this->getActionButtons($row))
                        ->rawColumns(['status_aktif', 'button'])
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

    private function getActionButtons($row) {
        $exec = Controller::permission_user();
        if (!$exec['update'] && !$exec['delete']) {
            return '';
        }
        $buttons = '<a type="button" class="btn btn-secondary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
            <i class="bi bi-three-dots-vertical"></i>
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">';

        if ($exec['update']) {
            $buttons .= '<div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Edit
                </a>
            </div>';
        }

        if ($exec['delete']) {
            $buttons .= '<div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Delete
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
        return view('users.index', compact('default_password', 'dt_role'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'namatxt' => 'required|string|max:255',
            'mailtxt' => 'required|email|max:255|unique:users,email', // Ensure the email is unique
            'pwtxt' => 'required|string|min:6', // Adjust the validation rules as needed
            'leveltxt' => 'required|integer|exists:user_groups,id', // Assuming 'roles' is your roles table
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                            ], 422);
        }
        try {
            $user = User::create([
                'name' => $request->namatxt,
                'email' => $request->mailtxt,
                'password' => Hash::make($request->pwtxt),
                'role' => $request->leveltxt,
                'created_by' => auth()->user()->id
            ]);

            return response()->json([
                        'success' => true,
                        'message' => 'User  created successfully!',
                        'user' => $user, // Optionally return the created user
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create user: ' . $e->getMessage());
            return response()->json([
                        'success' => false,
                        'message' => 'Failed to create user.',
                        'error' => $e->getMessage() // Optionally log the error for debugging
                            ], 500);
        }
    }

    public function edit(User $user) {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('role', 'name', 'email'));

        return redirect()->route('users.index')->with('success', 'User  updated successfully.');
    }

    public function destroy(User $user) {
        $user->update(['is_trash' => 1]);
        return redirect()->route('users.index')->with('success', 'User  deleted successfully.');
    }
}
