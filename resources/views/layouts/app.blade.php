<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net" rel="preconnect">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
            </style>
        @endif
    </head>

    <body class="font-sans antialiased">
        <div class="mx-auto shadow-sm navbar bg-base-100">
            <div class="navbar-start">
                <div class="dropdown">
                    <div class="btn btn-ghost lg:hidden" role="button" tabindex="0">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul class="menu dropdown-content menu-sm z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 shadow"
                        tabindex="0">
                        @auth
                            <li>
                                <a href="/" wire:navigate>Home</a>
                            </li>
                            <li><a class="px-4" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>

                            </li>
                            <li>
                                <form style="display:inline;" method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="" type="submit">Logout</button>
                                </form>
                            </li>
                        @else
                            <li>
                                <a href="/" wire:navigate>Home</a>
                            </li>
                            <li><a class="px-4" href="{{ route('login') }}" wire:navigate>Login</a></li>
                            <li><a class="px-4" href="{{ route('register') }}" wire:navigate>Register</a></li>
                        @endauth
                    </ul>
                </div>
                <a class="font-bold" href="/" wire:navigate>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="30">
                </a>
            </div>
            <div class="hidden navbar-center lg:flex">
                <ul class="px-1 menu menu-horizontal">
                    @auth
                        <li>
                            <a class="px-4" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                        </li>
                        <li>
                            <a href="/" wire:navigate>Home</a>
                        </li>
                    @else
                        <li>
                            <a href="/" wire:navigate>Home</a>
                        </li>
                        <li><a class="px-4" href="{{ route('login') }}" wire:navigate>Login</a></li>
                        <li><a class="px-4" href="{{ route('register') }}" wire:navigate>Register</a></li>
                    @endauth
                </ul>
            </div>
            <div class="navbar-end">
                @auth
                    <div class="dropdown dropdown-end">
                        <div class="avatar btn btn-circle btn-ghost" role="button" tabindex="0">
                            <div class="w-10 rounded-full">
                                <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                    alt="Tailwind CSS Navbar component" />
                            </div>
                        </div>
                        <ul class="menu dropdown-content menu-md z-[1] mt-3 w-52 rounded-box bg-base-100 p-2 shadow"
                            tabindex="0">
                            <li>
                                <a class="justify-between">
                                    Profile
                                </a>
                            </li>
                            <li><a>Settings</a></li>
                            <li><a>Logout</a></li>
                        </ul>
                    </div>
                    <form style="display:inline;" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-error text-error-content" type="submit">Logout</button>
                    </form>
                @else
                @endauth
            </div>
        </div>
        <main class="mx-auto">
            @yield('content')
        </main>
        <!-- Footer -->
        <footer class="px-8 py-6 text-white bg-gray-900">
            <div class="text-center">
                <p class="text-sm">©VisionCraft. All rights reserved.</p>
            </div>
        </footer>
        @livewireScripts


    </body>

</html>
