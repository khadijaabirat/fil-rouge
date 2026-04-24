<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Vérification Email | AL-KHAIR</title>
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
              "secondary-container": "#feb700",
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
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-hidden h-screen">
<main class="flex h-full w-full">

    <section class="hidden lg:flex lg:w-7/12 relative overflow-hidden bg-primary-container h-full">
        <img alt="Montagnes de l'Atlas au lever du soleil" class="absolute inset-0 w-full h-full object-cover opacity-60 scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPU6QeP7r0iqeIshag5RR0qSG3n62TVVF51xYvARbQKwsWC1mmzwm4_IqfcQz3ciDGVtW-mS1ZqRDODMDHrKvsSwBRHwG6tLSqqZtFaLqNY7JOQXizja8tn4g6r6LFxD2WlZ8OPF_KmFbIuOXZZyCapmnmUWAn4N1LKeELpG3m5YqC6D86FQbltAPKYif3Aj24xx1nlScfD7GNvjDf3fnZ-kcPatGA_LZ97YmqhwpQ9fDy5VGu098PPDgl6me9MJYuYghWJsQP_iI"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-transparent to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-between p-16 w-full">
            <div>
                <div class="flex items-center gap-2 mb-12">
                    <span class="text-3xl font-black font-headline tracking-tighter text-white">AL-KHAIR</span>
                </div>
            </div>
            <div class="max-w-xl">
                <h1 class="text-5xl font-extrabold font-headline leading-tight text-white tracking-tight mb-6">
                    Préserver l'héritage, <br/>
                    <span class="text-secondary-fixed">bâtir l'avenir.</span>
                </h1>
                <p class="text-xl text-on-primary-container leading-relaxed font-medium text-gray-300">
                    Bienvenue dans la plateforme solidaire. Votre portail sécurisé pour la gestion de l'impact humanitaire et la transparence.
                </p>
            </div>
            <div class="flex gap-8 items-center">
                <div class="flex flex-col">
                    <span class="text-surface-container-highest font-headline font-bold text-2xl">24/7</span>
                    <span class="text-gray-400 text-xs font-label tracking-widest uppercase">Support Translucide</span>
                </div>
                <div class="h-8 w-px bg-gray-500/50"></div>
                <div class="flex flex-col">
                    <span class="text-surface-container-highest font-headline font-bold text-2xl">100%</span>
                    <span class="text-gray-400 text-xs font-label tracking-widest uppercase">Éthique & Sécurisé</span>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full lg:w-5/12 flex flex-col p-8 md:p-12 bg-surface relative overflow-y-auto h-full">
        
        <div class="w-full flex justify-end mb-4">
            <a href="{{ url('/') }}" title="Retour à l'accueil" class="material-symbols-outlined text-on-surface-variant hover:text-on-surface transition-colors cursor-pointer bg-surface-container-high p-2 rounded-full hover:bg-surface-container-highest">close</a>
        </div>

        <div class="lg:hidden flex justify-center mb-8">
            <span class="text-2xl font-black font-headline tracking-tighter text-primary-container">AL-KHAIR</span>
        </div>

        <div class="flex-grow flex flex-col justify-center max-w-md mx-auto w-full">
            
            <div class="relative mb-10 mx-auto">
                <div class="absolute inset-0 bg-secondary-container opacity-20 blur-3xl rounded-full scale-150"></div>
                <div class="relative w-20 h-20 bg-surface-container-lowest shadow-sm rounded-3xl flex items-center justify-center border border-outline-variant/20">
                    <span class="material-symbols-outlined text-secondary-container text-4xl" style="font-variation-settings: 'FILL' 0;">mark_email_unread</span>
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold font-headline text-on-surface tracking-tight mb-3">Vérifiez votre email</h2>
                <p class="text-on-surface-variant text-base leading-relaxed">
                    Nous avons envoyé un lien de confirmation à <br>
                    <strong class="text-primary-container font-semibold">{{ auth()->user()->email ?? 'votre adresse email' }}</strong>
                </p>
            </div>

            <div class="w-full bg-surface-container-lowest shadow-sm border border-outline-variant/20 rounded-2xl p-6 mb-8 text-left">
                <h3 class="font-headline font-bold text-primary-container mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary-container text-xl" style="font-variation-settings: 'FILL' 1;">info</span>
                    Pourquoi vérifier mon email ?
                </h3>
                <ul class="text-sm text-on-surface-variant font-medium leading-relaxed space-y-3">
                    <li class="flex items-start gap-2">
                        <span class="text-secondary-container mt-0.5">✓</span>
                        <span><strong class="text-on-surface">Sécurité :</strong> Protéger votre compte contre les accès non autorisés.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-secondary-container mt-0.5">✓</span>
                        <span><strong class="text-on-surface">Reçus fiscaux :</strong> Recevoir vos reçus de dons en PDF.</span>
                    </li>
                </ul>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="w-full bg-green-50 border border-green-200 rounded-xl p-4 mb-6 text-left">
                    <div class="flex gap-3 items-center">
                        <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        <p class="text-sm text-green-800 font-medium">
                            Un nouveau lien a été envoyé à votre adresse email.
                        </p>
                    </div>
                </div>
            @endif

            <div class="w-full space-y-4 mt-auto">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-primary-container text-white font-headline font-bold rounded-xl shadow-lg hover:bg-slate-800 active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">send</span>
                        Renvoyer l'email
                    </button>
                </form>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 text-on-surface-variant font-headline font-semibold hover:text-primary-container transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Se déconnecter
                    </button>
                </form>
            </div>

        </div>
    </section>
</main>
</body>
</html>