<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar: Consistent Navigation --}}
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
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('customer.providers') }}" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Browse Services
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            {{-- Breadcrumb/Header --}}
            <header class="mb-12 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <a href="{{ route('customer.providers') }}" class="text-[10px] font-black text-brand-500 uppercase tracking-[0.2em] hover:underline">Providers</a>
                        <span class="text-slate-300 text-xs">/</span>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Profile</span>
                    </div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">{{ $provider->business_name }}</h1>
                </div>
                <a href="{{ route('customer.book', $provider->id) }}" class="px-8 py-4 bg-slate-900 text-white font-black rounded-2xl shadow-xl hover:bg-black transition-all hover:scale-105 active:scale-95 text-sm uppercase tracking-widest">
                    Book Now
                </a>
            </header>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
                
                {{-- Left: Brand & Availability --}}
                <div class="xl:col-span-1 space-y-8">
                    {{-- Identity Card --}}
                    <div class="bg-white rounded-[3rem] p-10 shadow-soft border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-50 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                        
                        <div class="relative z-10 text-center">
                            <div class="w-24 h-24 rounded-[2rem] bg-brand-500 flex items-center justify-center text-4xl shadow-xl mx-auto mb-6 transform rotate-3">
                                🏪
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">{{ $provider->business_name }}</h2>
                            <span class="px-4 py-1.5 rounded-full bg-brand-50 text-brand-600 text-[10px] font-black uppercase tracking-widest mt-3 inline-block">
                                {{ $provider->category }}
                            </span>
                            
                            <div class="mt-8 space-y-4 text-left border-t border-slate-50 pt-8">
                                <div class="flex items-start gap-4">
                                    <span class="text-lg">📍</span>
                                    <p class="text-sm font-bold text-slate-600 leading-relaxed">{{ $provider->location }}</p>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-lg">📞</span>
                                    <p class="text-sm font-bold text-slate-600">{{ $provider->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Availability Bento --}}
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-soft border border-slate-100">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Operational Hours
                        </h3>
                        <div class="space-y-3">
                            @forelse($provider->availabilities as $availability)
                                <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-50 border border-slate-100/50">
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tighter">{{ $availability->day_of_week }}</span>
                                    <span class="text-[10px] font-bold text-slate-400">
                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-xs font-bold text-slate-400 text-center py-4">No hours listed</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right: Description & Services --}}
                <div class="xl:col-span-2 space-y-8">
                    {{-- About Section --}}
                    @if($provider->description)
                    <div class="bg-white rounded-[3rem] p-10 shadow-soft border border-slate-100">
                        <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 text-center md:text-left">The Mission</h3>
                        <p class="text-lg font-medium text-slate-600 leading-relaxed italic">"{{ $provider->description }}"</p>
                    </div>
                    @endif

                    {{-- Service Menu --}}
                    <div class="bg-white rounded-[3rem] shadow-soft border border-slate-100 overflow-hidden">
                        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h3 class="font-black text-slate-800 tracking-tight text-xl">Service Menu</h3>
                            <span class="px-4 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-400 text-[10px] font-black uppercase tracking-widest">{{ count($provider->services) }} Options</span>
                        </div>

                        <div class="divide-y divide-slate-50">
                            @forelse($provider->services as $service)
                            <div class="group flex items-center justify-between px-10 py-8 hover:bg-slate-50/80 transition-all">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-black transition-transform group-hover:scale-110">
                                        {{ substr($service->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-black text-slate-800 leading-tight mb-1 group-hover:text-brand-500 transition-colors">{{ $service->name }}</h4>
                                        <div class="flex items-center gap-3">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $service->duration_minutes }} Min
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-2xl font-black text-slate-900 tracking-tighter">₹{{ number_format($service->price, 0) }}</p>
                                    <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest mt-1">Available Now</p>
                                </div>
                            </div>
                            @empty
                            <div class="py-24 text-center">
                                <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">No services currently listed</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>