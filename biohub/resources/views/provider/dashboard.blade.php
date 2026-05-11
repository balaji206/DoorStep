<x-app-layout>
    {{-- Flex container ensures both columns can share height logic --}}
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900 overflow-hidden">
        
        {{-- 1. Sidebar Navigation - Now stretches to match content height --}}
        <aside class="hidden lg:flex flex-col w-72 bg-brand-500 text-white rounded-r-[3rem] ml-4 my-4 shadow-2xl relative overflow-hidden self-stretch">
            {{-- Aesthetic Background Decor --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
            
            <div class="p-8 relative z-10 flex flex-col h-full">
                {{-- Logo --}}
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center shadow-lg transform rotate-3">
                        <span class="text-brand-600 font-black text-xl">D</span>
                    </div>
                    <span class="font-black text-2xl tracking-tighter italic">DoorStep</span>
                </div>

                {{-- Nav Links --}}
                <nav class="space-y-3 flex-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner transition-all border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/></svg>
                        Dashboard
                    </a>
                    
                    @php
                        $navItems = [
                            ['route' => 'provider.services.index', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'label' => 'Services'],
                            ['route' => 'provider.bookings', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Bookings'],
                            ['route' => 'provider.availability', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'label' => 'Availability'],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                        {{ $item['label'] }}
                    </a>
                    @endforeach
                </nav>

                {{-- Settings at bottom --}}
                <div class="mt-auto pt-6 border-t border-white/10">
                    <a href="{{ route('provider.profile.edit') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </a>
                </div>
            </div>
        </aside>

        {{-- 2. Main Content Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            {{-- Toolbar --}}
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dashboard</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter">System Operational</p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <div class="relative group hidden md:block">
                        <input type="text" placeholder="Search analytics..." class="pl-12 pr-6 py-3 bg-white border-none rounded-2xl shadow-soft w-80 focus:ring-2 focus:ring-brand-500 transition-all">
                        <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5 group-focus-within:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    
                    <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-black text-slate-800 leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mt-1">Service Provider</p>
                        </div>
                        <div class="relative">
                            <img src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" class="w-12 h-12 rounded-2xl shadow-soft object-cover border-2 border-white">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-50 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- 3. Stats Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                {{-- ADD THIS PHP BLOCK BELOW --}}
    @php
        $stats = [
            [
                'label' => 'Active Services', 
                'value' => $services->count() ?? 0, 
                'trend' => '+Active', 
                'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16v1m-3-9h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 
                'color' => 'emerald'
            ],
            [
                'label' => 'Total Bookings', 
                'value' => $bookings->count() ?? 0, 
                'trend' => '+Total', 
                'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 
                'color' => 'brand'
            ],
            [
                'label' => 'Pending Queue', 
                'value' => $bookings->where('status', 'pending')->count() ?? 0, 
                'trend' => '-Wait', 
                'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 
                'color' => 'violet'
            ],
            [
                'label' => 'Confirmed Bookings', 
                'value' => $bookings->where('status', 'confirmed')->count() ?? 0, 
                'trend' => '+Done', 
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 
                'color' => 'amber'
            ],
        ];
    @endphp
                @foreach($stats as $stat)
                <div class="bg-white p-8 rounded-[2.5rem] shadow-soft relative overflow-hidden group hover:scale-[1.02] transition-all">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-{{ $stat['color'] }}-50 flex items-center justify-center text-{{ $stat['color'] }}-500 transition-colors group-hover:bg-{{ $stat['color'] }}-500 group-hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
                            </div>
                            <span class="text-xs font-black {{ str_contains($stat['trend'], '+') ? 'text-emerald-500' : 'text-rose-500' }} bg-{{ str_contains($stat['trend'], '+') ? 'emerald' : 'rose' }}-50 px-3 py-1 rounded-full">
                                {{ $stat['trend'] }}
                            </span>
                        </div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $stat['label'] }}</p>
                        <h3 class="text-3xl font-black text-slate-800 tracking-tight">{{ $stat['value'] }}</h3>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- 4. Main Cards --}}
            <div class="space-y-8">
                {{-- Business Info --}}
                @if($provider)
                <div class="bg-white rounded-[3rem] p-10 shadow-soft relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-brand-500 flex items-center justify-center text-5xl shadow-2xl transform rotate-3">🏪</div>
                            <div class="absolute -bottom-2 -right-2 bg-white p-2 rounded-xl shadow-lg text-emerald-500">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h2 class="text-4xl font-black text-slate-800 tracking-tighter mb-4">{{ $provider->business_name }}</h2>
                            <div class="flex flex-wrap justify-center md:justify-start gap-3">
                                <span class="px-5 py-2 rounded-full bg-brand-50 text-brand-600 text-xs font-black uppercase tracking-widest">{{ $provider->category }}</span>
                                <span class="px-5 py-2 rounded-full bg-slate-50 text-slate-500 text-xs font-black uppercase border border-slate-100">📍 {{ $provider->location }}</span>
                            </div>
                        </div>
                        <a href="{{ route('provider.profile.edit') }}" class="px-8 py-4 bg-slate-900 text-white font-black rounded-2xl shadow-xl hover:bg-black transition-all hover:scale-105 active:scale-95">Edit Settings</a>
                    </div>
                </div>
                @endif

                {{-- Revenue Insight Card (Sidebar will end here visually) --}}
                <div class="bg-white rounded-[3rem] p-10 shadow-soft h-[400px] flex items-center justify-center border border-slate-100">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-3xl mx-auto mb-6 flex items-center justify-center text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <p class="font-black text-slate-400 uppercase tracking-widest text-sm">Revenue Insights (V2 coming soon)</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>