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
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
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
            
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Schedule Service</h1>
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1 italic">Booking Engine v2.0</p>
                </div>
            </header>

            @if(session('error'))
                <div class="mb-8 p-5 bg-rose-50 border border-rose-100 rounded-3xl flex items-center gap-4 animate-fade-in">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 flex items-center justify-center text-rose-600">⚠️</div>
                    <p class="text-sm font-bold text-rose-700">{{ session('error') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
                
                {{-- Left Side: Provider Branding & Selection --}}
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-[3rem] p-10 shadow-soft border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50"></div>
                        
                        <div class="relative z-10">
                            <div class="flex items-center gap-6 mb-12">
                                <div class="w-20 h-20 rounded-[2rem] bg-brand-500 flex items-center justify-center text-4xl shadow-xl transform rotate-3">
                                    🏪
                                </div>
                                <div>
                                    <h2 class="text-4xl font-black text-slate-800 tracking-tighter leading-none">{{ $provider->business_name }}</h2>
                                    <p class="text-slate-400 font-bold mt-2 text-sm uppercase tracking-widest">📍 {{ $provider->location }}</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('customer.book.store', $provider->id) }}" class="space-y-8">
                                @csrf

                                {{-- Service Picker --}}
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Select Your Experience</label>
                                    <div class="grid grid-cols-1 gap-3">
                                        @foreach($provider->services as $service)
                                            <label class="relative flex items-center justify-between p-6 rounded-[2rem] border-2 cursor-pointer transition-all hover:bg-slate-50 group border-slate-100 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50/30">
                                                <input type="radio" name="service_id" value="{{ $service->id }}" class="hidden peer" required {{ old('service_id') == $service->id ? 'checked' : '' }}>
                                                
                                                <div class="flex items-center gap-4">
                                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-lg peer-checked:bg-brand-500 peer-checked:text-white transition-colors">✨</div>
                                                    <div>
                                                        <p class="font-black text-slate-800">{{ $service->name }}</p>
                                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $service->duration_minutes }} Minutes</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="text-right">
                                                    <p class="text-xl font-black text-slate-900 tracking-tighter">₹{{ number_format($service->price, 0) }}</p>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('service_id') <p class="text-rose-500 text-[10px] font-bold mt-2 uppercase tracking-widest">{{ $message }}</p> @enderror
                                </div>

                                {{-- Date & Time Section --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Preferred Date</label>
                                        <input type="date" name="booking_date"
                                            value="{{ old('booking_date') }}"
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                            class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 transition-all"
                                            required />
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Preferred Time</label>
                                        <input type="time" name="start_time"
                                            value="{{ old('start_time') }}"
                                            class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 transition-all"
                                            required />
                                    </div>
                                </div>

                                {{-- Notes --}}
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Special Requests (Optional)</label>
                                    <textarea name="notes" rows="3"
                                        class="w-full bg-slate-50 border-none rounded-3xl px-6 py-5 focus:ring-2 focus:ring-brand-500 font-medium text-slate-700 placeholder:text-slate-300"
                                        placeholder="Tell us anything that will help your provider...">{{ old('notes') }}</textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-slate-900 text-white py-6 rounded-[2rem] font-black text-lg uppercase tracking-widest hover:bg-black transition-all hover:scale-[1.02] active:scale-95 shadow-xl shadow-slate-200">
                                    Confirm Reservation
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Quick Info Card --}}
                <div class="hidden xl:block">
                    <div class="bg-brand-500 rounded-[3rem] p-10 text-white shadow-2xl relative overflow-hidden sticky top-10">
                        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                        <h3 class="text-2xl font-black tracking-tight mb-6">Booking Policy</h3>
                        <ul class="space-y-6">
                            <li class="flex gap-4">
                                <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center flex-shrink-0">⚡</div>
                                <p class="text-sm font-medium leading-relaxed text-white/80">Confirmations are usually instant or within 2 hours of booking.</p>
                            </li>
                            <li class="flex gap-4">
                                <div class="w-8 h-8 rounded-lg bg-white/20 flex items-center justify-center flex-shrink-0">🕒</div>
                                <p class="text-sm font-medium leading-relaxed text-white/80">Please arrive 5-10 minutes prior to your scheduled time.</p>
                            </li>
                        </ul>
                        <div class="mt-12 pt-10 border-t border-white/10">
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2">Powered by</p>
                            <span class="font-black text-xl italic tracking-tighter">DoorStep</span>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-app-layout>