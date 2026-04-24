<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Merci pour votre don | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
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
            },
            fontFamily: {
              "headline": ["Manrope"],
              "body": ["Inter"],
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen">
<main class="flex flex-col lg:flex-row min-h-screen">
    
    <section class="lg:w-1/2 relative min-h-[400px] lg:min-h-screen flex items-center justify-center overflow-hidden">
        <img alt="Impact" class="absolute inset-0 w-full h-full object-cover" 
             src="{{ $donation->project->image ? asset('storage/' . $donation->project->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2070&auto=format&fit=crop' }}"/>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-container/90 via-primary-container/40 to-transparent"></div>
        <div class="relative z-10 text-center px-8 max-w-xl">
            <div class="inline-flex items-center justify-center w-20 h-20 mb-8 bg-secondary-container rounded-full shadow-2xl animate-bounce">
                <span class="material-symbols-outlined text-4xl text-yellow-900" style="font-variation-settings: 'FILL' 1;">favorite</span>
            </div>
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-6">
                Merci pour votre générosité
            </h1>
            <p class="text-xl text-white/90 leading-relaxed font-medium">
                Votre don est un phare d'espoir pour les communautés bénéficiaires.
            </p>
        </div>
    </section>

    <section class="lg:w-1/2 bg-surface flex flex-col p-8 md:p-12 lg:p-20 overflow-y-auto h-screen">
        <div class="max-w-xl mx-auto w-full space-y-10 mt-auto mb-auto">
            
            @if($donation->status === 'PENDING')
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-yellow-600">hourglass_top</span>
                    <div>
                        <h4 class="font-bold text-sm">Don en cours de validation</h4>
                        <p class="text-xs mt-1">Nous avons bien reçu votre reçu de virement. Notre équipe va le valider dans les plus brefs délais.</p>
                    </div>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <div>
                        <h4 class="font-bold text-sm">Paiement réussi</h4>
                        <p class="text-xs mt-1">Votre don a été traité avec succès.</p>
                    </div>
                </div>
            @endif

            <div class="bg-surface-container-lowest p-8 md:p-10 rounded-2xl shadow-xl shadow-primary-container/5 border border-outline-variant/20">
                <div class="flex justify-between items-start mb-10 pb-6 border-b border-surface-container-high">
                    <div>
                        <span class="font-label text-xs font-bold tracking-widest text-secondary uppercase mb-2 block">Reçu de Don</span>
                        <h2 class="font-headline text-3xl font-bold text-primary-container">Résumé</h2>
                    </div>
                    <div class="text-right">
                        <span class="text-on-surface-variant text-xs block uppercase tracking-wider">Date</span>
                        <span class="font-semibold text-sm">{{ $donation->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="space-y-6 mb-10">
                    <div class="flex items-center justify-between">
                        <span class="text-on-surface-variant font-medium">Montant Contribué</span>
                        <span class="font-headline text-3xl font-extrabold text-primary-container">{{ number_format($donation->amount, 0, ',', ' ') }} DH</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-on-surface-variant font-medium">Projet Soutenu</span>
                        <span class="font-semibold text-right text-primary-container max-w-[200px] truncate" title="{{ $donation->project->title }}">
                            {{ $donation->project->title }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-on-surface-variant font-medium">N° de Suivi</span>
                        <span class="font-mono text-xs font-bold text-outline-variant">#DON-{{ str_pad($donation->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <div class="space-y-6 pt-8 border-t border-surface-container-high">
                    <h3 class="font-headline text-lg font-bold text-primary-container flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-secondary">history_edu</span>
                        L'Archive Éthique
                    </h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-secondary border-4 border-secondary-container"></div>
                                <div class="w-0.5 h-full bg-surface-container-highest"></div>
                            </div>
                            <div>
                                <h4 class="font-bold text-primary-container text-sm">Déploiement en temps réel</h4>
                                <p class="text-xs text-on-surface-variant mt-1">L'association est notifiée immédiatement de votre contribution.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-outline-variant"></div>
                                <div class="w-0.5 h-full bg-surface-container-highest"></div>
                            </div>
                            <div>
                                <h4 class="font-bold text-primary-container text-sm">Vérification sur le terrain</h4>
                                <p class="text-xs text-on-surface-variant mt-1">Suivi de l'évolution du projet via votre tableau de bord.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-outline-variant"></div>
                            </div>
                            <div>
                                <h4 class="font-bold text-primary-container text-sm">Rapport d'Impact</h4>
                                <p class="text-xs text-on-surface-variant mt-1">Rapport de transparence envoyé à la fin du projet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <a href="{{ route('donator.dashboard') }}" class="flex-1 px-8 py-4 bg-primary-container text-white font-bold rounded-xl text-center hover:bg-slate-800 hover:shadow-lg transition-all active:scale-95 text-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    Tableau de bord
                </a>
                <a href="{{ route('donator.dashboard') }}#projets" class="flex-1 px-8 py-4 border-2 border-secondary-container text-secondary font-bold rounded-xl text-center hover:bg-secondary-container/10 transition-all active:scale-95 text-sm flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">explore</span>
                    Explorer
                </a>
            </div>
        </div>
    </section>
</main>
</body>
</html>