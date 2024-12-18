<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="container mx-auto">
            <div class="relative px-6">
                <header class="">
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
                </header>
                <div class="flex flex-col items-center justify-center h-screen gap-4">
                    <x-application-logo class="w-24 h-24 fill-current" />
                    <h1 class='text-2xl font-bold'>My Reminders</h1>
                    <x-button primary xl href="{{ route('register') }}">Get Started</x-button>
                </div>
                <main class="mt-6">
                </main>
            </div>
        </div>
    </body>
</html>
