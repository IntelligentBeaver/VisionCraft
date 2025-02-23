<div class="px-8 mx-auto shadow-sm navbar bg-base-100">
    <div class="navbar-start">
        {{-- <div class="dropdown">
            <div class="btn btn-ghost lg:hidden" role="button" tabindex="0">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul class="menu dropdown-content menu-sm z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 shadow" tabindex="0">
                @if ($isAuthenticated)
                    <li><a href="/" wire:navigate>Home</a></li>
                    @if ($user->role === 'admin')
                        <li><a class="px-4" href="{{ route('admin.dashboard') }}" wire:navigate>Admin Dashboard</a>
                        </li>
                    @elseif($user->role === 'user')
                        <li><a class="px-4" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a></li>
                    @endif
                @else
                    <li><a href="/" wire:navigate>Home</a></li>
                    <li><a class="px-4" href="{{ route('login') }}" wire:navigate>Login</a></li>
                    <li><a class="px-4" href="{{ route('register') }}" wire:navigate>Register</a></li>
                @endif
            </ul>
        </div> --}}
        <a class="font-bold" href="/" wire:navigate>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="30">
        </a>
    </div>

    <div class="flex navbar-center">
        <ul class="px-1 menu menu-horizontal">
            @if ($isAuthenticated)
                <li><a href="/" wire:navigate>Home</a></li>
                @if (Auth::user()->role == 'admin')
                    <li><a class="px-4" href="{{ route('dashboard-stats') }}" wire:navigate>Dashboard</a></li>
                @endif
                @if (Auth::user()->role == 'user')
                    <li><a class="px-4" href="{{ route('user-dashboard') }}" wire:navigate>Dashboard</a></li>
                    <li>
                        <a class="px-4" href="{{ route('resume-upload') }}">
                            Optimize Resume
                        </a>
                    </li>
                @endif
            @else
                <li><a href="/" wire:navigate>Home</a></li>
                <li><a class="px-4" href="{{ route('login') }}" wire:navigate>Login</a></li>
                <li><a class="px-4" href="{{ route('register') }}" wire:navigate>Register</a></li>
            @endif
        </ul>
    </div>

    <div class="space-x-2 navbar-end">
        @if ($isAuthenticated)
            <div class="dropdown dropdown-end">
                <div class="avatar btn btn-circle btn-ghost" role="button" tabindex="0">
                    <div class="w-10 rounded-full">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture" />
                    </div>
                </div>
                <ul class="menu dropdown-content menu-md z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 shadow"
                    tabindex="0">
                    @if (Auth::user()->role == 'admin')
                        <li>
                            <a class="w-full" href="{{ route('dashboard.create') }}" wire:navigate>Create User</a>
                        </li>
                        <li>
                            <a class="w-full" href="{{ route('dashboard.manage') }}" wire:navigate>Manage
                                Users</a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'user')
                        <li>
                            <a class="px-4" href="{{ route('resume-upload') }}">
                                Optimize Resume
                            </a>
                        </li>
                        <li>
                            <a class="w-full" href="{{ route('user-survey-history') }}">
                                View Survey History
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="w-full" href="{{ route('profile.settings') }}" wire:navigate>Profile</a>
                    </li>

                    <li>
                        <a class="text-error" href="#" wire:click="logout">Logout</a>

                    </li>
                </ul>
            </div>
        @endif
    </div>
</div>
