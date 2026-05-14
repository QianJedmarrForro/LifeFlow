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
    public function show($id)
    {
        $donation = Donation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('donations.show', compact('donation'));
    }

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
        $request->validate([
            'blood_type'  => 'required|string',
            'units'       => 'required|integer|min:200|max:500',
            'name'        => 'required|string|max:255',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:30',
            'address'     => 'required|string|max:255',
            'id_type'     => 'required|string|max:100',
            'eligible'    => 'required',
        ]);

        Donation::create([
            'user_id'      => Auth::id(),
            'name'         => $request->name,
            'email'        => Auth::user()->email,
            'dob'          => $request->dob,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'blood_type'   => $request->blood_type,
            'units'        => $request->units,
            'id_type'      => $request->id_type,
            'health_notes' => $request->health_notes,
            'eligible'     => true,
            'status'       => 'approved',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Thank you! Your donation has been recorded and added to the inventory.')
            ->with('reward', true);
    }
}