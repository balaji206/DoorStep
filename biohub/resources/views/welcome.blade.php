<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'DoorStep') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .heading-font {
            font-family: 'Space Grotesk', sans-serif;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .glass {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(20px);
        }
    </style>
</head>

<body class="bg-[#f4f7ff] text-slate-900 overflow-x-hidden">

    <!-- Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">

        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-300/30 rounded-full blur-[120px]"></div>

        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-indigo-300/30 rounded-full blur-[120px]"></div>

        <div class="absolute inset-0 bg-[radial-gradient(#dbe4ff_1px,transparent_1px)] [background-size:32px_32px] opacity-40"></div>

    </div>

    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 border-b border-white/20 glass">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex items-center justify-between h-20">

                <!-- Logo -->
                <div class="flex items-center gap-3">

                    <div class="w-11 h-11 rounded-2xl bg-slate-900 flex items-center justify-center shadow-xl">
                        <span class="text-white font-black text-lg">D</span>
                    </div>

                    <h1 class="heading-font text-2xl font-black tracking-tight">
                        DoorStep
                    </h1>

                </div>

                <!-- Nav -->
                <nav class="hidden md:flex items-center gap-10">

                    <a href="#features"
                       class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                        Features
                    </a>

                    <a href="#services"
                       class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                        Services
                    </a>

                    <a href="#reviews"
                       class="text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
                        Reviews
                    </a>

                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">

                    @auth

                        <a href="{{ url('/dashboard') }}"
                           class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-bold shadow-xl hover:scale-105 transition">
                            Dashboard
                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="text-sm font-semibold text-slate-700 hover:text-black">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-bold shadow-xl hover:bg-blue-700 hover:scale-105 transition-all">
                            Get Started
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </header>

    <!-- Hero -->
    <section class="relative pt-44 pb-32">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-20 items-center">

                <!-- Left -->
                <div>

                    <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white shadow-md mb-8 border border-slate-100">

                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>

                        <span class="text-xs font-bold tracking-widest uppercase text-blue-600">
                            Trusted Service Platform
                        </span>

                    </div>

                    <h1 class="heading-font text-6xl lg:text-8xl font-black leading-[0.95] tracking-tight mb-8">

                        Book Trusted
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                            Services
                        </span>
                        At Your Doorstep

                    </h1>

                    <p class="text-lg text-slate-500 leading-relaxed max-w-xl mb-10">

                        Find verified professionals for home cleaning, plumbing,
                        electrical work, beauty services, repairs, and more —
                        all in one modern platform.

                    </p>

                    <div class="flex flex-col sm:flex-row gap-5">

                        <a href="{{ route('register') }}"
                           class="px-10 py-5 rounded-3xl bg-slate-900 text-white font-bold shadow-2xl hover:-translate-y-1 hover:scale-105 transition-all">

                            Book Service

                        </a>

                        <a href="#services"
                           class="px-10 py-5 rounded-3xl bg-white border border-slate-200 font-bold hover:bg-slate-50 transition-all">

                            Explore Services

                        </a>

                    </div>

                </div>

                <!-- Right -->
                <div class="relative animate-float">

                    <div class="rounded-[40px] p-5 bg-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] border border-slate-100">

                        <div class="rounded-[30px] overflow-hidden">

                            <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1400&auto=format&fit=crop"
                                 class="w-full h-[550px] object-cover">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Stats -->
    <section class="pb-28">

        <div class="max-w-6xl mx-auto px-6">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

                <div class="glass rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-5xl font-black text-blue-600">5K+</h2>
                    <p class="mt-3 text-slate-500 font-medium">Bookings</p>
                </div>

                <div class="glass rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-5xl font-black text-blue-600">1K+</h2>
                    <p class="mt-3 text-slate-500 font-medium">Providers</p>
                </div>

                <div class="glass rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-5xl font-black text-blue-600">98%</h2>
                    <p class="mt-3 text-slate-500 font-medium">Customer Satisfaction</p>
                </div>

                <div class="glass rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-5xl font-black text-blue-600">24/7</h2>
                    <p class="mt-3 text-slate-500 font-medium">Support</p>
                </div>

            </div>

        </div>

    </section>

    <!-- Services -->
    <section id="services" class="py-28 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-20">

                <h2 class="heading-font text-5xl font-black mb-6">
                    Popular Services
                </h2>

                <p class="text-slate-500 text-lg">
                    Everything you need for your home and lifestyle.
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Card -->
                <!-- Card -->
<div class="bg-white rounded-[32px] overflow-hidden shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">

    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=1200"
         class="w-full h-60 object-cover">

    <div class="p-8">

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-2xl font-black">
                Home Cleaning
            </h3>

            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-600 text-xs font-bold">
                Popular
            </span>

        </div>

        <p class="text-slate-500 leading-relaxed mb-6">
            Professional deep cleaning services for apartments,
            villas, and offices.
        </p>

        <a href="{{ route('customer.providers') }}"
           class="block text-center w-full py-4 rounded-2xl bg-slate-900 text-white font-bold hover:bg-black transition">
            Book Now
        </a>

    </div>

</div>

<!-- Card -->
<div class="bg-white rounded-[32px] overflow-hidden shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">

    <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?q=80&w=1200"
         class="w-full h-60 object-cover">

    <div class="p-8">

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-2xl font-black">
                Plumbing
            </h3>

            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-xs font-bold">
                Fast
            </span>

        </div>

        <p class="text-slate-500 leading-relaxed mb-6">
            Expert plumbers for repairs, fittings,
            leak fixing, and maintenance.
        </p>

        <a href="{{ route('customer.providers') }}"
           class="block text-center w-full py-4 rounded-2xl bg-slate-900 text-white font-bold hover:bg-black transition">
            Book Now
        </a>

    </div>

</div>

<!-- Card -->
<div class="bg-white rounded-[32px] overflow-hidden shadow-xl hover:-translate-y-2 transition-all duration-300 border border-slate-100">

    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1200"
         class="w-full h-60 object-cover">

    <div class="p-8">

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-2xl font-black">
                Beauty & Spa
            </h3>

            <span class="px-3 py-1 rounded-full bg-pink-100 text-pink-600 text-xs font-bold">
                Premium
            </span>

        </div>

        <p class="text-slate-500 leading-relaxed mb-6">
            Salon and beauty professionals available at your convenience.
        </p>

        <a href="{{ route('customer.providers') }}"
           class="block text-center w-full py-4 rounded-2xl bg-slate-900 text-white font-bold hover:bg-black transition">
            Book Now
        </a>

    </div>

</div>

            </div>

        </div>

    </section>

    <!-- Features -->
    <section id="features" class="py-32">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid md:grid-cols-3 gap-10">

                <div class="glass rounded-[32px] p-10 shadow-xl">

                    <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-2xl mb-8">
                        ⚡
                    </div>

                    <h3 class="text-3xl font-black mb-4">
                        Instant Booking
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Book trusted service providers instantly with
                        real-time availability.
                    </p>

                </div>

                <div class="glass rounded-[32px] p-10 shadow-xl">

                    <div class="w-16 h-16 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-2xl mb-8">
                        📅
                    </div>

                    <h3 class="text-3xl font-black mb-4">
                        Smart Scheduling
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Intelligent scheduling system with conflict prevention.
                    </p>

                </div>

                <div class="glass rounded-[32px] p-10 shadow-xl">

                    <div class="w-16 h-16 rounded-2xl bg-emerald-600 flex items-center justify-center text-white text-2xl mb-8">
                        🔒
                    </div>

                    <h3 class="text-3xl font-black mb-4">
                        Secure Platform
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Role-based authentication and protected booking system.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- Reviews -->
    <section id="reviews" class="py-32 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-20">

                <h2 class="heading-font text-5xl font-black mb-5">
                    Loved By Customers
                </h2>

                <p class="text-slate-500 text-lg">
                    Trusted by thousands of users.
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <div class="p-10 rounded-[32px] border border-slate-100 shadow-xl">

                    <div class="flex gap-1 text-yellow-400 text-xl mb-6">
                        ★★★★★
                    </div>

                    <p class="text-slate-500 leading-relaxed mb-8">
                        “Amazing platform. Booking a plumber took less than 2 minutes.”
                    </p>

                    <div>
                        <h4 class="font-black">Rahul Sharma</h4>
                        <p class="text-sm text-slate-400">Customer</p>
                    </div>

                </div>

                <div class="p-10 rounded-[32px] border border-slate-100 shadow-xl">

                    <div class="flex gap-1 text-yellow-400 text-xl mb-6">
                        ★★★★★
                    </div>

                    <p class="text-slate-500 leading-relaxed mb-8">
                        “Beautiful UI and smooth booking experience.”
                    </p>

                    <div>
                        <h4 class="font-black">Priya</h4>
                        <p class="text-sm text-slate-400">Customer</p>
                    </div>

                </div>

                <div class="p-10 rounded-[32px] border border-slate-100 shadow-xl">

                    <div class="flex gap-1 text-yellow-400 text-xl mb-6">
                        ★★★★★
                    </div>

                    <p class="text-slate-500 leading-relaxed mb-8">
                        “Very professional service providers and easy scheduling.”
                    </p>

                    <div>
                        <h4 class="font-black">Karthik</h4>
                        <p class="text-sm text-slate-400">Customer</p>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="py-32">

        <div class="max-w-5xl mx-auto px-6">

            <div class="rounded-[40px] bg-gradient-to-r from-slate-900 to-blue-900 p-16 text-center text-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.4)]">

                <h2 class="heading-font text-5xl font-black mb-6">
                    Ready To Get Started?
                </h2>

                <p class="text-slate-300 text-lg mb-10">
                    Join thousands of customers and providers using DoorStep.
                </p>

                <a href="{{ route('register') }}"
                   class="inline-flex px-10 py-5 rounded-3xl bg-white text-slate-900 font-black hover:scale-105 transition-all">
                    Create Account
                </a>

            </div>

        </div>

    </section>

    <!-- Footer -->
    <footer class="py-16 border-t border-slate-200 bg-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-8">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-2xl bg-slate-900 flex items-center justify-center">
                        <span class="text-white font-black">D</span>
                    </div>

                    <h2 class="heading-font text-2xl font-black">
                        DoorStep
                    </h2>

                </div>

                <p class="text-slate-400 text-sm text-center">
                    © 2026 DoorStep. All rights reserved.
                </p>

            </div>

        </div>

    </footer>

</body>
</html>