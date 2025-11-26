<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Lampiran;
use App\Models\Laporan;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $laporans = Laporan::where('client_id', $user->id)->get();

        return view('clients.laporan.index', compact('laporans', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user(); // client login

        // ambil semua project yang company_id nya sama dengan client
        $projects = Project::where('company_id', $user->company_id)->get();

        return view('clients.laporan.create', compact('user', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required',
            // wajib upload minimal 1 file
            'dokumentasi' => 'required',

            // validasi semua file termasuk video
            'dokumentasi.*' => 'file|max:204800|mimes:jpg,jpeg,png,pdf,doc,docx,txt,mp4,mov,avi,mkv'
            // max 200MB per file (204800 KB)
        ]);

        $data =  Laporan::create([
            'client_id' => $request->client_id,
            'project_id' => $request->project_id,
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
        ]);

        if ($request->hasFile('dokumentasi')) {

        foreach ($request->file('dokumentasi') as $file) {

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // File disimpan di storage/app/public/lampiran
            $path = $file->storeAs('lampiran', $filename, 'public');

            Lampiran::create([
                'laporan_id' => $data->id,
                'dokumentasi' => $path,
            ]);
        }
    }

        return redirect()->route('client.laporan.index')->with('success', 'Laporan berhasil dibuat.');
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
    public function edit(Laporan $laporan)
    {
        //
        $user = Auth::user();
        $lampiran = Lampiran::where('laporan_id', $laporan->id)->get();

        $projects = Project::where('company_id', $user->company_id)->get();

        return view('clients.laporan.edit',compact('laporan','projects', 'lampiran'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'project_id' => 'required',
            'title' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tipe' => 'required',
        ]);

        $laporan->update([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'deskripsi' => $request->deskripsi,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('client.laporan.index')->with('success','laporan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
    
        $lampiran = Lampiran::where('laporan_id', $laporan->id)->first();
        if ($lampiran && $lampiran->dokumentasi) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($lampiran->dokumentasi);
            $lampiran->delete();
        }
    
        $laporan->delete();
    
        return redirect()->route('client.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
    
}
