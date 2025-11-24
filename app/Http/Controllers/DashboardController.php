<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } else if ($user->role === 'developer') {
            return view('dev.dashboard');
        } else if ($user->role === 'client') {
            return view('clients.dashboard');
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }
}
