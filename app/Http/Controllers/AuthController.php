<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'device_name' => 'required'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);

        return response()->json([
            "token" => $token,
            "user"  => $user
        ]);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (!$token=auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        UserSession::create([
            'user_id' => auth('api')->id(),
            'device_id' => $request->device_id,
            'ip_address' => $request->ip(),
            'login_at' => Carbon::now()
        ]);

        return response()->json([
            'token' => $token,
            'user' => auth('api')->user()
        ]);
    }

    public function logout(Request $request)
    {
        auth('api')->logout();

        UserSession::where('user_id', auth('api')->id())
            ->whereNull('logout_at')
            ->latest()
            ->first()
            ?->update(['logout_at' => Carbon::now()]);

        return response()->json(['message' => 'Logout exitoso']);
    }

    public function profile()
    {
        $user = auth('api')->user();

        return response()->json([
            'usuario' => $user
        ]);
    }
}
