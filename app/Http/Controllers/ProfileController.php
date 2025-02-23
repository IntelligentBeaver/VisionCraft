<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Show profile settings page
    public function show()
    {
        return view('profile-settings');
    }

    // Update user profile (name and image)
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure it's an image
            'age' => 'nullable|integer|min:18|max:100',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female,other',
            'interest' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->location = $request->location;
        $user->skills = $request->skills;
        $user->education = $request->education;
        $user->experience = $request->experience;
        $user->gender = $request->gender;
        $user->interest = $request->interest;

        // Process image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('profile.settings')->with('success', 'Profile updated successfully.');
    }

    // Delete user account
    public function delete()
    {
        $user = Auth::user();

        // Delete the user's profile image if exists
        if ($user->image && Storage::exists('public/' . $user->image)) {
            Storage::delete('public/' . $user->image);
        }

        // Delete the user from the database
        $user->delete();  // This should work if $user is an Eloquent model

        // Log the user out after deletion
        Auth::logout();

        // Redirect to the login page
        return redirect('/login')->with('success', 'Your account has been deleted.');
    }
}