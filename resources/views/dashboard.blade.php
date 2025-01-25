@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Full Page Background & Centering -->
    <div class="flex items-start justify-center h-screen">
        <div class="w-full max-w-3xl p-6 text-center rounded-lg">
            <h1 class="my-8 font-bold">Dashboard</h1>


            <div class="mb-4 profile">
                <img class="w-32 h-32 mx-auto mb-2 rounded-full" src="{{ asset('storage/' . auth()->user()->image) }}"
                    alt="{{ auth()->user()->name }}'s Avatar">
                <p>{{ auth()->user()->name }}</p>
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
