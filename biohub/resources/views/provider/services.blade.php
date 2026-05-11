<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar --}}
        <aside class="hidden lg:flex flex-col w-72 bg-brand-500 text-white rounded-r-[3rem] my-4 ml-4 shadow-2xl relative overflow-hidden">
            <div class="p-8 relative z-10 flex flex-col h-full">
                <div class="flex items-center gap-3 mb-12">
                    <div class="w-10 h-10 bg-white rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-brand-600 font-black text-xl italic">B</span>
                    </div>
                    <span class="font-black text-2xl tracking-tighter italic uppercase">BIOHUB</span>
                </div>

                <nav class="space-y-3 flex-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        My Services
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Service Suite</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1">Deploy and manage offerings</p>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-8 flex items-center gap-4 p-5 bg-emerald-50 border border-emerald-100 rounded-2xl animate-fade-in">
                    <span class="text-emerald-500">✨</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-5 gap-10">
                
                {{-- Form Section --}}
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-soft p-10 border border-slate-100 sticky top-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl">⚡</div>
                            <h3 class="font-black text-xl text-slate-800 tracking-tight">New Service</h3>
                        </div>

                        <form method="POST" action="{{ route('provider.services.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Service Identity</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                                    placeholder="e.g. Executive Haircut" required />
                                @error('name') <p class="text-rose-500 text-[10px] font-bold mt-2 uppercase">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Duration (Min)</label>
                                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700"
                                        placeholder="30" min="1" required />
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Price (₹)</label>
                                    <input type="number" name="price" value="{{ old('price') }}"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700"
                                        placeholder="500" min="0" step="0.01" required />
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-slate-200">
                                Deploy Service
                            </button>
                        </form>
                    </div>
                </div>

                {{-- List Section --}}
                <div class="xl:col-span-3">
                    <div class="bg-white rounded-[2.5rem] shadow-soft border border-slate-100 overflow-hidden">
                        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h3 class="font-black text-slate-800 tracking-tight">Active Inventory</h3>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ count($services) }} Units</span>
                        </div>

                        <div class="divide-y divide-slate-50">
                            @forelse($services as $service)
                            <div class="group flex justify-between items-center px-10 py-8 hover:bg-slate-50 transition-all">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-black shadow-sm group-hover:scale-110 transition-transform">
                                        {{ substr($service->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-800 leading-tight mb-1">{{ $service->name }}</p>
                                        <div class="flex items-center gap-4 text-slate-400">
                                            <span class="text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $service->duration_minutes }} Min
                                            </span>
                                            <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                            <span class="text-[10px] font-black uppercase tracking-widest text-emerald-500">
                                                ₹{{ number_format($service->price, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <form method="POST" action="{{ route('provider.services.destroy', $service->id) }}" onsubmit="return confirm('Archive this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-4 rounded-xl hover:bg-rose-50 text-slate-300 hover:text-rose-500 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="py-24 text-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-[2rem] mx-auto mb-6 flex items-center justify-center text-slate-200">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                                <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">Inventory Empty</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>