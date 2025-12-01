<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Lampiran;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $developerId = Auth::id();
        $laporans = Laporan::where('developer_id', $developerId)->orderBy('created_at', 'DESC')->get();
        $client = User::where('role', 'client')->get();

        return view('dev.laporans.index', compact('laporans', 'client'));
    }

    public function selesai()
    {
        $developerId = Auth::id();
        $laporans = Laporan::where('developer_id', $developerId)->orderBy('created_at', 'DESC')->get();
        $client = User::where('role', 'client')->get();
        return view('dev.laporans.selesai', compact('laporans', 'client'));
    }

    public function ditolak()
    {
        $developerId = Auth::id();
        $laporans = Laporan::where('developer_id', $developerId)->orderBy('created_at', 'DESC')->get();
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
        $user = auth()->user();
        $laporan = Laporan::findOrFail($id);
        $lampiran = Lampiran::where('laporan_id', $laporan->id)->get();

        $messages = DB::table('messages')->where('laporan_id', $laporan->id)->orderBy('created_at')->get();

        return view('dev.laporans.show', compact('laporan', 'lampiran', 'messages'));
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
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);
    
        DB::table('messages')->insert([
            'laporan_id' => $id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('active_tab', 'tab3')->with('success', 'Pesan berhasil dikirim');
    }
    
}
