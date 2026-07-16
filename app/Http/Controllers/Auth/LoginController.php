<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/user/dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Username salah');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        Auth::login($user);

        $request->session()->regenerate();

        $user->update([
            'last_login' => now(),
        ]);

        if ($user->role == 'admin') {
            return redirect('/dashboard');
        }

        return redirect('/user/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
