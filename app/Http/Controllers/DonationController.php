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
            new Middleware('auth'),
        ];
    }

    /**
     * Display a listing of all donation records.
     */
    public function showRecords()
    {
        $donations = Donation::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('donor-records', [
            'donors' => $donations,
            'heading' => 'Donation Records',
            'description' => 'Review the blood donation records linked to your account.',
        ]);
    }

    /**
     * Show the form for creating a new donation record.
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created donation in the database.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming form data
        $request->validate([
            'blood_type' => 'required',
            'units' => 'required|integer|min:1',
            // Note: If your form uses 'date', make sure it's in the request
        ]);

        // 2. Create the record using the authenticated user's details
       Donation::create([
    'user_id'    => Auth::id(),
    'name'       => Auth::user()->name,
    'email'      => Auth::user()->email,
    'dob'        => Auth::user()->dob ?? now()->format('Y-m-d'), 
    'blood_type' => $request->blood_type,
    'units'      => $request->units,
    'status'     => 'approved', 
]);

        // 3. Redirect back with success message and reward animation trigger
        return redirect()->route('dashboard')
            ->with('success', 'Thank you! Your donation has been recorded and added to the inventory.')
            ->with('reward', true);
    }
}