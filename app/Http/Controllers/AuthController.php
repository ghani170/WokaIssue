<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang admin');
            }elseif ($user->role === 'developer') {
                return redirect()->route('dev.dashboard')->with('success', 'Selamat datang developer');
            }elseif ($user->role === 'client') {
                return redirect()->route('client.dashboard')->with('success', 'selamat datang client');
            }else {
                Auth::logout();
                return redirect()->route('login')->withErrors('Role pengguna tidak ditemukan');
            }
        }
        return back()->withErrors(['email' => 'Email Atau password Salah.'])->onlyInput('email');
    }
    public function logout( Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');

    }
}
