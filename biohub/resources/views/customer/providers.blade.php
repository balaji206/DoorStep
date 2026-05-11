<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar: Customer Navigation --}}
        <aside class="hidden lg:flex flex-col w-72 bg-brand-500 text-white rounded-r-[3rem] my-4 ml-4 shadow-2xl relative overflow-hidden">
            <div class="p-8 relative z-10 flex flex-col h-full">
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-brand-600 font-black text-xl italic">D</span>
                    </div>
                    <span class="font-black text-2xl tracking-tighter italic uppercase">DoorStep</span>
                </div>

                <nav class="space-y-3 flex-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Browse Services
                    </a>
                    <a href="{{ route('customer.bookings') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        My Bookings
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            {{-- Header --}}
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Browse Services</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1">Discover elite providers</p>
                </div>

                {{-- Search/Filter Mockup --}}
                <div class="relative group hidden md:block">
                    <input type="text" placeholder="Search by category or location..." 
                        class="pl-12 pr-6 py-3 bg-white border-none rounded-2xl shadow-soft w-96 focus:ring-2 focus:ring-brand-500 transition-all">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </header>

            {{-- Providers Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($providers as $provider)
                <div class="group bg-white rounded-[2.5rem] p-8 shadow-soft border border-slate-100 hover:border-brand-500/30 transition-all duration-500 flex flex-col">
                    
                    {{-- Provider Branding --}}
                    <div class="flex items-center gap-5 mb-8">
                        <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-2xl font-black shadow-sm group-hover:scale-110 transition-transform">
                            {{ substr($provider->business_name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-slate-800 tracking-tight leading-tight">{{ $provider->business_name }}</h3>
                            <span class="px-3 py-1 rounded-full bg-brand-50 text-brand-500 text-[10px] font-black uppercase tracking-widest mt-2 inline-block">
                                {{ $provider->category }}
                            </span>
                        </div>
                    </div>

                    {{-- Contact Info --}}
                    <div class="space-y-3 mb-8 flex-1">
                        <div class="flex items-center gap-3 text-slate-400">
                            <span class="text-brand-500 text-sm">📍</span>
                            <p class="text-xs font-bold uppercase tracking-tight">{{ $provider->location }}</p>
                        </div>
                        <div class="flex items-center gap-3 text-slate-400">
                            <span class="text-brand-500 text-sm">📞</span>
                            <p class="text-xs font-bold tracking-tight">{{ $provider->phone }}</p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="h-px bg-slate-50 w-full mb-6"></div>

                    {{-- Footer Action --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Availability</p>
                            <p class="text-sm font-black text-emerald-500">{{ $provider->services->count() }} Services</p>
                        </div>
                        <a href="{{ route('customer.providers.show', $provider->id) }}"
                            class="px-6 py-3 bg-slate-900 text-white font-black rounded-xl text-xs uppercase tracking-widest hover:bg-black transition-all hover:scale-105 active:scale-95 shadow-lg shadow-slate-200">
                            View & Book
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] mx-auto mb-6 flex items-center justify-center text-slate-200 text-3xl">
                        🏪
                    </div>
                    <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">No elite providers found in your area</p>
                </div>
                @endforelse
            </div>

        </main>
    </div>
</x-app-layout> 