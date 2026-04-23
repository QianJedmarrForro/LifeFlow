<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodRequestController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Register
Route::get('/register', function () {
    return view('register');
})->name('register');

// Process Login
Route::post('/login', function () {
    return redirect('/home');
});

// Process Registration
Route::post('/register', function () {
    return redirect('/login');
});

// Home
Route::get('/home', function () {
    return view('home');
});

// Donate Blood Page
Route::get('/donate', function () {
    return view('donate');
});

// Process Donation Form
Route::post('/donate', function () {
    return redirect('/donate')->with('success', 'Your donation request has been submitted!');
})->name('donate.submit');

// Blood Request Page
Route::get('/request', [BloodRequestController::class, 'index'])->name('request.index');

// Process Blood Request Form
Route::post('/request', [BloodRequestController::class, 'store'])->name('request.store');

// Donor Records
Route::get('/donor-records', function () {
    return view('donor-records');
})->name('donor.records');

// About Us
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Us
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Logout
Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');