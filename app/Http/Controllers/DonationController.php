<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// --- IMPORTANT: THESE TWO ARE REQUIRED FOR LARAVEL 11 ---
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DonationController extends Controller implements HasMiddleware
{
    /**
     * Define middleware for the controller.
     */
    public static function middleware(): array
    {
        return [
            // This ensures only logged-in users can access any method here
            new Middleware('auth'),
            
            // Optional: Only allow regular users to access the 'create' and 'store' methods
            // new Middleware('can:user-only', only: ['create', 'store']),
        ];
    }

    /**
     * Display a listing of donations (for Admins).
     */
    public function showRecords()
    {
        $donations = Donation::with('user')->latest()->get();
        return view('donor-records', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'blood_type' => 'required',
            'units' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        Donation::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'blood_type' => $request->blood_type,
            'units' => $request->units,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Donation recorded successfully!');
    }
}