<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'developer',
        ]);

        return redirect()->route('admin.developer.index')->with('success', 'Developer Berhasil Dibuat');
    }

    public function edit($id){
        $dev = User::findOrFail($id);
        return view('admin.devs.edit', compact('dev'));
    }

    public function update(Request $request, $id){
        $dev = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'. $dev->id,
            'password' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $dev->update($data);

        return redirect()->route('admin.developer.index')->with('success', 'Developer Berhasil Diperbarui');
    }

    public function destroy(User $developer){
        
        if ($developer->developer()->count() > 0) {
            return redirect()->route('admin.developer.index')->with('error', 'Developer tidak bisa dihapus karena masih memiliki laporan');
        }

        if ($developer->role !== 'developer') {
            return redirect()->route('admin.developer.index')->with('error', 'User bukan developer');
        }

        $developer->delete();

        return redirect()->route('admin.developer.index')->with('success', 'Developer berhasil dihapus');
    }
}
