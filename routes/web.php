<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Models\BloodRequest;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
=======
// Register
Route::get('/register', function () {
    return view('register');
})->name('register');
>>>>>>> 58c3432d420dc84ee163b92c146a70f92eb3db40

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', fn () => view('profile'))->name('profile');

    Route::get('/profile/edit', fn () => view('profile-edit'))->name('profile.edit');

    Route::post('/profile/update', function (Request $request) {

        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');

    })->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Donations
    |--------------------------------------------------------------------------
    */
    Route::get('/donate', [DonationController::class, 'index'])->name('donations.index');
    Route::post('/donate', [DonationController::class, 'store'])->name('donations.store');

    /*
    |--------------------------------------------------------------------------
    | Blood Requests
    |--------------------------------------------------------------------------
    */
    Route::get('/blood-requests', [BloodRequestController::class, 'index'])->name('blood-requests.index');
    Route::post('/blood-requests', [BloodRequestController::class, 'store'])->name('blood-requests.store');

    /*
    |--------------------------------------------------------------------------
    | Donors
    |--------------------------------------------------------------------------
    */
    Route::get('/donors', [DonationController::class, 'showRecords'])->name('donors.records');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', function () {
        abort_if(auth()->user()->role !== 'admin', 403);
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::post('/admin/request/{id}/approve', function ($id) {

        abort_if(auth()->user()->role !== 'admin', 403);

        BloodRequest::where('id', $id)->update([
            'status' => 'approved'
        ]);

        return back();

    })->name('admin.request.approve');

    Route::post('/admin/request/{id}/reject', function ($id) {

        abort_if(auth()->user()->role !== 'admin', 403);

        BloodRequest::where('id', $id)->update([
            'status' => 'rejected'
        ]);

        return back();

    })->name('admin.request.reject');

});