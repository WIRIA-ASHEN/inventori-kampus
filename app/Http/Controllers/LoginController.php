<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate
        if (Auth::attempt($credentials)) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Retrieve authenticated user
            $user = Auth::user();
            // dd($user->role);
            // Redirect based on user role
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/beranda');
                case 'mahasiswa':
                    return redirect()->intended('/mahasiswa');
                case 'dosen':
                    // Add the redirect for dosen if needed
                    return redirect()->intended('/dosen');
                case 'teknisi':
                    // Add the redirect for dosen if needed
                    return redirect()->intended('/beranda');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['email' => 'Role not recognized.']);
            }
        }

        // If authentication fails, return back with error message
        return back()->withErrors([
            'email' => 'email atau password salah',
        ]);
    }


    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Invalidasi sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login');
    }
}
