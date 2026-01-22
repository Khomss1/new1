<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\BadanPublikController;

// --- RUTE LOGIN (Tanpa Login) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE UTAMA (Butuh Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Redirect Halaman Utama ke Dashboard
    Route::redirect('/', '/admin/dashboard');
    
    // Route Dashboard Global (agar route('dashboard') tersedia)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---------------------------------------------------------
    // 1. GRUP ADMIN (Prefix /admin, Name admin.)
    // ---------------------------------------------------------
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // --- SUB-GRUP EVALUASI (admin/evaluasi/*) ---
        // Route ini menghasilkan nama: admin.evaluasi.index, admin.evaluasi.show, dll
        Route::prefix('evaluasi')->name('evaluasi.')->group(function () {
            Route::get('/', [EvaluationController::class, 'index'])->name('index');
            Route::get('/{id}', [EvaluationController::class, 'show'])->name('show');
            Route::post('/{id}', [EvaluationController::class, 'update'])->name('update');
            Route::post('/{id}/finalize', [EvaluationController::class, 'finalizeScore'])->name('finalize');
            Route::post('/{id}/reject', [EvaluationController::class, 'reject'])->name('reject');
        });

        // --- SUB-GRUP DATA BADAN PUBLIK (admin/bp/*) ---
        // Route ini menghasilkan nama: admin.bp.index
        Route::prefix('bp')->name('bp.')->group(function () {
            // Pastikan ini memanggil view 'admin.bp_list' di Controller
            Route::get('/', [BadanPublikController::class, 'index'])->name('index');
        });

    }); // Penutup Grup Admin

    // ---------------------------------------------------------
    // 2. GRUP BADAN PUBLIK / RESPONDEN (Prefix /bp)
    // ---------------------------------------------------------
    // Group ini untuk User BP (Bukan Admin)
    Route::prefix('bp')->name('bp.')->group(function () {
        Route::get('/dashboard', [BadanPublikController::class, 'dashboard'])->name('dashboard');
        Route::get('/kuesioner', [BadanPublikController::class, 'kuesioner'])->name('kuesioner');
        Route::post('/submit', [BadanPublikController::class, 'submit'])->name('submit');
    });

}); // Penutup Grup Auth Middleware