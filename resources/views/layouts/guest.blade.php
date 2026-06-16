<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Bilsport') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

        <style>
            :root {
                --maroon: #800000;
                --butter: #FDF5E6;
            }
            .bg-bilsport { background-color: var(--butter); }
            .text-bilsport { color: var(--maroon); }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-bilsport">
            <div>
                <a href="/" class="flex flex-col items-center">
                    <x-application-logo class="w-20 h-20 fill-current text-bilsport" />
                    <h1 class="mt-2 text-2xl font-bold text-bilsport"></h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-xl border-t-4 border-red-800">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>