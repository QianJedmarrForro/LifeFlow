<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;

Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('aboutus'); })->name('about');
Route::get('/contact', function () { return view('contactus'); })->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Gidugangan nako og 'prevent-back' diri para dili na mabalikan inig logout
Route::middleware(['auth', 'prevent-back'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware('can:user-only')->group(function () {
        Route::get('/donate/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');
        Route::get('/information', function () {
            return view('information');
        })->name('information');

        Route::get('/blood-requests/create', [BloodRequestController::class, 'create'])->name('blood-requests.create');
        Route::post('/blood-requests', [BloodRequestController::class, 'store'])->name('blood-requests.store');
    });

    Route::middleware('can:admin-only')->group(function () {
        
        Route::get('/admin', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.home');

        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        Route::get('/admin/blood-requests', [BloodRequestController::class, 'index'])->name('blood-requests.index');
        Route::post('/blood-requests/{id}/approve', [BloodRequestController::class, 'approve'])->name('blood-requests.approve');
        Route::post('/blood-requests/{id}/reject', [BloodRequestController::class, 'reject'])->name('blood-requests.reject');

        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        
        Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports');
        Route::get('/admin/reports/print/{id}', [ReportController::class, 'print'])->name('reports.print');
        
        Route::get('/admin/donors', [AdminController::class, 'donors'])->name('admin.donors');
        Route::get('/donors-records', [DonationController::class, 'showRecords'])->name('donors.records');
    });
}); 