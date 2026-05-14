<x-app-layout>
    <div class="flex h-screen bg-[#f3f6ff] font-sans text-slate-900 overflow-hidden">
        
        {{-- Sidebar: Consistent Navigation --}}
        <aside class="hidden lg:flex flex-col fixed left-4 top-4 bottom-4 w-64 bg-brand-500 text-white rounded-r-[3rem] shadow-2xl relative overflow-hidden">
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
                    <a href="{{ route('customer.providers') }}" class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 rounded-2xl font-semibold transition-all group">
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Find Services
                    </a>
                    <a href="#" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        My Bookings
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Booking History</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1 italic">Manage your active reservations</p>
                </div>
                <a href="{{ route('customer.providers') }}" class="px-6 py-3 bg-slate-900 text-white font-black rounded-2xl text-xs uppercase tracking-widest hover:bg-black transition-all hover:scale-105 active:scale-95 shadow-xl shadow-slate-200">
                    + New Appointment
                </a>
            </header>

            {{-- Success Notification --}}
            @if(session('success'))
                <div class="mb-8 p-5 bg-emerald-50 border border-emerald-100 rounded-3xl flex items-center gap-4 animate-fade-in">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-600">✅</div>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-[3rem] shadow-soft border border-slate-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                    <h3 class="font-black text-slate-800 tracking-tight text-xl">All Appointments</h3>
                    <span class="px-4 py-1.5 rounded-xl bg-white border border-slate-200 text-slate-400 text-[10px] font-black uppercase tracking-widest">
                        {{ count($bookings) }} Records Found
                    </span>
                </div>

                <div class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                    <div class="group flex flex-col lg:flex-row lg:items-center justify-between px-10 py-8 hover:bg-slate-50/80 transition-all">
                        
                        {{-- Provider & Service Info --}}
                        <div class="flex items-center gap-6 mb-4 lg:mb-0 lg:w-1/3">
                            <div class="w-16 h-16 rounded-[1.5rem] bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-black shadow-sm group-hover:scale-110 transition-transform uppercase">
                                {{ substr($booking->provider->business_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-800 leading-tight mb-1">{{ $booking->provider->business_name }}</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-brand-500 bg-brand-50 px-2 py-0.5 rounded-md">{{ $booking->service->name }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Date & Time --}}
                        <div class="flex flex-col lg:items-center mb-4 lg:mb-0 lg:w-1/3">
                            <div class="flex items-center gap-2 text-slate-800 font-black text-sm">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            </div>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} — {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                            </p>
                        </div>

                        {{-- Status & Actions --}}
                        <div class="flex items-center justify-between lg:justify-end gap-6 lg:w-1/3">
                            
                            {{-- Status Badge --}}
                            <span class="px-5 py-2 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] border
                                {{ $booking->status === 'confirmed' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-amber-50 text-amber-600 border-amber-100' : '' }}
                                {{ $booking->status === 'rejected' ? 'bg-rose-50 text-rose-600 border-rose-100' : '' }}
                                {{ $booking->status === 'cancelled' ? 'bg-slate-50 text-slate-400 border-slate-100' : '' }}">
                                {{ $booking->status }}
                            </span>

                            {{-- Cancel Button (Only for Pending) --}}
                            <div class="w-12 h-12 flex items-center justify-center">
                                @if($booking->status === 'pending')
                                @can('cancel',$booking)
                                <form method="POST" action="{{ route('customer.bookings.cancel', $booking->id) }}" onsubmit="return confirm('Withdraw this booking request?');">
                                    @csrf
                                    <button class="p-3 bg-white border border-slate-200 text-rose-500 rounded-xl hover:bg-rose-50 transition-all hover:scale-110 active:scale-95 shadow-sm" title="Cancel Booking">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Expanded Notes Section (If any) --}}
                    @if($booking->notes)
                    <div class="px-10 pb-8 -mt-4">
                        <div class="bg-slate-50 rounded-2xl p-4 flex gap-3 items-start border border-slate-100/50">
                            <span class="text-slate-300">📝</span>
                            <p class="text-xs font-medium text-slate-500 italic">"{{ $booking->notes }}"</p>
                        </div>
                    </div>
                    @endif

                    @empty
                    <div class="py-32 text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] mx-auto mb-6 flex items-center justify-center text-slate-200 text-3xl">
                            🗓️
                        </div>
                        <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-xs mb-6">No appointment history found</p>
                        <a href="{{ route('customer.providers') }}" class="px-8 py-4 bg-brand-500 text-white font-black rounded-2xl shadow-xl shadow-brand-500/20 hover:scale-105 transition-all">
                            Book Your First Service
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</x-app-layout>