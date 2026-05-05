<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function edit()
    {
        return view('profile-edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validate the incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'blood_type' => ['nullable', 'string', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'], // Added blood type validation
            'password' => ['nullable', 'min:6'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], 
        ]);

        // 2. Handle the Image Upload
        if ($request->hasFile('profile_photo')) {
            // Delete the old photo from storage if it exists to keep it clean
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store the new photo in 'storage/app/public/profile_photos'
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        // 3. Update User Information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->blood_type = $request->blood_type; // Added this to save the blood type

        // 4. Update Password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}