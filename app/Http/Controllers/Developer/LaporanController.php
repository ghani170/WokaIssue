<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $laporans = Laporan::all();
        $client = User::where('role', 'client')->get();
        return view('dev.laporans.index', compact('laporans', 'client'));
    }

    public function selesai()
    {
        //
        $laporans = Laporan::all();
        $client = User::where('role', 'client')->get();
        return view('dev.laporans.selesai', compact('laporans', 'client'));
    }

    public function ditolak()
    {
        //
        $laporans = Laporan::all();
        $client = User::where('role', 'client')->get();
        return view('dev.laporans.ditolak', compact('laporans', 'client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:Pending,Working,Done,Rejected'
        ]);

        $laporan->status = $request->status;
        $laporan->save();
        return redirect()->route('dev.laporan.index')->with('success', 'Status berhasil diupdate');
    }

    public function destroy(string $id)
    {
        //
    }
}
