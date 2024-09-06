<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('nama', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->back()->with('error', 'Nama atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
