<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar (Consistent with Dashboard/Services) --}}
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
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Bookings
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Order Flow</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1">Live appointment streams</p>
                </div>
            </header>

            @if(session('success'))
                <div class="mb-8 flex items-center gap-4 p-5 bg-emerald-50 border border-emerald-100 rounded-2xl animate-fade-in">
                    <span class="text-emerald-500">✅</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-soft border border-slate-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                    <h3 class="font-black text-slate-800 tracking-tight text-xl">All Bookings</h3>
                    <div class="flex gap-2">
                         <span class="px-4 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-400 text-[10px] font-black uppercase tracking-widest">{{ count($bookings) }} Total</span>
                    </div>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                    <div class="group flex flex-col lg:flex-row lg:items-center justify-between px-10 py-8 hover:bg-slate-50/80 transition-all">
                        
                        {{-- Customer & Service Info --}}
                        <div class="flex items-center gap-6 mb-4 lg:mb-0">
                            <div class="w-16 h-16 rounded-[1.5rem] bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-black shadow-sm group-hover:scale-110 transition-transform">
                                {{ substr($booking->customer->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 leading-tight mb-1">{{ $booking->customer->name }}</h4>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-bold text-brand-500 bg-brand-50 px-2 py-0.5 rounded-md">{{ $booking->service->name }}</span>
                                    @if($booking->notes)
                                        <span class="text-xs text-slate-400 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                                            Notes attached
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Date & Time --}}
                        <div class="flex flex-col lg:items-center mb-4 lg:mb-0">
                            <div class="flex items-center gap-2 text-slate-800 font-black text-sm">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            </div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} — {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                            </p>
                        </div>

                        {{-- Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-6">
                            
                            {{-- Status Badge --}}
                            <span class="px-5 py-2 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] border
                                {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : '' }}
                                {{ $booking->status === 'rejected' ? 'bg-rose-50 text-rose-600 border-rose-100' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-slate-50 text-slate-400 border-slate-100' : '' }}
                                {{ $booking->status === 'completed' ? 'bg-brand-50 text-brand-600 border-brand-100' : '' }}">
                                {{ $booking->status }}
                            </span>

                            @if($booking->status === 'pending')
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('provider.bookings.confirm', $booking->id) }}">
                                    @csrf
                                    <button class="p-3 bg-slate-900 text-white rounded-xl hover:bg-black transition-all shadow-lg shadow-slate-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('provider.bookings.reject', $booking->id) }}">
                                    @csrf
                                    <button class="p-3 bg-white border border-slate-200 text-rose-500 rounded-xl hover:bg-rose-50 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="py-32 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] mx-auto mb-6 flex items-center justify-center text-slate-200">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs">No active bookings found</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- Notes Context (Optional Modal or Tooltip style) --}}
            @foreach($bookings as $booking)
                @if($booking->notes)
                <div class="mt-4 p-4 bg-brand-50/30 border border-brand-100 rounded-2xl hidden lg:block">
                     <p class="text-[10px] font-black text-brand-400 uppercase tracking-widest mb-1">Customer Note for {{ $booking->customer->name }}</p>
                     <p class="text-sm font-medium text-slate-600">"{{ $booking->notes }}"</p>
                </div>
                @endif
            @endforeach
        </main>
    </div>
</x-app-layout>