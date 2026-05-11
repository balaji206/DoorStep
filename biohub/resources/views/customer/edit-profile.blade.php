<x-app-layout>
    <div class="flex min-h-screen bg-[#f3f6ff] font-sans text-slate-900">
        
        {{-- Sidebar: Consistent Navigation --}}
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
                        <svg class="w-5 h-5 text-white/70 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-4 px-6 py-4 bg-white/15 rounded-2xl font-bold shadow-inner border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Account Settings
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">
            
            <header class="mb-12">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Identity Settings</h1>
                <p class="text-sm font-bold text-slate-500 uppercase tracking-tighter mt-1">Manage your personal credentials</p>
            </header>

            {{-- Success Notification --}}
            @if(session('status') === 'profile-updated')
                <div class="mb-8 p-5 bg-emerald-50 border border-emerald-100 rounded-3xl flex items-center gap-4 animate-fade-in">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-600">✨</div>
                    <p class="text-sm font-bold text-emerald-700">Your profile has been successfully synchronized.</p>
                </div>
            @endif

            <div class="max-w-2xl">
                <div class="bg-white rounded-[3rem] p-10 shadow-soft border border-slate-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-brand-50 rounded-full -mr-32 -mt-32 blur-3xl opacity-50"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-6 mb-10">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-[2rem] bg-brand-500 flex items-center justify-center text-3xl shadow-xl transform rotate-3">
                                    👤
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full"></div>
                            </div>
                            <div>
                                <h2 class="text-xl font-black text-slate-800 tracking-tight">Public Profile</h2>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">ID: #{{ auth()->user()->id }}</p>
                            </div>
                        </div>

                        <form method="post" action="{{ route('customer.profile.update') }}" class="space-y-8">
                            @csrf
                            @method('patch')

                            {{-- Name Input --}}
                            <div>
                                <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Display Name</label>
                                <input id="name" name="name" type="text" 
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 transition-all" 
                                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2 text-[10px] font-bold uppercase text-rose-500" :messages="$errors->get('name')" />
                            </div>

                            {{-- Email Input --}}
                            <div>
                                <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Email Address</label>
                                <input id="email" name="email" type="email" 
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 font-bold text-slate-700 transition-all" 
                                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                                <x-input-error class="mt-2 text-[10px] font-bold uppercase text-rose-500" :messages="$errors->get('email')" />

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                                        <p class="text-xs font-bold text-amber-700 uppercase tracking-tight">
                                            Your email address is unverified.
                                            <button form="send-verification" class="underline hover:text-amber-900 ml-2">Click here to re-send.</button>
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <button type="submit" class="px-10 py-5 bg-slate-900 text-white font-black rounded-2xl shadow-xl hover:bg-black transition-all hover:scale-105 active:scale-95 text-xs uppercase tracking-widest">
                                    Save Changes
                                </button>
                                
                                @if (session('status') === 'profile-updated')
                                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Saved.</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>