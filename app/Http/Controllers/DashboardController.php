<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the main user dashboard with live stats and history.
     */
    public function index()
    {
        $user = Auth::user();

        // Security check
        if (!$user) {
            return redirect()->route('login');
        }

        // Redirect Admin to the Management Console
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 1. STATS CALCULATION (Top Cards)
        // These feed the 'totalDonations', 'totalUnits', and 'totalRequests' summary cards
        $totalDonationsCount = Donation::where('user_id', $user->id)->count();
        $totalUnitsDonated   = Donation::where('user_id', $user->id)->sum('units');
        $totalRequestsCount  = BloodRequest::where('user_id', $user->id)->count();

        // 2. ACTIVITY HISTORY (Tables)
        // Fetches the most recent 5 entries for a clean dashboard look
        $donationHistory = Donation::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $requestHistory = BloodRequest::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // 3. SYSTEM ANNOUNCEMENTS
        // These are hardcoded for now, but dynamic in structure for future expansion
        $announcements = collect([
            (object)[
                'title' => 'Community Blood Drive', 
                'body' => 'Join us this Friday at the main medical hall.', 
                'tag' => 'event', 
                'date' => now()->addDays(2)->format('M d, Y')
            ],
            (object)[
                'title' => 'Critical: O− Supply Low', 
                'body' => 'Universal donors (O−) are urgently needed this week.', 
                'tag' => 'urgent', 
                'date' => now()->format('M d, Y')
            ],
            (object)[
                'title' => 'System Update', 
                'body' => 'Compatibility matching logic is now live.', 
                'tag' => 'info', 
                'date' => now()->subDay()->format('M d, Y')
            ],
        ]);

        $donationProgress = min(100, round(($totalDonationsCount / 10) * 100));

        // 4. VIEW DATA MAPPING
        return view('dashboard', [
            'totalDonations'   => $totalDonationsCount,
            'totalUnits'       => $totalUnitsDonated,
            'totalRequests'    => $totalRequestsCount,
            'donationHistory'  => $donationHistory,
            'requestHistory'   => $requestHistory,
            'announcements'    => $announcements,
            'donationPoints'   => $totalDonationsCount,
            'donationProgress' => $donationProgress,
            'donationMilestone'=> 10,
        ]);
    }
}