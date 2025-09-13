<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Redirect based on user role
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif (Auth::user()->role === 'instructor') {
            return redirect()->intended('/instructor/dashboard');
        } else {
            return redirect()->intended('/siswa/dashboard');
        }
    }
}