<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Donation;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function inventory()
    {
        $types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $inventory = [];

        foreach ($types as $type) {
            $totalDonated = Donation::where('blood_type', $type)->sum('units');
            $totalRequested = BloodRequest::where('blood_type', $type)
                ->where('status', 'approved')
                ->sum('units');

            $inventory[] = (object)[
                'type' => $type,
                'stock' => $totalDonated - $totalRequested,
                'status' => ($totalDonated - $totalRequested) < 2000 ? 'Low' : 'Stable'
            ];
        }

        return view('admin.inventory', compact('inventory'));
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