<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSession;
use App\Models\User;
use Carbon\Carbon;

class WebAuthController extends Controller
{
    public function webRegister(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|min:6"
        ]);


        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);

        if ($user) {
            return redirect('/login')->with('success', 'Usuario registrado correctamente');
        }

        return back()->withErrors(['error' => 'Error al registrar']);
    }

    public function webLogin(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->with('error', 'Credenciales incorrectas');
        }

        UserSession::create([
            'user_id' => Auth::id(),
            'device_id' => 'web_device',
            'ip_address' => $request->ip(),
            'login_at' => Carbon::now()
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        UserSession::where('user_id', Auth::id())
            ->latest()
            ->first()
            ->update(['logout_at' => Carbon::now()]);

        Auth::guard('web')->logout();

        return redirect('/login');
    }

    public function profile(){
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }
}
