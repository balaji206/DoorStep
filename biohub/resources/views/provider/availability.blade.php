<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar (Same as Dashboard for consistency) --}}
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
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Availability
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Time Engine</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1">Manage operational hours</p>
                </div>
            </header>

            <div class="grid grid-cols-1 xl:grid-cols-5 gap-10">
                
                {{-- Form Section --}}
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-soft p-10 border border-slate-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-2xl">📅</div>
                            <h3 class="font-black text-xl text-slate-800 tracking-tight">Add Shift</h3>
                        </div>

                        <form method="POST" action="{{ route('provider.availability.store') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Select Day</label>
                                <select name="day_of_week"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 transition-all cursor-pointer"
                                    required>
                                    <option value="" disabled selected>Choose a day...</option>
                                    @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                        <option value="{{ $day }}">{{ ucfirst($day) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Starts At</label>
                                    <input type="time" name="start_time"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Ends At</label>
                                    <input type="time" name="end_time"
                                        class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700"
                                        required />
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-slate-200">
                                Deploy Shift
                            </button>
                        </form>
                    </div>
                </div>

                {{-- List Section --}}
                <div class="xl:col-span-3">
                    <div class="bg-white rounded-[2.5rem] shadow-soft border border-slate-100 overflow-hidden">
                        <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h3 class="font-black text-slate-800 tracking-tight">Active Schedule</h3>
                            <span class="px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100">Live Sync</span>
                        </div>

                        <div class="divide-y divide-slate-50">
                            @forelse($availabilities as $availability)
                            <div class="group flex justify-between items-center px-10 py-6 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-6">
                                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 flex flex-col items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <span class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">{{ substr($availability->day_of_week, 0, 3) }}</span>
                                        <span class="text-slate-800 font-black leading-none">
                                            {{ count($availabilities->where('day_of_week', $availability->day_of_week)) > 1 ? '•' : '' }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-800 capitalize leading-tight mb-1">{{ $availability->day_of_week }}</p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-bold text-slate-400">{{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}</span>
                                            <span class="text-slate-300">—</span>
                                            <span class="text-sm font-bold text-slate-400">{{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <span class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-500/5 text-emerald-500 text-[10px] font-black uppercase tracking-widest border border-emerald-500/10">
                                        Active
                                    </span>
                                    <button class="p-3 rounded-xl hover:bg-rose-50 text-slate-300 hover:text-rose-500 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="py-20 text-center">
                                <div class="text-5xl mb-4">🕒</div>
                                <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">Zero operational hours set</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>