<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Laporan;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $project = Project::all();
        return view('admin.project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $project = Project::all();
        $company = Company::all();
        return view('admin.project.create', compact([
            'company'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'company_id' => 'required',
            'nama_project' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        Project::create([
            'company_id' => $data['company_id'],
            'nama_project' => $data['nama_project'],
            'deskripsi' => $data['deskripsi'],
        ]);
        return redirect()->route('admin.project.index')->with('success', 'Project berhasil ditambahkan');
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
        $project = Project::findOrFail($id);
        $company = Company::all();
        return view('admin.project.edit', compact('project', 'company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validate([
            'company_id' => 'required',
            'nama_project' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $data = [
            'company_id' => $request->company_id,
            'nama_project' => $request->nama_project,
            'deskripsi' => $request->deskripsi,
        ];

        $project->update($data);
        return redirect()->route('admin.project.index')->with('success', 'Project berhasil diupdate');
    }

    public function updateStatus(Request $request, Project $project)
    {
        $request->validate([
            'status' => 'required|in:Active,Maintenance,Stop'
        ]);

        $project->status = $request->status;
        $project->save();

        // Jika project di STOP → reject semua laporan terkait
        if ($project->status == 'Stop') {
            Laporan::where('project_id', $project->id)
                ->update(['status' => 'Rejected']);
        } elseif ($project->status == 'Active' || $project->status == 'Maintenance') {
            Laporan::where('project_id', $project->id)
                ->where('status', 'Rejected')
                ->update(['status' => 'Pending']);
        }

        return redirect()->route('admin.project.index')->with('success', 'Status berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Cek apakah project memiliki laporan
        if ($project->laporan()->count() > 0) {
            return redirect()->route('admin.project.index')
                ->with('error', 'Project tidak bisa dihapus karena masih memiliki laporan.');
        }

        // Jika tidak memiliki laporan → boleh hapus
        $project->delete();

        return redirect()->route('admin.project.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
