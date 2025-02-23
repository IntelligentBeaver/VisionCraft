{{-- @extends('layouts.app')
@section('title', 'Dashboard')

@section('dashboard_section')
    <div class="flex items-start justify-center">
        <div class="p-6 text-center rounded-lg">
            <h1 class="my-8 font-bold">Dashboard</h1>


            @if (Auth::user()->role == 'admin')
                <div class="w-full max-w-6xl mb-4">
                    @livewire('dashboard.user-stats')
                    <div class="flex items-stretch justify-between gap-4 my-4">
                        <a class="flex-1 btn btn-primary" href="{{ route('dashboard.create') }}" wire:navigate>Create User</a>
                        <a class="flex-1 btn btn-secondary" href="{{ route('dashboard.manage') }}" wire:navigate>Manage
                            Users</a>
                    </div>
                </div>
            @endif

            @if (Auth::user()->role == 'user')
                <div class="w-full max-w-6xl mb-4">
                    <div class="flex items-stretch justify-between gap-4 my-4">
                        <a class="flex-1 btn btn-primary" href="{{ route('user-survey-history') }}">
                            Your Survey History
                        </a>
                        <a class="flex-1 btn btn-secondary" href="{{ route('dashboard.manage') }}"
                            wire:navigate>Placeholder</a>
                    </div>
                    {{-- @livewire('user-recommendations')
        </div>
        @livewire('dashboard.user-dashboard')
    @endif

        <div class="mt-6">
            @yield('dashboard-content')
        </div>
        </div>
        </div>
    @endsection --}}
