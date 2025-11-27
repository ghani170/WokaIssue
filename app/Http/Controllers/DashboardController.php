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
            $totalLaporan = Laporan::count();
            $laporanLow = Laporan::where('prioritas', 'Low')->count();
            $laporanMedium = Laporan::where('prioritas', 'Medium')->count();
            $laporanHigh = Laporan::where('prioritas', 'High')->count();
            $laporanCritical = Laporan::where('prioritas', 'Critical')->count();
            $laporanLatest = Laporan::latest()->take(10)->get();
            return view('admin.dashboard', compact('totalLM', 'totalLK', 'totalCompany', 'totalProject', 'totalLaporan', 'laporanLow', 'laporanMedium', 'laporanHigh', 'laporanCritical', 'laporanLatest'));
        } else if ($user->role === 'developer') {

            $totalLM = Laporan::count();
            $totalLS = Laporan::where('status', 'Done')->count();
            $totalLD = Laporan::where('status', 'Rejected')->count();

            return view('dev.dashboard', compact('totalLM', 'totalLS', 'totalLD'));
        } else if ($user->role === 'client') {
            return view('clients.dashboard');
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }
}
