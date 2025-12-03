<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\LaporanController as ClientLaporanController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Developer\LaporanController as DeveloperLaporanController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\NotificationController;
use App\Models\Laporan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    route::resource('project', ProjectController::class)->parameters(['project' => 'project',]);
    Route::put('/admin/project/status/{project}', [ProjectController::class, 'updateStatus'])->name('project.updateStatus');
    Route::get('/laporan/activity', [LaporanController::class, 'activity'])->name('laporan.activity');
    route::resource('company', CompanyController::class);
    Route::resource('client', ClientController::class);
    Route::resource('developer', DeveloperController::class);
    Route::resource('laporan', LaporanController::class);
    Route::put('/admin/laporan/prioritas/{laporan}', [LaporanController::class, 'updatePrioritas'])->name('laporan.updatePrioritas');
    Route::put('/admin/laporan/developer/{laporan}', [LaporanController::class, 'updateDeveloper'])->name('laporan.updateDeveloper');
});

Route::prefix('client')->name('client.')->middleware(['auth', 'role:client'])->group(function () {
    Route::post('/laporan/{id}/send-message', [ClientLaporanController::class, 'sendMessage'])->name('laporan.sendMessage');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('laporan', ClientLaporanController::class);
    Route::get('/project', [ClientProjectController::class, 'index'])->name('project.index');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/update', function () {
        return redirect()->back();
    });
    Route::put('/profile/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/messages/unread-count', [MessageController::class, 'unreadCount']);
    Route::get('/messages/unread-list', [MessageController::class, 'unreadList']);
});

Route::prefix('dev')->name('dev.')->middleware(['auth', 'role:developer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dev/laporan/{id}/send-message', [DeveloperLaporanController::class, 'sendMessage'])->name('laporan.sendMessage');
    Route::put('/dev/laporan/status/{laporan}', [DeveloperLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    Route::put('/dev/laporan/lampiran/{laporan}', [DeveloperLaporanController::class, 'uploadLampiran'])->name('laporan.uploadLampiran');
    Route::get('/laporan/selesai', [DeveloperLaporanController::class, 'selesai'])->name('laporan.selesai');
    Route::get('/laporan/ditolak', [DeveloperLaporanController::class, 'ditolak'])->name('laporan.ditolak');
    Route::resource('laporan', DeveloperLaporanController::class);
});

Route::post('/notif/messages/mark-read', function () {
    $user = Auth::user();

    \App\Models\Message::where('receiver_id', $user->id)
        ->where('is_read', false)
        ->update(['is_read' => true]);

    return response()->json(['status' => 'ok']);
    
});

// web.php
Route::post('/messages/mark-read', [App\Http\Controllers\MessageController::class, 'markAllRead'])
    ->name('messages.markRead');



Route::post('/notif/mark-done-read', function () {
    $user = Auth::user();
    Laporan::where('status', 'Done')->where('client_id', $user->id)->update(['is_read' => true]);
    return response()->json(['status' => 'ok']);
});
