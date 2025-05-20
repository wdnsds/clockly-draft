<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $employee = Employee::where('username', $request->username)->first();


        if (!$employee || !Hash::check($request->password, $employee->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $employee->createToken('api_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $employee,
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}

