<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $company = Company::all();
        return view('admin.clients.create', compact('company'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|unique:users,email',
            'company_id' => 'required|exists:companies,id',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), 
            'company_id' => $data['company_id'],
            'role' => 'client',
        ]);

        return redirect()->route('admin.client.index')->with('success', 'Client Berhasil Dibuat.');
    }

    public function edit($id){
        $clients = User::findOrFail($id);
        $company = Company::all();
        return view('admin.clients.edit', compact('clients', 'company'));
    }

    public function update(Request $request, $id){
        $clients = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'. $clients->id,
            'password' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ];

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        $clients->update($data);

        return redirect()->route('admin.client.index')->with('success', 'Client Berhasil Diperbarui.');
    }

    public function destroy(User $client){
        if ($client->client()->count() >0) {    
            $client->client = null;
            return redirect()->route('admin.client.index')->with('success', 'Client tidak bisa dihapus karena masih memiliki laporan');
        }

        if ($client->role !== 'client') {
            return redirect()->route('admin.client.index')->with('success', 'User bukan client');
        }

        $client->delete();
        return redirect()->route('admin.client.index')->with('success', 'client berhasil dihapus');
    }
}
