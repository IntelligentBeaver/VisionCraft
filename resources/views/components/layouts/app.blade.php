@extends('layouts.app')

@section('title', 'Dashboard')

@section('dashboard_section')
    <div class="flex items-start justify-center">
        <div class="p-6 text-center rounded-lg">
            <h1 class="mt-4 mb-6 font-extrabold">Dashboard</h1>

            {{-- Show separate content for different user roles --}}
            @if (Auth::user()->role == 'admin')
                {{-- Admin-specific Navigation Links --}}
                <div class="w-screen max-w-5xl mb-4">
                    @if (request()->routeIs('dashboard-stats'))
                        @livewire('dashboard.user-stats')
                        <div class="flex items-stretch justify-between gap-4 my-4">
                            <a class="flex-1 btn btn-primary" href="{{ route('dashboard-create') }}" wire:navigate>Create
                                User</a>
                            <a class="flex-1 btn btn-secondary" href="{{ route('dashboard-manage') }}" wire:navigate>Manage
                                Users</a>
                        </div>
                    @endif

                    @if (request()->routeIs('dashboard-manage'))
                        <div class="flex items-stretch justify-between">
                            <a class="flex-1 btn btn-info" href="{{ route('dashboard-stats') }}" wire:navigate>Back to
                                Dashboard</a>
                        </div>
                        @livewire('dashboard.manage-users')
                    @endif
                    @if (request()->routeIs('dashboard-create'))
                        <div class="flex items-stretch justify-between">
                            <a class="flex-1 btn btn-info" href="{{ route('dashboard-stats') }}" wire:navigate>Back to
                                Dashboard</a>
                        </div>
                        @livewire('dashboard.create-user')
                    @endif
                </div>
            @endif

            @if (Auth::user()->role == 'user')
                {{-- User-specific Content --}}
                <div class="w-full mb-4 max-w-7xl">

                    {{-- Dynamically Load Livewire Component Based on Route --}}
                    @if (request()->routeIs('user-survey-history'))
                        <div class="flex items-stretch justify-between gap-4 px-4 my-4">
                            <a class="flex-1 btn btn-info" href="{{ route('user-dashboard') }}">
                                Go back to Dashboard
                            </a>
                        </div>
                        @livewire('user-survey-history')
                    @elseif (request()->routeIs('user-dashboard'))
                        @livewire('user-recommendations')
                        <div class="flex items-stretch justify-between gap-4 px-4 my-4">
                            <a class="flex-1 btn btn-primary" href="{{ route('user-survey-history') }}">
                                View Survey History
                            </a>
                            <a class="flex-1 btn btn-primary" href="{{ route('resume-upload') }}">
                                Optimize Resume
                            </a>
                        </div>
                    @elseif (request()->routeIs('resume-upload'))
                        <div class="flex items-stretch justify-between gap-4 px-4 my-4">
                            <a class="flex-1 btn btn-info" href="{{ route('user-dashboard') }}">
                                Go back to Dashboard
                            </a>
                            {{-- <a class="flex-1 btn btn-primary" href="{{ route('user-survey-history') }}">
                                View Survey History
                            </a> --}}
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
