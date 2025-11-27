<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
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
        $laporans = Laporan::all();
        $client = User::where('role', 'client')->get();
        $developer = User::where('role', 'developer')->get();
        return view('admin.laporans.index', compact('laporans', 'client', 'developer'));
    }

    public function activity()
    {
        //
        $laporans = Laporan::all();
        $client = User::where('role', 'client')->get();
        return view('admin.laporans.activity', compact('laporans', 'client'));
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
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'deadline' => 'required|date',
        ]);

        $laporan->deadline = $request->deadline;
        $laporan->save();
        return redirect()->route('admin.laporan.index')->with('success', 'Deadline berhasil diupdate');
    }

    public function updatePrioritas(Request $request, Laporan $laporan)
    {
        $request->validate([
            'prioritas' => 'required|in:Low,Medium,High,Critical',
        ]);

        $laporan->prioritas = $request->prioritas;

        if ($request->prioritas == 'Low' | $request->prioritas == 'Medium') {
            $laporan->deadline = null;
        }
       
        $laporan->save();

        return redirect()->route('admin.laporan.index')->with('success', 'Prioritas berhasil diupdate');
    }

    public function updateDeveloper(Request $request, Laporan $laporan){
        $request->validate([
            'developer_id' => 'nullable|exists:users,id',
        ]);

        $developerId = $request->developer_id;

        $laporan->developer_id = $developerId;

        $laporan->save();
        return redirect()->route('admin.laporan.index')->with('success', 'Developer Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
