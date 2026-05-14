<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DoorStep') }}</title>

        <!-- Scripts & Styles -->
        <link rel="stylesheet" href="{{ asset('build/assets/app-BG1KdCN_.css') }}">
<script type="module" src="{{ asset('build/assets/app-DsIK1Lmc.js') }}"></script>
    </head>
    <body class="font-sans antialiased text-text bg-background overflow-x-hidden">
        <div class="min-h-screen bg-background relative flex flex-col">
            
            <!-- Animated Background -->
            <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
                <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:40px_40px] opacity-20"></div>
                <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] rounded-full bg-primary/10 blur-[120px] animate-pulse"></div>
            </div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-surface/50 border-b border-border backdrop-blur-md sticky top-16 z-40">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 w-full relative z-10 animate-fade-in">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
