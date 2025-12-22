<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $company = Company::all();
        return  view('admin.company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ]);

     
        $exists = Company::where('name', $request->name)
            ->where('alamat', $request->alamat)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'name' => 'Perusahaan dengan nama dan alamat ini sudah ada.',
            ])->withInput();
        }

        Company::create($data);

        return redirect()->route('admin.company.index')
            ->with('success', 'Company Berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //

        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
        ]);

        $exists = Company::where('name', $request->name)
            ->where('alamat', $request->alamat)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'name' => 'Perusahaan dengan nama dan alamat ini sudah terdaftar.',
            ])->withInput();
        }

        $company = Company::findOrFail($id);
        $company->update($data);

        return redirect()->route('admin.company.index')
            ->with('success', 'Company Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Cek apakah company memiliki project
        if ($company->project()->count() > 0) {
            return redirect()->route('admin.company.index')
                ->with('error', 'Company tidak bisa dihapus karena masih memiliki project.');
        }

        // Jika tidak memiliki laporan → boleh hapus
        $company->delete();

        return redirect()->route('admin.company.index')
            ->with('success', 'Company berhasil dihapus.');
    }
}
