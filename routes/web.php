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
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    route::resource('project', ProjectController::class)->parameters(['project' => 'project',]);
    route::resource('company', CompanyController::class);
    Route::resource('client', ClientController::class);
    Route::resource('developer', DeveloperController::class);
    Route::resource('laporan', LaporanController::class);
});

Route::prefix('client')->name('client.')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('laporan', ClientLaporanController::class);
    Route::get('/project', [ClientProjectController::class, 'index'])->name('project.index');

});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('dev')->name('dev.')->middleware(['auth', 'role:developer'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan/selesai', [DeveloperLaporanController::class, 'selesai'])->name('laporan.selesai');
    Route::resource('laporan', DeveloperLaporanController::class);
});
