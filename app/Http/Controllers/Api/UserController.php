<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get all users",
 *     tags={"Users"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
 *     )
 * )
 */
class UserController extends Controller {

    private function root_user() {
        return Parameter::where('id', 'ROOT')->first();
    }

    // Get All Users
    public function index() {
        $root_user = $this->root_user();
        return response()->json(User::where('is_trash', 0)
                                ->where('role', '<>', $root_user->param_value)
                                ->orderBy('id', 'asc')
                                ->paginate(), 200);
    }

    // Get Single User
    public function show($id) {
        $user = User::find($id);
        if (!$user || $user->is_trash) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

    // Create a New User
    public function store(Request $request) {
        $validated = $request->validate([
            'role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $validated['password'] = Hash::make($request->password);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Update User
    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!$user || $user->is_trash) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'role' => 'integer',
            'name' => 'string|max:255',
            'email' => ['string', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->has('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

    // Soft Delete User (Move to Trash)
    public function destroy($id) {
        $user = User::find($id);
        if (!$user || $user->is_trash) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update(['is_trash' => 1]);

        return response()->json(['message' => 'User moved to trash'], 200);
    }
}
