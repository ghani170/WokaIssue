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
            return view('dev.dashboard');
        } else if ($user->role === 'client') {
            return view('clients.dashboard');
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }
}
