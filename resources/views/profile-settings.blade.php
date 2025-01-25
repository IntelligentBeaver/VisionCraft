@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')

    <!-- Full Page Background & Centering -->
    <div class="flex justify-center">
        <div class="w-full max-w-3xl p-6 rounded-lg">
            <h1 class="my-8 font-bold text-center">Profile Settings</h1>

            <!-- Profile Image Display -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Profile Image</label>
                <div class="flex flex-col items-center">
                    <img class="w-32 h-32 mb-2 rounded-full"
                        src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}"
                        alt="Profile Image">
                    <!-- Default image if no profile image is set -->
                    <input class="w-full mt-1 file-input file-input-bordered" name="image" type="file" accept="image/*">
                </div>
            </div>

            <!-- Update Profile Form -->
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="name">Name</label>
                    <input class="w-full mt-1 input input-bordered" id="name" name="name" type="text"
                        value="{{ Auth::user()->name }}" required>
                </div>

                <!-- New Fields -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="age">Age</label>
                    <input class="w-full mt-1 input input-bordered" id="age" name="age" type="number"
                        value="{{ Auth::user()->age }}" min="18" max="100">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="location">Location</label>
                    <input class="w-full mt-1 input input-bordered" id="location" name="location" type="text"
                        value="{{ Auth::user()->location }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="skills">Skills</label>
                    <input class="w-full mt-1 input input-bordered" id="skills" name="skills" type="text"
                        value="{{ Auth::user()->skills }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="education">Education</label>
                    <input class="w-full mt-1 input input-bordered" id="education" name="education" type="text"
                        value="{{ Auth::user()->education }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="experience">Experience</label>
                    <input class="w-full mt-1 input input-bordered" id="experience" name="experience" type="text"
                        value="{{ Auth::user()->experience }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="gender">Gender</label>
                    <select class="w-full mt-1 input input-bordered" id="gender" name="gender">
                        <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ Auth::user()->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="interest">Interest</label>
                    <input class="w-full mt-1 input input-bordered" id="interest" name="interest" type="text"
                        value="{{ Auth::user()->interest }}">
                </div>

                <!-- Update Button -->
                <div class="mb-4">
                    <button class="w-full btn btn-primary" type="submit">Update Profile</button>
                </div>
            </form>

            <!-- Delete Account Form -->
            <form action="{{ route('profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="mb-4">
                    <button class="w-full btn btn-error" type="submit">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

@endsection
