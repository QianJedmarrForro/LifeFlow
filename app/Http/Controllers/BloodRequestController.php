<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $requests = BloodRequest::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('blood-request', compact('requests'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'hospital'     => 'required|string|max:255',
            'blood_type'   => 'required|string',
            'units'        => 'required|integer|min:1',
            'priority'     => 'required|string',
            'needed_by'    => 'required|date',
            'patient_name' => 'required|string|max:255',
            'reason'       => 'nullable|string',
        ]);

        // IMPORTANT: attach logged-in user
        $validated['user_id'] = $user->id;

        // Save to database
        BloodRequest::create($validated);

        return redirect()
            ->route('blood-requests.index')
            ->with('success', 'Blood request submitted successfully!');
    }
}