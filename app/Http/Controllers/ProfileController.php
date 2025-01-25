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
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024', // max size 1MB
            'age' => 'nullable|integer|min:18|max:100',
            'location' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'gender' => 'nullable|string|in:male,female,other',
            'interest' => 'nullable|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the name
        $user->name = $request->name;

        // Update additional fields
        $user->age = $request->age;
        $user->location = $request->location;
        $user->skills = $request->skills;
        $user->education = $request->education;
        $user->experience = $request->experience;
        $user->gender = $request->gender;
        $user->interest = $request->interest;

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Validate the uploaded file
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow only valid image files
            ]);

            // Delete the old image if it exists
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Store the new image
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Store in "storage/app/public/images"
            $user->image = $imagePath; // Save the relative path (e.g., "images/example.jpg")
        }

        // Save the updated user
        $user->save(); // This should work if $user is an Eloquent model

        // Redirect back to the profile settings page with a success message
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