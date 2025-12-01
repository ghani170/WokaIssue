<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Laporan;
use App\Models\Project;
use Carbon\Carbon;
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
            $laporanLatest = Laporan::latest()->take(5)->get();
            $startDate = Carbon::today()->subDays(6)->startOfDay();

            // 2. Ambil data laporan, hitung per tanggal
            $reports = Laporan::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->where('created_at', '>=', $startDate)
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->keyBy('date');

            // 3. Siapkan array lengkap (Label Tanggal dan Data Jumlah)
            $reportsPerDayLabels = [];
            $reportsPerDayData = [];

            // Loop selama 7 hari untuk memastikan label dan data berurutan
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::today()->subDays(6 - $i)->format('Y-m-d');
                // Label Tanggal (Contoh: '25 Nov')
                $label = Carbon::parse($date)->format('d M');
                // Ambil jumlah laporan, jika tidak ada, nilainya 0
                $count = $reports->get($date)->count ?? 0;

                $reportsPerDayLabels[] = $label;
                $reportsPerDayData[] = $count;
            }
            return view('admin.dashboard', compact('totalLM', 'totalLK', 'totalCompany', 'totalProject', 'totalLaporan', 'laporanLow', 'laporanMedium', 'laporanHigh', 'laporanCritical', 'laporanLatest', 'reportsPerDayLabels', 'reportsPerDayData'));
        } else if ($user->role === 'developer') {

            $totalLM = Laporan::where('developer_id', Auth::user()->id)->count();
            $totalLS = Laporan::where('status', 'Done')->where('developer_id', Auth::user()->id)->count();
            $totalLD = Laporan::where('status', 'Rejected')->where('developer_id', Auth::user()->id)->count();

            $laporanLow = Laporan::where('prioritas', 'Low')->where('developer_id', Auth::user()->id)->count();
            $laporanMedium = Laporan::where('prioritas', 'Medium')->where('developer_id', Auth::user()->id)->count();
            $laporanHigh = Laporan::where('prioritas', 'High')->where('developer_id', Auth::user()->id)->count();
            $laporanCritical = Laporan::where('prioritas', 'Critical')->where('developer_id', Auth::user()->id)->count();
            $laporanLatest = Laporan::latest()->take(5)->where('developer_id', Auth::user()->id)->get();
            return view('dev.dashboard', compact('totalLM', 'totalLS', 'totalLD', 'laporanLow', 'laporanMedium', 'laporanHigh', 'laporanCritical', 'laporanLatest'));
        } else if ($user->role === 'client') {
            $totalLaporan = Laporan::where('client_id', $user->id)->count();
            $totalProject = Project::where('company_id', $user->company->id)->count();

            $laporanPending = Laporan::where('status', 'Pending')->where('client_id', Auth::user()->id)->count();
            $laporanWorking = Laporan::where('status', 'Working')->where('client_id', Auth::user()->id)->count();
            $laporanDone = Laporan::where('status', 'Done')->where('client_id', Auth::user()->id)->count();
            $laporanRejected = Laporan::where('status', 'Rejected')->where('client_id', Auth::user()->id)->count();
            $laporanLatest = Laporan::latest()->take(5)->where('client_id', Auth::user()->id)->get();
            return view('clients.dashboard', compact('totalLaporan', 'totalProject', 'laporanPending', 'laporanWorking', 'laporanDone', 'laporanRejected', 'laporanLatest'));
        } else {
            abort(403, 'Role pengguna tidak diketahui');
        }
    }
}
