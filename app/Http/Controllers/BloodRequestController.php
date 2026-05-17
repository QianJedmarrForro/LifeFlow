<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RequestStatusNotification;

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
        $statusFilter = request('status');
        $bloodTypeFilter = request('blood_type');
        $requestsQuery = BloodRequest::latest();
        $bloodTypes = array_keys($this->compatibilityMap);
        $statusOptions = ['pending', 'approved', 'rejected'];

        if ($statusFilter && in_array($statusFilter, $statusOptions)) {
            $requestsQuery->where('status', $statusFilter);
        }

        if ($bloodTypeFilter && in_array($bloodTypeFilter, $bloodTypes)) {
            $requestsQuery->where('blood_type', $bloodTypeFilter);
        }

        $requests = $requestsQuery->get();

        // Optimized Inventory Calculation
        $inventory = [];

        foreach ($bloodTypes as $type) {
            $in = Donation::where('blood_type', $type)->sum('units');
            $out = BloodRequest::where('blood_type', $type)
                               ->where('status', 'approved')
                               ->sum('units');
            
            $inventory[$type] = max(0, $in - $out);
        }

        return view('admin.BloodRequest', compact('donors', 'requests', 'inventory', 'bloodTypes'));
    }

    /**
     * Show the Request Form for Regular Users
     */
    public function create()
    {
        return view('blood-requests.create');
    }

    /**
     * Handle the form submission (User Action)
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

        $bloodRequest = BloodRequest::create($validated);

        // Notify all admins about the incoming request
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new RequestStatusNotification($bloodRequest, 'new'));
        }

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
            return back()->with('error', "Insufficient stock! Total compatible volume for {$recipientType} is only {$availableCompatibleUnits} units.");
        }

        $bloodRequest->update(['status' => 'approved']);

        // Notify the requester user of approval
        $user = $bloodRequest->user;
        if ($user) {
            $user->notify(new RequestStatusNotification($bloodRequest, 'approved'));
        }

        return back()->with('success', "Request approved using compatible stock logic.");
    }

    /**
     * Admin: Reject a request
     */
    public function reject($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $bloodRequest->update(['status' => 'rejected']);

        // Notify the requester user of rejection
        $user = $bloodRequest->user;
        if ($user) {
            $user->notify(new RequestStatusNotification($bloodRequest, 'rejected'));
        }

        return back()->with('success', 'Request has been rejected.');
    }

    /**
     * Mark unread blood requests updates as read for the authenticated user
     */
    public function markNotificationsAsRead()
    {
        auth()->user()->bloodRequests()
            ->whereIn('status', ['approved', 'rejected'])
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}