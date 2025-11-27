<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id)
    {
        $clients = User::findOrFail($id);
        $company = Company::all();
        return view('admin.clients.edit', compact('clients', 'company'));
    }

    public function update(Request $request, $id)
    {
        $clients = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $clients->id,
            'password' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'company_id' => $request->company_id,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $clients->update($data);

        return redirect()->route('admin.client.index')->with('success', 'Client Berhasil Diperbarui.');
    }

    public function destroy(User $client)
    {
        if ($client->role !== 'client') {
            return redirect()->route('admin.client.index')
                ->with('error', 'User bukan client.');
        }

        // Ambil semua laporan milik client
        $laporans = Laporan::where('client_id', $client->id)->get();

        foreach ($laporans as $laporan) {

            // ambil semua lampiran
            foreach ($laporan->lampiran as $lamp) {

                // hapus file dari storage
                if ($lamp->dokumentasi && Storage::disk('public')->exists($lamp->dokumentasi)) {
                    Storage::disk('public')->delete($lamp->dokumentasi);
                }

                // hapus record lampiran
                $lamp->delete();
            }

            // hapus laporan
            $laporan->delete();
        }

        // Terakhir: hapus user
        $client->delete();

        return redirect()->route('admin.client.index')
            ->with('success', 'Client dan semua laporannya berhasil dihapus.');
    }
}
