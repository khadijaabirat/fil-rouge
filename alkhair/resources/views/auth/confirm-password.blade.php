<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Confirmation de sécurité | AL-KHAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
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
                        "outline-variant": "#c4c6ce",
                        "outline": "#74777e",
                        "secondary": "#7c5800",
                        "secondary-container": "#feb700",
                        "error": "#ba1a1a",
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased overflow-hidden">
<main class="flex min-h-screen">
    
    <section class="hidden lg:flex lg:w-1/2 relative items-center justify-center overflow-hidden bg-primary-container">
        <div class="absolute inset-0 z-0">
            <img alt="Sécurité et protection" class="h-full w-full object-cover opacity-70 scale-105" src="https://images.unsplash.com/photo-1555848962-6e79363ec58f?q=80&w=2033&auto=format&fit=crop"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#021c36] via-[#021c36]/40 to-transparent"></div>
        </div>
        
        <div class="relative z-10 p-16 w-full max-w-2xl">
            <div class="mb-8">
                <span class="inline-block px-4 py-1.5 rounded-full bg-secondary-container/20 backdrop-blur-md text-secondary-container text-xs font-bold tracking-widest uppercase mb-6">Zone Sécurisée</span>
                <h1 class="text-5xl xl:text-6xl font-extrabold text-white leading-[1.1] tracking-tighter">
                    Votre sécurité, <br/>notre priorité.
                </h1>
            </div>
            <div class="w-24 h-1 bg-secondary-container"></div>
            <p class="mt-8 text-white/80 text-lg max-w-md font-body leading-relaxed">
                Pour protéger vos données personnelles et l'historique de vos dons, nous devons vérifier votre identité avant de continuer.
            </p>
        </div>
    </section>

    <section class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-surface overflow-y-auto">
        <div class="w-full max-w-md">
            
            <div class="w-full flex justify-end mb-8">
                <a href="{{ url()->previous() }}" title="Annuler" class="material-symbols-outlined text-on-surface-variant hover:text-on-surface transition-colors cursor-pointer bg-surface-container-high p-2 rounded-full hover:bg-surface-container-highest">close</a>
            </div>

            <div class="mb-8 flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-container flex items-center justify-center rounded-lg shadow-md">
                    <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">shield_locked</span>
                </div>
                <span class="text-2xl font-extrabold tracking-tighter text-primary-container font-headline">AL-KHAIR</span>
            </div>

            <div class="mb-8 border-l-4 border-secondary-container pl-4">
                <h2 class="text-2xl font-bold text-on-surface font-headline tracking-tight mb-2">Confirmation requise</h2>
                <p class="text-on-surface-variant font-body leading-relaxed text-sm">
                    Ceci est une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1 font-label" for="password">
                        Mot de passe actuel
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline group-focus-within:text-primary-container transition-colors">lock</span>
                        </div>
                        <input class="block w-full pl-12 pr-4 py-4 bg-surface-container-lowest border border-outline-variant/50 rounded-xl text-on-surface placeholder:text-outline-variant focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all duration-200" 
                               id="password" name="password" required type="password" placeholder="••••••••" autocomplete="current-password" autofocus/>
                    </div>
                    @error('password')
                        <p class="text-error text-xs font-medium mt-1 flex items-center gap-1 px-1">
                            <span class="material-symbols-outlined text-[14px]">error</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <button class="w-full py-4 px-6 bg-[#001A33] hover:bg-[#00284d] text-white font-bold rounded-xl shadow-lg shadow-primary-container/10 transition-all duration-300 transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-3" type="submit">
                    <span class="material-symbols-outlined text-lg">verified</span>
                    <span>Confirmer l'identité</span>
                </button>
            </form>

        </div>
    </section>
</main>

</body>
</html>