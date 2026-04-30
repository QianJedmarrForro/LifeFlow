<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// --- PUBLIC ROUTES ---
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('aboutus'); })->name('about');
Route::get('/contact', function () { return view('contactus'); })->name('contact');

// --- AUTHENTICATION (GUESTS) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- SHARED AUTH ROUTES ---
Route::middleware('auth')->group(function () {

    // General Dashboard (This is where most redirects go)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // --- REGULAR USER ONLY ---
    Route::middleware('can:user-only')->group(function () {
        // Donations
        Route::get('/donate/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');

        // Requesting Blood
        Route::get('/blood-requests/create', [BloodRequestController::class, 'create'])->name('blood-requests.create');
        Route::post('/blood-requests', [BloodRequestController::class, 'store'])->name('blood-requests.store');
    });

    // --- ADMIN ONLY ---
    Route::middleware('can:admin-only')->group(function () {
        // --- FIX: Define the missing admin.dashboard name ---
        // We point this to the same DashboardController which should handle admin views
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Admin Management
        Route::get('/admin/manage', [BloodRequestController::class, 'index'])->name('blood-requests.index');
        
        // Managing Incoming Requests
        Route::post('/blood-requests/{id}/approve', [BloodRequestController::class, 'approve'])->name('blood-requests.approve');
        Route::post('/blood-requests/{id}/reject', [BloodRequestController::class, 'reject'])->name('blood-requests.reject');

        // Extra Admin Tools
        Route::get('/admin/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
        
        // Donation Records Directory
        Route::get('/donors-records', [DonationController::class, 'showRecords'])->name('donors.records');
    });
});