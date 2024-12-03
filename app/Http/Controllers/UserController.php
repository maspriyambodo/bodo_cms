<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    protected $view, $create, $read, $update, $delete;

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
        </a><div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
            <div class="menu-item px-3">
                <a href="#" class="menu-link px-3">
                    Menu item 1
                </a>
            </div>
        </div>';

//        if ($exec['update']) {
//            $buttons .= '<li><a class="dropdown-item" href="#">Edit</a></li>';
//        }
//
//        if ($exec['delete']) {
//            $buttons .= '<li><a class="dropdown-item" href="#">Delete</a></li>';
//        }

//        $buttons .= "</ul></div>";

        return $buttons;
    }

    public function index(Request $request) {
        if (request()->ajax()) {
            return DataTables::of(User::query())->toJson();
        }

        return view('users.index');
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' => auth()->id(), // assuming you have authentication
        ]);

        return redirect()->route('users.index')->with('success', 'User  created successfully.');
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
