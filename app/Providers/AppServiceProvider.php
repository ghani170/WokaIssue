<?php

namespace App\Providers;

use App\Models\Laporan;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {

    $user = Auth::user();

    $doneReports = collect();
    $showDot = false;

    // 🔵 Tambahan untuk messages
    $latestMessages = collect();
    $unreadMessages = 0;

    if ($user) {

        // ==========================
        //  LAPORAN (SUDAH OK)
        // ==========================
        if ($user->role === 'client') {
            $doneReports = Laporan::where('status', 'Done')
                ->where('client_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            $showDot = Laporan::where('status', 'Done')
                ->where('client_id', $user->id)
                ->where('is_read', false)
                ->exists();
        }

        // ==========================
        //  🔵 MESSAGE (TABEL TERPISAH)
        // ==========================
        $latestMessages = Message::where('receiver_id', $user->id)
            ->with('sender') // agar bisa memanggil $msg->sender->name
            ->latest()
            ->take(5)
            ->get();

        $unreadMessages = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();
    }

    // Kirim ke semua view
    $view->with([
        'doneReports'    => $doneReports,
        'showDot'        => $showDot,
        'latestMessages' => $latestMessages,
        'unreadMessages' => $unreadMessages,
    ]);
});
    }
}
