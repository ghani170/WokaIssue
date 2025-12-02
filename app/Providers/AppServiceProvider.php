<?php

namespace App\Providers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $user = Auth::user();

            $doneReports = collect();
            $showDot = false;

            if ($user && $user->role === 'client') {

                // Ambil laporan DONE
                $doneReports = Laporan::where('status', 'Done')
                    ->where('client_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

                // Cek apakah ada laporan done yang belum dibaca
                $showDot = Laporan::where('status', 'Done')
                    ->where('client_id', $user->id)
                    ->where('is_read', false)
                    ->exists();
            }

            $view->with('doneReports', $doneReports)
                ->with('showDot', $showDot);
        });
    }
}
