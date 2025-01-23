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
        <nav class="bg-base-100 px-4 py-6">
            <div class="container mx-auto flex items-center justify-between">
                <a class="font-bold" href="/" wire:navigate>
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" height="30">
                </a>
                <div>
                    @auth
                        <a class="px-4" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                        <form style="display:inline;" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="" type="submit">Logout</button>
                        </form>
                    @else
                        <a class="px-4" href="{{ route('login') }}" wire:navigate>Login</a>
                        <a class="px-4" href="{{ route('register') }}" wire:navigate>Register</a>
                    @endauth
                </div>
            </div>
        </nav>
        <main class="mx-auto">
            @yield('content')
        </main>
        <!-- Footer -->
        <footer class="bg-gray-900 px-8 py-6 text-white">
            <div class="text-center">
                <p class="text-sm">© BrandName. All rights reserved.</p>
            </div>
        </footer>
        @livewireScripts


    </body>

</html>
