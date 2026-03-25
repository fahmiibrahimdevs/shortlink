<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Space Grotesk', sans-serif; }
            .sci-fi-bg {
                background-color: #050b14;
                background-image: 
                    linear-gradient(rgba(0, 255, 255, 0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(0, 255, 255, 0.03) 1px, transparent 1px);
                background-size: 30px 30px;
                background-position: center center;
            }
        </style>
    </head>
    <body class="font-sans antialiased sci-fi-bg text-gray-100">
        <div class="min-h-screen">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-gray-900/50 backdrop-blur-md border-b border-cyan-900/50 shadow-[0_4px_30px_rgba(0,255,255,0.05)] text-cyan-400">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 tracking-widest uppercase text-sm font-bold">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative z-10">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-900/10 via-transparent to-fuchsia-900/10 pointer-events-none"></div>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
