<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        if (!$request->role_id) {
            $role = Role::find(2);
        } else {
            $role = Role::find($request->role_id);
        }
        $user->roles()->attach($role->id);

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response($res, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $permiso = $user->permissions->makeHidden('pivot')->pluck('slug');

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            'user' => ['email' => $user->email, 'name' => $user->name, 'permiso' => $permiso],
            'token' => $token
        ];

        return response($res, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'user logged out'
        ]);
    }

    public function checkAuthentication(Request $request)
    {
        if (auth('sanctum')->check()) {
            // $token = $user->createToken('apiToken')->plainTextToken;
            $res = [
                'status' => true,
                // 'token' => $token
            ];
            return response($res, 201);
        } else {
            $res = [
                'status' => false,
                'message' => 'token expired',
            ];
            return response($res, 401);
        };
    }
}
