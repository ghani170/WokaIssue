<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Laporan;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalProject = Project::count();
            $totalCompany = Company::count();
            $totalLM = Laporan::count();
            $totalLK = Laporan::where('status', 'Done')->count();

            return view('admin.dashboard', compact('totalLM', 'totalLK', 'totalCompany', 'totalProject'));
        } else if ($user->role === 'developer') {

            $totalLM = Laporan::where('developer_id', Auth::user()->id)->count();
            $totalLS = Laporan::where('status', 'Done')->where('developer_id', Auth::user()->id)->count();
            $totalLD = Laporan::where('status', 'Rejected')->where('developer_id', Auth::user()->id)->count();

            return view('dev.dashboard', compact('totalLM', 'totalLS', 'totalLD'));
        } else if ($user->role === 'client') {
            $totalLaporan = Laporan::where('client_id', $user->id)->count();
            $totalProject = Project::where('company_id', $user->company->id)->count();

            return view('clients.dashboard',compact('totalLaporan', 'totalProject'));
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }
}
