@extends('layouts.app')

@section('dashboard_section')
    <div class="flex items-start justify-center">
        <div class="rounded-lg p-6 text-center">
            <h1 class="mb-6 mt-4 font-extrabold">Dashboard</h1>

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

            @if (Auth::user()->role == 'user')
                {{-- User-specific Content --}}
                <div class="mb-4 w-full max-w-6xl">

                    {{-- Dynamically Load Livewire Component Based on Route --}}
                    @if (request()->routeIs('user-survey-history'))
                        <div class="my-4 flex items-stretch justify-between gap-4 px-4">
                            <a class="btn btn-primary flex-1" href="{{ route('user-dashboard') }}">
                                Go back to Dashboard
                            </a>
                        </div>
                        @livewire('user-survey-history')
                    @elseif (request()->routeIs('user-dashboard'))
                        @livewire('user-recommendations')
                        <div class="my-4 flex items-stretch justify-between gap-4 px-4">
                            <a class="btn btn-primary flex-1" href="{{ route('user-survey-history') }}">
                                View Survey History
                            </a>
                            <a class="btn btn-primary flex-1" href="{{ route('resume-upload') }}">
                                Upload Resume
                            </a>
                        </div>
                    @elseif (request()->routeIs('resume-upload'))
                        <div class="my-4 flex items-stretch justify-between gap-4 px-4">
                            <a class="btn btn-primary flex-1" href="{{ route('user-dashboard') }}">
                                Go back to Dashboard
                            </a>
                            <a class="btn btn-primary flex-1" href="{{ route('user-survey-history') }}">
                                View Survey History
                            </a>
                        </div>
                        @livewire('resume-optimizer')
                    @endif
                </div>
            @endif

            {{-- Dynamic Content (For navigation) --}}
            <div class="mt-6">
                @yield('dashboard-content')
            </div>
        </div>
    </div>
@endsection
