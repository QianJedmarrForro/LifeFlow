<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    // Kini ang mo-display sa imong Request Blood nga page
    public function index()
    {
        return view('request'); // Siguraduha nga ang imong blade file kay resources/views/request.blade.php
    }

    // Kini ang mo-handle kung i-click ang Submit button
    public function store(Request $request)
    {
        // Puhon, diri nimo ibutang ang pag-save sa database. 
        // Sa pagkakaron, i-redirect lang sa nato.
        return redirect()->route('request.index')->with('success', 'Blood request submitted successfully!');
    }
}