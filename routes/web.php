<?php

use Illuminate\Support\Facades\Route;

// 1. The Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. The Login Page
Route::get('/login', function () {
    return view('login');
});

// 3. The Sign Up Page
Route::get('/register', function () {
    return view('register');
});