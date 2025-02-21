@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Full Page Background & Centering -->
    <div class="flex items-start justify-center h-screen">
        {{-- <div class="drawer lg:drawer-open">
            <input class="drawer-toggle" id="my-drawer-2" type="checkbox" />
            <div class="flex flex-col items-center justify-center drawer-content">
                <!-- Page content here -->
                <label class="btn btn-primary drawer-button lg:hidden" for="my-drawer-2">
                    Open drawer
                </label>
            </div>
            <div class="drawer-side">
                <label class="drawer-overlay" for="my-drawer-2" aria-label="close sidebar"></label>
                <ul class="min-h-full p-4 menu w-80 bg-base-200 text-base-content">
                    <!-- Sidebar content here -->
                    <li><a>Sidebar Item 1</a></li>
                    <li><a>Sidebar Item 2</a></li>
                </ul>
            </div>
        </div> --}}
        <div class="w-full max-w-3xl p-6 text-center rounded-lg">
            <h1 class="my-8 font-bold">Dashboard</h1>

            {{-- Show separate button for different user role --}}
            @if (Auth::user()->role == 'admin')
                {{-- Page if Admin has logged in --}}
                <livewire:dashboard.admin-dashboard>
            @endif

            @if (Auth::user()->role == 'user')
                {{-- Page if User has logged in --}}
                <livewire:dashboard.user-dashboard>
            @endif


            <div class="mb-4 profile">
                <img class="w-32 h-32 mx-auto mb-2 rounded-full" src="{{ asset('storage/' . Auth::user()->image) }}"
                    alt="{{ auth()->user()->name }}'s Avatar">
                <p>{{ auth()->user()->name }}</p>
                <p>{{ auth()->user()->role }}</p>
            </div>

            <!-- Button to navigate to profile settings -->
            <div class="mb-4">
                <a class="w-full btn btn-primary" href="{{ route('profile.settings') }}">Go to Profile Settings</a>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full btn btn-square btn-primary" type="submit">Logout</button>
            </form>
        </div>
    </div>
@endsection
