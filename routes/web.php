<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReportController;

// ============================================
// AUTHENTICATION ROUTES
// ============================================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register (hanya admin)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ============================================
// PROTECTED ROUTES (Harus login)
// ============================================

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    // User Management (Admin only)
    Route::resource('users', UserController::class);

    // Room Management
    Route::resource('rooms', RoomController::class);

    // Borrower Management
    Route::resource('borrowers', BorrowerController::class);
    Route::post('/borrowers/{borrower}/approve', [BorrowerController::class, 'approve'])->name('borrowers.approve');
    Route::post('/borrowers/{borrower}/reject', [BorrowerController::class, 'reject'])->name('borrowers.reject');

    // Schedule Management (Admin & Toolman only)
    Route::resource('schedules', ScheduleController::class);

    // Reports
    Route::get('/reports/borrowers-pdf', [ReportController::class, 'borrowersPdf'])->name('reports.borrowers-pdf');
    Route::get('/reports/borrowers-excel', [ReportController::class, 'borrowersExcel'])->name('reports.borrowers-excel');
    Route::get('/reports/schedules-pdf', [ReportController::class, 'schedulesPdf'])->name('reports.schedules-pdf');
    Route::get('/reports/schedules-excel', [ReportController::class, 'schedulesExcel'])->name('reports.schedules-excel');
});