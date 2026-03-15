<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Faso Travel') }} | @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-surface-50 dark:bg-surface-900 text-surface-800 dark:text-surface-200">
        @include('shared._navbar')

        <div class="dark:bg-surface-900">
            <main class="pt-20 pb-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto animate-fade-in">
                <!-- Flash Messages -->
                @if (session('success'))
                    <x-alert type="success"> {{ session('success') }}</x-alert>
                @elseif (session('error'))
                    <x-alert type="error"> {{ session('error') }}</x-alert>
                @endif

                @yield('content')
            </main>
        </div>

        @include('shared._footer')

        @livewireScripts
        @yield('script','')
    </body>
</html>
