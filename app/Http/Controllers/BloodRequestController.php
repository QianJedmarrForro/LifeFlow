<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BloodRequestController extends Controller
{
    /**
     * Compatibility Map: Defines which blood types a recipient can receive.
     */
    protected $compatibilityMap = [
        'A+'  => ['A+', 'A-', 'O+', 'O-'],
        'A-'  => ['A-', 'O-'],
        'B+'  => ['B+', 'B-', 'O+', 'O-'],
        'B-'  => ['B-', 'O-'],
        'AB+' => ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
        'AB-' => ['A-', 'B-', 'AB-', 'O-'],
        'O+'  => ['O+', 'O-'],
        'O-'  => ['O-'],
    ];

    /**
     * Admin/Management View
     */
    public function index()
    {
        $donors = User::where('role', 'user')->get();
        $requests = BloodRequest::latest()->get();

        // Optimized Inventory Calculation
        $bloodTypes = array_keys($this->compatibilityMap);
        $inventory = [];

        foreach ($bloodTypes as $type) {
            $in = Donation::where('blood_type', $type)->sum('units');
            $out = BloodRequest::where('blood_type', $type)
                               ->where('status', 'approved')
                               ->sum('units');
            
            $inventory[$type] = max(0, $in - $out);
        }

        return view('blood-requests.index', compact('donors', 'requests', 'inventory'));
    }

    /**
     * Show the Request Form for Regular Users
     */
    public function create()
    {
        return view('blood-requests.create');
    }

    /**
     * Handle the form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hospital'     => 'required|string|max:255',
            'blood_type'   => 'required|string',
            'units'        => 'required|integer|min:1',
            'priority'     => 'required|string',
            'needed_by'    => 'required|date',
            'patient_name' => 'required|string|max:255',
            'reason'       => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        BloodRequest::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Blood request submitted successfully!');
    }

    /**
     * Admin: Approve a request using Blood Compatibility Logic
     */
    public function approve($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $recipientType = $bloodRequest->blood_type;

        // Get list of blood types this patient can safely receive
        $compatibleTypes = $this->compatibilityMap[$recipientType] ?? [$recipientType];

        // Calculate total available volume across all compatible types
        $totalIn = Donation::whereIn('blood_type', $compatibleTypes)->sum('units');
        $totalOut = BloodRequest::whereIn('blood_type', $compatibleTypes)
                                ->where('status', 'approved')
                                ->sum('units');
                                     
        $availableCompatibleUnits = $totalIn - $totalOut;

        if ($availableCompatibleUnits < $bloodRequest->units) {
            return back()->with('error', "Insufficient stock! Total compatible volume for {$recipientType} is only {$availableCompatibleUnits}ml.");
        }

        $bloodRequest->update(['status' => 'approved']);

        return back()->with('success', "Request approved using compatible stock logic.");
    }

    /**
     * Admin: Reject a request
     */
    public function reject($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $bloodRequest->update(['status' => 'rejected']);
        
        return back()->with('success', 'Request has been rejected.');
    }
}