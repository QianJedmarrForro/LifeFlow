<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// --- PUBLIC ROUTES (No authentication required) ---
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('aboutus'); })->name('about');
Route::get('/contact', function () { return view('contactus'); })->name('contact');

// --- AUTHENTICATION ROUTES (Guest access only) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- PROTECTED ROUTES (Requires login) ---
Route::middleware('auth')->group(function () {

    // General Dashboard (Main redirect destination after login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // --- REGULAR USER ONLY (Donors & Requestors) ---
    Route::middleware('can:user-only')->group(function () {
        // Blood Donation Process
        Route::get('/donate/create', [DonationController::class, 'create'])->name('donations.create');
        Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');
        Route::get('/information', function () {
            return view('information');
        })->name('information');

        // Blood Request Process
        Route::get('/blood-requests/create', [BloodRequestController::class, 'create'])->name('blood-requests.create');
        Route::post('/blood-requests', [BloodRequestController::class, 'store'])->name('blood-requests.store');
    });

    // --- ADMIN ONLY ROUTES ---
    Route::middleware('can:admin-only')->group(function () {
        
        // Admin home route defaults to dashboard
        Route::get('/admin', function () {
            return redirect()->route('admin.dashboard');
        })->name('admin.home');

        // Admin Dashboard: Overview of Blood Inventory and Active Requests
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Blood Requests Management (List, Approve, Reject)
        // Fixed: Added blood-requests.index to resolve DashboardController redirect error
        Route::get('/admin/blood-requests', [BloodRequestController::class, 'index'])->name('blood-requests.index');
        Route::post('/blood-requests/{id}/approve', [BloodRequestController::class, 'approve'])->name('blood-requests.approve');
        Route::post('/blood-requests/{id}/reject', [BloodRequestController::class, 'reject'])->name('blood-requests.reject');

        // Administrative Management Tools
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
        
        // Donor Directory and Donation History Records
        Route::get('/admin/donors', [AdminController::class, 'donors'])->name('admin.donors');
        Route::get('/donors-records', [DonationController::class, 'showRecords'])->name('donors.records');
    });
});