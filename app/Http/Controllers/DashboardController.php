<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $donations = Donation::where('user_id', $user->id);

        $bloodTypes = (clone $donations)
            ->select('blood_type')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('blood_type')
            ->get();

        $requests = BloodRequest::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('dashboard', [
            'totalDonors' => $donations->count(),
            'totalUnits' => $donations->sum('units'),
            'pendingRequests' => BloodRequest::where('user_id', $user->id)->count(),
            'bloodTypes' => $bloodTypes,
            'requests' => $requests,
        ]);
    }
}