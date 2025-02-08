<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AlurPelaporanController;


Route::get('/', function () {
    return view('home');
});
// Route untuk Alur Pelaporan (akses publik tanpa middleware)
Route::get('/alur-pelaporan', [AlurPelaporanController::class, 'showAlurPelaporan'])->name('alur_pelaporan.index');

// Group routes that require authentication
Route::middleware(['auth'])->group(function () {
    // User routes
    Route::post('/admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/dashboard/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/dashboard/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/dashboard/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/dashboard/laporan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/dashboard/laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/dashboard/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/dashboard/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::put('/dashboard/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
    
    Route::get('/form-pelaporan', function () {
        return view('form_pelaporan.form_pelaporan');
    })->name('laporan.view');
    Route::post('/form-pelaporan', [LaporanController::class, 'inputLaporan'])->name('halaman.form-pelaporan');

    // Dashboard route
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
});


Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'showAdminLogin'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');
    

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/user/login', [AuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/user/login', [AuthController::class, 'login']);
    Route::get('/user/register', [AuthController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/user/register', [AuthController::class, 'register']);

});


Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');


