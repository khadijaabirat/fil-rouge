<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Connexion | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
                "primary-container": "#021c36",
                "surface": "#f8f9fb",
                "on-surface": "#191c1e",
                "on-surface-variant": "#43474d",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#f2f4f6",
                "surface-container-high": "#e6e8ea",
                "surface-container-highest": "#e0e3e5",
                "outline-variant": "#c4c6ce",
                "secondary": "#7c5800",
                "secondary-fixed": "#ffdea8",
                "error": "#ba1a1a",
                "error-container": "#ffdad6",
                "on-error-container": "#93000a",
            },
            fontFamily: {
                "headline": ["Manrope"],
                "body": ["Inter"],
                "label": ["Inter"]
            }
          },
        },
      }
    </script>
    <style>
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
      @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
      .float { animation: float 6s ease-in-out infinite; }
      @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
      .fade-up { animation: fadeUp 0.6s ease-out backwards; }
      .fade-up-2 { animation: fadeUp 0.6s ease-out 0.15s backwards; }
      .fade-up-3 { animation: fadeUp 0.6s ease-out 0.3s backwards; }
    </style>
</head>
<body class="bg-[#f0f2f5] font-body text-[#191c1e] antialiased overflow-hidden">
<main class="flex min-h-screen w-full">
    
    <section class="hidden lg:flex lg:w-7/12 relative overflow-hidden bg-[#0A1128]">
        <img alt="Solidarité" class="absolute inset-0 w-full h-full object-cover opacity-40" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"/>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128] via-[#0A1128]/60 to-transparent"></div>
        <div class="absolute top-1/4 right-1/4 w-64 h-64 bg-[#F5A623]/15 rounded-full blur-3xl float"></div>
        <div class="absolute bottom-1/3 left-1/4 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl float" style="animation-delay:2s"></div>
        
        <div class="relative z-10 flex flex-col justify-between p-14 w-full">
            <div>
                <div class="flex items-center gap-2.5 mb-16">
                    <div class="w-20 h-20">
                        <x-application-logo class="w-20 h-20" />
                    </div>
                </div>
            </div>
            <div class="max-w-xl">
                <h1 class="text-4xl font-extrabold leading-tight text-white tracking-tight mb-4">
                    Chaque don est une graine,<br/>
                    <span class="text-[#F5A623]">chaque sourire est une récolte.</span>
                </h1>
                <p class="text-base text-blue-100/60 leading-relaxed">
                    Rejoignez une communauté unie par l'espoir et la transparence.
                </p>
            </div>
            <div class="flex gap-8 items-center mt-10">
                <div class="flex flex-col">
                    <span class="text-white font-black text-2xl">100%</span>
                    <span class="text-white/40 text-[10px] font-bold tracking-widest uppercase">Dons reversés</span>
                </div>
                <div class="h-8 w-px bg-white/10"></div>
                <div class="flex flex-col">
                    <span class="text-white font-black text-2xl">Traçable</span>
                    <span class="text-white/40 text-[10px] font-bold tracking-widest uppercase">De l'intention à l'impact</span>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full lg:w-5/12 flex items-center justify-center p-8 md:p-12 bg-white relative">
        <div class="w-full max-w-md">
            
            <div class="lg:hidden flex justify-center mb-10">
                <div class="w-24 h-24">
                    <x-application-logo class="w-24 h-24" />
                </div>
            </div>

            <div class="mb-8 fade-up">
                <h2 class="text-2xl font-extrabold text-[#0A1128] tracking-tight mb-1">Bon retour !</h2>
                <p class="text-slate-400 text-sm">Connectez-vous pour continuer à faire la différence.</p>
            </div>

            @if (session('error'))
                <div class="mb-5 p-3.5 rounded-xl bg-red-50 text-red-700 text-sm font-medium border border-red-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-500 text-lg" style="font-variation-settings: 'FILL' 1;">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @if (session('status'))
                <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-200 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-500 text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5 fade-up-2">
                @csrf

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1.5" for="email">E-mail</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-slate-300 text-lg">mail</span>
                        </div>
                        <input class="block w-full pl-11 pr-4 py-3 bg-[#f0f2f5] border-0 rounded-xl text-[#0A1128] font-medium focus:ring-2 focus:ring-[#F5A623]/50 focus:bg-white transition-all placeholder:text-slate-300" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required autofocus type="email"/>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">warning</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1.5" for="password">Mot de passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-slate-300 text-lg">lock</span>
                        </div>
                        <input class="block w-full pl-11 pr-4 py-3 bg-[#f0f2f5] border-0 rounded-xl text-[#0A1128] font-medium focus:ring-2 focus:ring-[#F5A623]/50 focus:bg-white transition-all placeholder:text-slate-300" 
                               id="password" name="password" placeholder="••••••••" required type="password" autocomplete="current-password"/>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">warning</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                        <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 rounded border-slate-300 text-[#F5A623] focus:ring-[#F5A623] cursor-pointer"/>
                        <span class="text-sm text-slate-400 font-medium group-hover:text-slate-600 transition-colors">Se souvenir</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-bold text-[#F5A623] hover:text-[#0A1128] transition-colors">Oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-3.5 bg-[#0A1128] hover:bg-[#F5A623] text-white hover:text-[#0A1128] font-bold rounded-xl transition-all active:scale-[0.98]">
                    Se connecter
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center fade-up-3">
                <p class="text-slate-400 text-sm mb-3">Pas encore de compte ?</p>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#f0f2f5] hover:bg-[#0A1128] text-[#0A1128] hover:text-white font-bold text-sm rounded-xl transition-all border border-slate-200 hover:border-transparent">
                    Créer un compte
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>
</main>
</body>
</html>