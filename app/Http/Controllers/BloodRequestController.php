<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\User; // Gidugang para sa Donors list
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    /**
     * Display the records page with donors and requests.
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Kuhaon ang mga Donors (mga users nga naay role nga 'user')
        $donors = User::where('role', 'user')->get();

        // 2. Kuhaon ang tanang Blood Requests para sa Management Records
        $requests = BloodRequest::latest()->get();

        // 3. I-return ang 'records' view (siguroha nga records.blade.php ang filename)
        return view('records', compact('donors', 'requests'));
    }

    /**
     * Handle the submission of a new blood request.
     */
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

        // I-attach ang ID sa nag-login nga user
        $validated['user_id'] = $user->id;

        // Save sa database
        BloodRequest::create($validated);

        return redirect()
            ->route('records.index') // Gi-update gikan sa blood-requests.index
            ->with('success', 'Blood request submitted successfully!');
    }
}