<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuratLamaranController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('surats.index') : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/surat', [SuratLamaranController::class, 'index'])->name('surats.index');
    Route::get('/surat/buat', [SuratLamaranController::class, 'create'])->name('surats.create');
    Route::post('/surat', [SuratLamaranController::class, 'store'])->name('surats.store');
    Route::get('/surat/{surat}/lampiran/{type}', [SuratLamaranController::class, 'attachment'])->name('surats.attachment');
    Route::get('/surat/{surat}', [SuratLamaranController::class, 'show'])->name('surats.show');
    Route::delete('/surat/{surat}', [SuratLamaranController::class, 'destroy'])->name('surats.destroy');
});
