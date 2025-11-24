<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $devs = User::where('role', 'developer')->get();
        return view('admin.devs.index', compact('devs'));
    }

    public function create()
    {
        return view('admin.devs.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|unique:users,email',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'developer',
        ]);

        return redirect()->route('admin.developer.index')->with('success', 'Developer Berhasil Dibuat');
    }
}
