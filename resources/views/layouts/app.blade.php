<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Vision Craft')</title>

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
        <script>
            function applySystemTheme() {
                let systemPrefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
                let savedTheme = localStorage.getItem("theme");

                // Use saved theme if available; otherwise, use system preference
                let theme = savedTheme ? savedTheme : (systemPrefersDark ? "dark" : "light");

                document.documentElement.setAttribute("data-theme", theme);
            }

            applySystemTheme();

            // Listen for system theme changes and update in real-time
            window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", applySystemTheme);
        </script>

    </head>

    <body class="font-sans antialiased">
        @livewire('navigation-bar')
        @livewire('flash-message')
        <main class="mx-auto">
            @yield('content')
        </main>
        <main class="flex-1 mx-auto">
            @yield('dashboard_section')
        </main>
        <!-- Footer -->
        @livewire('footer')
        @livewireScripts


    </body>

</html>
