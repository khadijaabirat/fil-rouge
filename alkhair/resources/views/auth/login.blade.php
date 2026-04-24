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
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-hidden">
<main class="flex min-h-screen w-full">
    
    <section class="hidden lg:flex lg:w-7/12 relative overflow-hidden bg-primary-container">
        <img alt="Un acte de solidarité et de partage" class="absolute inset-0 w-full h-full object-cover opacity-70 scale-105" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"/>
        
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/40 to-transparent"></div>
        
        <div class="relative z-10 flex flex-col justify-between p-16 w-full">
            <div>
                <div class="flex items-center gap-2 mb-12">
                    <span class="text-3xl font-black font-headline tracking-tighter text-white">AL-KHAIR</span>
                </div>
            </div>
            <div class="max-w-2xl">
                <h1 class="text-5xl font-extrabold font-headline leading-tight text-white tracking-tight mb-6">
                    Chaque don est une graine, <br/>
                    <span class="text-secondary-fixed">chaque sourire est une récolte.</span>
                </h1>
                <p class="text-xl text-on-primary-container leading-relaxed font-medium text-gray-200">
                    Rejoignez une communauté unie par l'espoir. Ensemble, construisons un avenir meilleur, en toute transparence et avec un impact réel.
                </p>
            </div>
            <div class="flex gap-8 items-center mt-12">
                <div class="flex flex-col">
                    <span class="text-surface-container-highest font-headline font-bold text-2xl">100%</span>
                    <span class="text-gray-300 text-xs font-label tracking-widest uppercase">Des dons reversés</span>
                </div>
                <div class="h-8 w-px bg-gray-400/50"></div>
                <div class="flex flex-col">
                    <span class="text-surface-container-highest font-headline font-bold text-2xl">Traçable</span>
                    <span class="text-gray-300 text-xs font-label tracking-widest uppercase">De l'intention à l'impact</span>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full lg:w-5/12 flex items-center justify-center p-8 md:p-12 bg-surface relative overflow-y-auto">
        <div class="w-full max-w-md">
            
            <div class="lg:hidden flex justify-center mb-12">
                <span class="text-3xl font-black font-headline tracking-tighter text-primary-container">AL-KHAIR</span>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-extrabold font-headline text-on-surface tracking-tight mb-2">Bon retour !</h2>
                <p class="text-on-surface-variant">Connectez-vous pour continuer à faire la différence.</p>
            </div>

            @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container text-sm font-medium border border-error/20 flex items-start gap-3">
                    <span class="material-symbols-outlined text-error">error</span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 text-sm font-medium border border-green-200 flex items-start gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wider" for="email">
                        Adresse e-mail
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline-variant">
                            <span class="material-symbols-outlined text-lg" data-icon="mail">mail</span>
                        </div>
                        <input class="block w-full pl-10 pr-4 py-3 bg-surface-container-lowest border-0 rounded-lg text-on-surface ring-1 ring-outline-variant focus:ring-2 focus:ring-secondary transition-all outline-none shadow-sm" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required autofocus type="email"/>
                    </div>
                    @error('email')
                        <p class="text-error text-xs font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">warning</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-xs font-label font-semibold text-on-surface-variant uppercase tracking-wider" for="password">
                            Mot de passe
                        </label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline-variant">
                            <span class="material-symbols-outlined text-lg" data-icon="lock">lock</span>
                        </div>
                        <input class="block w-full pl-10 pr-4 py-3 bg-surface-container-lowest border-0 rounded-lg text-on-surface ring-1 ring-outline-variant focus:ring-2 focus:ring-secondary transition-all outline-none shadow-sm" 
                               id="password" name="password" placeholder="••••••••" required type="password" autocomplete="current-password"/>
                    </div>
                    @error('password')
                        <p class="text-error text-xs font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">warning</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                        <input id="remember_me" name="remember" type="checkbox" class="w-4 h-4 rounded border-outline-variant text-secondary focus:ring-secondary cursor-pointer"/>
                        <span class="text-sm text-on-surface-variant font-medium group-hover:text-on-surface transition-colors">Se souvenir de moi</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold text-secondary hover:text-on-secondary-container transition-colors underline-offset-4 hover:underline">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="group w-full flex items-center justify-center gap-2 px-6 py-4 bg-secondary text-white font-bold rounded-lg shadow-md hover:bg-secondary/90 hover:shadow-lg active:scale-[0.98] transition-all duration-300">
                    <span>Se connecter</span>
                    <span class="material-symbols-outlined text-xl transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
                </button>
            </form>

            <div class="mt-12 pt-8 border-t border-surface-container-high text-center">
                <p class="text-on-surface-variant text-sm mb-4">
                    Envie de contribuer à notre mission ? 
                </p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-surface-container-low text-primary-container font-bold rounded-lg hover:bg-surface-container-high transition-colors group border border-outline-variant/30">
                    Créer un compte solidaire
                </a>
            </div>
        </div>
    </section>
</main>
</body>
</html>