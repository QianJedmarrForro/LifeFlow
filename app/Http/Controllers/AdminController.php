<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Donation;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Fetch Blood Inventory Data
        $types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $inventory = [];

        foreach ($types as $type) {
            $totalDonated = Donation::where('blood_type', trim($type))
                ->whereIn('status', ['approved', 'completed', 'Approved', 'Completed'])
                ->sum('units');

            $totalRequested = BloodRequest::where('blood_type', trim($type))
                ->whereIn('status', ['approved', 'Approved'])
                ->sum('units');

            $currentStock = max(0, $totalDonated - $totalRequested);
            $bags = floor($currentStock / 450);

            $inventory[] = (object)[
                'type'   => $type,
                'stock'  => $currentStock,
                'bags'   => $bags,
                'status' => $currentStock < 2000 ? 'Low' : 'Stable'
            ];
        }

        // 2. Fetch Incoming Blood REQUESTS (Pending Only)
        $requests = BloodRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get();

        // 3. Fetch Processed Blood REQUESTS (History)
        $processedRequests = BloodRequest::with('user')
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->take(10)
            ->get();

        // 4. UPDATED: Fetch ALL DONATIONS (ordered latest first, take 20)
        $recentDonations = Donation::with('user')
            ->whereIn('status', ['approved', 'completed', 'Approved', 'Completed'])
            ->latest()
            ->take(20)
            ->get();

        // 5. Fetch Registered Users
        $donors = User::where('role', 'user')
            ->latest()
            ->take(8) 
            ->get();

        return view('admin.dashboard', compact(
            'inventory', 
            'requests', 
            'processedRequests', 
            'recentDonations', 
            'donors'
        ));
    }

    public function approveRequest($id)
    {
        $request = BloodRequest::findOrFail($id);
        $request->update(['status' => 'approved']);
        return back()->with('success', 'Blood request approved successfully!');
    }

    public function rejectRequest($id)
    {
        $request = BloodRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);
        return back()->with('error', 'Blood request has been rejected.');
    }

    public function donationDetail($id)
    {
        $donation = Donation::with('user')->findOrFail($id);
        return view('admin.donation-detail', compact('donation'));
    }

    public function donations()
    {
        $donations = Donation::with('user')->latest()->get();
        return view('admin.donations', compact('donations'));
    }

    public function donors()
    {
        $donors = User::where('role', 'user')->latest()->get();
        return view('donor-records', compact('donors'));
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function reports()
    {
        $donations = Donation::with('user')->latest()->get();
        $requests = BloodRequest::with('user')->latest()->get();
        return view('admin.reports', compact('donations', 'requests'));
    }
}