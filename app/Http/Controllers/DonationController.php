<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index()
    {
        return view('donate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'dob'        => 'required|date',
            'address'    => 'nullable|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'blood_type' => 'required|string',
            'units'      => 'nullable|integer|min:1',
            'eligible'   => 'required|accepted',
        ]);

        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login');
        }

        $validated['user_id'] = $userId;
        $validated['eligible'] = true;
        $validated['units'] = $request->filled('units') ? $request->units : 450;

        Donation::create($validated);

        return redirect()
            ->route('donations.index')
            ->with('success', 'Thank you! Your donation request has been submitted.');
    }

    public function showRecords()
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login');
        }

        $donors = Donation::where('user_id', $userId)
            ->latest()
            ->get();

        $requests = BloodRequest::where('user_id', $userId)
            ->latest()
            ->get();

        return view('donor-records', compact('donors', 'requests'));
    }
}