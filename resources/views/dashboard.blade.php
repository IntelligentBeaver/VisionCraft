@extends('layouts.app')
@section('title', 'Dashboard')

@section('dashboard_section')
    <div class="flex items-start justify-center">
        <div class="rounded-lg p-6 text-center">
            <h1 class="my-8 font-bold">Dashboard</h1>

            {{-- Show separate content for different user roles --}}
            @if (Auth::user()->role == 'admin')
                {{-- Admin-specific Navigation Links --}}
                <div class="mb-4 w-full max-w-6xl">
                    @livewire('dashboard.user-stats')
                    <div class="my-4 flex items-stretch justify-between gap-4">
                        <a class="btn btn-primary flex-1" href="{{ route('dashboard.create') }}" wire:navigate>Create User</a>
                        <a class="btn btn-secondary flex-1" href="{{ route('dashboard.manage') }}" wire:navigate>Manage
                            Users</a>
                    </div>
                </div>
            @endif

            {{-- @if (Auth::user()->role == 'user')
            
                <div class="w-full max-w-6xl mb-4">
                    <div class="flex items-stretch justify-between gap-4 my-4">
                        <a class="flex-1 btn btn-primary" href="{{ route('user-survey-history') }}">
                            Your Survey History
                        </a>
                        {{-- <a class="flex-1 btn btn-secondary" href="{{ route('dashboard.manage') }}"
                            wire:navigate>Placeholder</a> --}}
        </div>
        {{-- @livewire('user-recommendations') --}}
    </div>
    {{-- @livewire('dashboard.user-dashboard') --}}
    @endif --}}

    {{-- Dynamic Content (For navigation) --}}
    <div class="mt-6">
        @yield('dashboard-content')
    </div>
    </div>
    </div>
@endsection
