<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Faso Travel') }} | @yield('title')</title>

    <!-- Fonts
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
-->


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased bg-gray-100"  >

<div class=" container px-6">
    <!-- Page Content -->


    <main class="mt-24" >
        <!-- flash info -->
        @if (session('success'))
            <x-alert type="success"> {{ session('success') }}</x-alert>
        @else
            @if (session('error'))
                <x-alert type="error"> {{ session('error') }}</x-alert>
            @endif
        @endif
        <!-- fin flash info -->
        {{-- <x-shared.chat-bulle/> --}}
        @yield('content')
    </main>

    {{-- <x-shared.chat-support/> --}}
</div>

</body>
</html>
