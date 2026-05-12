<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\BloodRequest;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('query');

        $donations = Donation::with('user')
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })->orWhere('blood_type', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->get();

        $requests = BloodRequest::with('user')
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })->orWhere('blood_type', 'LIKE', "%{$search}%")
                  ->orWhere('status', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->get();

        if ($request->ajax()) {
            return response()->json([
                'donations' => view('admin.reports.partials.donations_table', compact('donations'))->render(),
                'requests' => view('admin.reports.partials.requests_table', compact('requests'))->render(),
            ]);
        }

        return view('admin.reports.index', compact('donations', 'requests'));
    }
}