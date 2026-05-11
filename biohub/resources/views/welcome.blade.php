<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Bio-Hub') }} - Premium Service Platform</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&family=Inter:wght@400;500;600;800&display=swap');
            
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            .animate-float { animation: float 6s ease-in-out infinite; }
        </style>
    </head>
    <body class="bg-[#f3f6ff] text-slate-900 font-sans antialiased selection:bg-brand-500/30 selection:text-brand-600 overflow-x-hidden">
        
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none bg-white">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.03] mix-blend-overlay"></div>
            
            <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-brand-200/40 blur-[140px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-200/40 blur-[140px] animate-pulse" style="animation-delay: 2s;"></div>
            
            <div class="absolute inset-0" style="background-image: radial-gradient(#8080801a 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>

        <header class="fixed top-0 w-full z-50 border-b border-slate-200/50 bg-white/60 backdrop-blur-2xl transition-all duration-300">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="w-10 h-10 rounded-2xl bg-slate-900 flex items-center justify-center shadow-2xl transition-transform group-hover:rotate-6">
                            <span class="text-white font-black text-xl font-heading">B</span>
                        </div>
                        <span class="font-heading font-black text-2xl tracking-tighter text-slate-900 uppercase">BioHub</span>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex items-center gap-8">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 rounded-2xl bg-slate-900 text-white text-xs font-black uppercase tracking-widest hover:bg-black transition-all hover:scale-105 active:scale-95 shadow-xl shadow-slate-200">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-xs font-black text-slate-400 uppercase tracking-widest hover:text-slate-900 transition-colors">
                                    Sign in
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-7 py-3 rounded-2xl bg-brand-500 text-white text-xs font-black uppercase tracking-widest shadow-xl shadow-brand-500/20 hover:bg-brand-600 transition-all hover:-translate-y-0.5">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <main class="relative pt-48 pb-20 lg:pt-64 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
                
                <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/80 border border-slate-200 shadow-sm backdrop-blur-md text-brand-600 text-[10px] font-black uppercase tracking-[0.2em] mb-12 animate-fade-in">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    Infrastructure for Professionals
                </div>

                <h1 class="text-6xl md:text-9xl font-black tracking-tighter mb-10 font-heading animate-slide-up leading-[0.85] text-slate-900">
                    Precision<br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-indigo-600">Performance.</span>
                </h1>

                <p class="max-w-2xl mx-auto text-lg md:text-xl text-slate-500 mb-14 font-medium animate-slide-up leading-relaxed" style="animation-delay: 0.1s;">
                    The OS for modern providers. We strip away the complexity so you can focus on your craft. Managed bookings, automated flow.
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-6 animate-slide-up" style="animation-delay: 0.2s;">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-12 py-6 rounded-3xl bg-slate-900 text-white font-black text-sm uppercase tracking-widest hover:shadow-2xl transition-all hover:scale-105 active:scale-95">
                        Launch Profile
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-12 py-6 rounded-3xl bg-white border border-slate-200 text-slate-900 font-black text-sm uppercase tracking-widest hover:bg-slate-50 transition-all">
                        Features
                    </a>
                </div>

                <div class="mt-32 relative max-w-6xl mx-auto animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="relative rounded-[3.5rem] border border-slate-200 bg-white p-5 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] overflow-hidden animate-float">
                        <div class="rounded-[2.5rem] overflow-hidden bg-[#f8fafc] border border-slate-100 aspect-[16/9] relative group">
                             <div class="absolute inset-0 bg-gradient-to-tr from-brand-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                             
                             <div class="w-full h-full flex">
                                 <div class="w-1/4 h-full bg-slate-900 p-10 hidden md:block">
                                     <div class="space-y-6">
                                         <div class="w-full h-2 rounded-full bg-white/10"></div>
                                         <div class="w-3/4 h-2 rounded-full bg-white/10"></div>
                                         <div class="w-1/2 h-2 rounded-full bg-white/10"></div>
                                     </div>
                                 </div>
                                 <div class="flex-1 p-12">
                                     <div class="flex justify-between items-start mb-16">
                                         <div class="space-y-3 text-left">
                                             <div class="w-32 h-6 rounded-xl bg-slate-200"></div>
                                             <div class="w-20 h-4 rounded-xl bg-slate-100"></div>
                                         </div>
                                         <div class="w-12 h-12 rounded-2xl bg-brand-100"></div>
                                     </div>
                                     <div class="grid grid-cols-3 gap-8">
                                         <div class="h-48 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm"></div>
                                         <div class="h-48 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm"></div>
                                         <div class="h-48 rounded-[2.5rem] bg-white border border-slate-100 shadow-sm"></div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section id="features" class="py-32 relative bg-white">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <div class="group p-10 rounded-[3rem] bg-[#f8fafc] border border-slate-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50">
                        <div class="w-14 h-14 rounded-2xl bg-slate-900 flex items-center justify-center text-xl mb-8 group-hover:scale-110 transition-transform">
                            <span class="text-white">⚡</span>
                        </div>
                        <h3 class="text-2xl font-black tracking-tight mb-4 text-slate-900">Rapid Deploy</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Your entire service infrastructure online in minutes. Built for speed, scaled for growth.</p>
                    </div>

                    <div class="group p-10 rounded-[3rem] bg-[#f8fafc] border border-slate-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50">
                        <div class="w-14 h-14 rounded-2xl bg-brand-500 flex items-center justify-center text-xl mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-brand-500/20">
                            <span class="text-white">📅</span>
                        </div>
                        <h3 class="text-2xl font-black tracking-tight mb-4 text-slate-900">Sync Logic</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">Intelligent timezone handling and real-time buffer calculation for surgical scheduling.</p>
                    </div>

                    <div class="group p-10 rounded-[3rem] bg-[#f8fafc] border border-slate-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-slate-200/50">
                        <div class="w-14 h-14 rounded-2xl bg-indigo-500 flex items-center justify-center text-xl mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-indigo-500/20">
                            <span class="text-white">💎</span>
                        </div>
                        <h3 class="text-2xl font-black tracking-tight mb-4 text-slate-900">Luxury Tier UI</h3>
                        <p class="text-slate-500 leading-relaxed font-medium">A visual experience designed to reflect the premium nature of your professional services.</p>
                    </div>

                </div>
            </div>
        </section>

        <footer class="bg-white border-t border-slate-100 py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-start gap-12">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-slate-900 flex items-center justify-center">
                                <span class="text-white font-black text-sm">B</span>
                            </div>
                            <span class="font-heading font-black text-2xl text-slate-900 tracking-tighter uppercase">BioHub</span>
                        </div>
                        <p class="text-slate-400 font-bold text-xs max-w-xs uppercase tracking-widest leading-loose">
                            Redefining the service operating system for the next generation of providers.
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-16">
                        <div class="space-y-4">
                            <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Product</p>
                            <div class="flex flex-col gap-3 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                <a href="#" class="hover:text-brand-500">Analytics</a>
                                <a href="#" class="hover:text-brand-500">Security</a>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Legal</p>
                            <div class="flex flex-col gap-3 text-xs font-bold text-slate-400 uppercase tracking-widest">
                                <a href="#" class="hover:text-brand-500 transition-colors">Privacy</a>
                                <a href="#" class="hover:text-brand-500 transition-colors">Terms</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-24 pt-8 border-t border-slate-50 flex justify-between items-center">
                    <p class="text-[10px] font-black text-slate-300 tracking-[0.3em] uppercase">&copy; 2026 BIO-HUB OS</p>
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">All Systems Operational</span>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>