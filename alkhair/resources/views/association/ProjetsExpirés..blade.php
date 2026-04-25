<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Projets Expirés | Espace Association AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-container": "#021c36",
              "secondary-container": "#feb700",
              "on-secondary-container": "#6b4b00",
              "surface": "#f8f9fb",
              "on-surface": "#191c1e",
              "on-surface-variant": "#43474d",
              "surface-container-lowest": "#ffffff",
              "surface-container-low": "#f2f4f6",
              "surface-container-high": "#e6e8ea",
              "surface-container-highest": "#e0e3e5",
              "outline-variant": "#c4c6ce",
              "secondary": "#7c5800",
              "error": "#ba1a1a",
              "error-container": "#ffdad6",
              "on-error-container": "#93000a",
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
      body { font-family: 'Inter', sans-serif; background-color: #f8f9fb; color: #191c1e; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden">

<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl shadow-sm flex justify-between items-center px-6 md:px-8 py-4 border-b border-outline-variant/10">
    <div class="flex items-center gap-8">
        <span class="text-2xl font-extrabold tracking-tighter text-primary-container font-headline">AL-KHAIR</span>
        <span class="hidden md:inline-block px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-label font-bold tracking-widest text-on-surface-variant uppercase">
            Espace Association
        </span>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3 bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/20">
            <div class="w-8 h-8 rounded-full overflow-hidden bg-secondary-container flex items-center justify-center text-primary-container font-bold">
                <span class="material-symbols-outlined text-[18px]">foundation</span>
            </div>
            <span class="font-semibold text-sm hidden md:block">{{ auth()->user()->name }}</span>
        </div>
    </div>
</nav>

<div class="flex pt-16 min-h-screen">
    
    <aside class="hidden lg:flex h-screen w-64 fixed left-0 top-0 pt-24 flex-col gap-2 p-4 bg-surface-container-lowest border-r border-outline-variant/10">
        <nav class="flex flex-col gap-2 flex-grow">
            <a href="{{ route('association.dashboard') }}" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:bg-surface-container-low hover:text-primary-container rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-body text-sm font-semibold tracking-wide">Vue d'ensemble</span>
            </a>
            <a href="#" class="flex items-center gap-3 bg-primary-container text-white rounded-xl px-4 py-3 shadow-sm transition-transform translate-x-1">
                <span class="material-symbols-outlined text-secondary-container">hourglass_empty</span>
                <span class="font-body text-sm font-semibold tracking-wide">Projets Expirés</span>
            </a>
            <a href="{{ route('impact.create', 0) }}" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:bg-surface-container-low hover:text-primary-container rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">verified</span>
                <span class="font-body text-sm font-semibold tracking-wide">Preuves d'impact</span>
            </a>
            <a href="{{ route('association.profile') }}" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:bg-surface-container-low hover:text-primary-container rounded-xl transition-all duration-200 mt-4">
                <span class="material-symbols-outlined">manage_accounts</span>
                <span class="font-body text-sm font-semibold tracking-wide">Mon Profil</span>
            </a>
        </nav>

        <div class="mt-auto mb-4 space-y-2">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-error px-4 py-3 hover:bg-error-container/50 rounded-xl transition-all duration-200 font-bold">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body text-sm">Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 lg:ml-64 pt-8 pb-20 px-6 md:px-10 bg-surface min-h-screen">
        <div class="max-w-6xl mx-auto">
            
            <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <h1 class="text-3xl md:text-4xl font-headline font-extrabold text-primary-container leading-tight">Projets Expirés</h1>
                    <p class="mt-4 text-on-surface-variant leading-relaxed">
                        Ces projets ont atteint leur date limite sans atteindre l'objectif financier initial. Veuillez décider de la marche à suivre pour chaque initiative.
                    </p>
                </div>
                <div class="flex items-center gap-3 bg-surface-container-lowest p-4 rounded-2xl border border-outline-variant/20 shadow-sm">
                    <span class="material-symbols-outlined text-secondary text-3xl">hourglass_empty</span>
                    <div>
                        <p class="text-2xl font-bold font-headline">{{ $expiredProjects->count() ?? 0 }}</p>
                        <p class="text-xs font-label uppercase text-on-surface-variant">Projets en attente</p>
                    </div>
                </div>
            </div>

            <div class="mb-10 p-6 bg-primary-container border-l-4 border-secondary-container rounded-r-xl flex items-start gap-4 shadow-md">
                <span class="material-symbols-outlined text-secondary-container mt-1" style="font-variation-settings: 'FILL' 1;">warning</span>
                <div class="space-y-2 text-white">
                    <h3 class="font-headline font-bold text-secondary-container text-lg">Protocole de Transparence & Rapports d'Impact</h3>
                    <p class="text-sm text-blue-100 leading-relaxed max-w-4xl">
                        Conformément à la charte AL-KHAIR, toute décision de <strong>Clôture et Transfert</strong> des fonds engagera votre association à fournir un <strong>Rapport d'Impact</strong> détaillé. Même si l'objectif total n'est pas atteint, les donateurs doivent être informés de l'utilisation exacte de leurs contributions partielles.
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-8 p-4 rounded-xl bg-error-container text-on-error-container border border-error/20 shadow-sm flex items-start gap-3">
                    <span class="material-symbols-outlined text-error">error</span>
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(isset($expiredProjects) && $expiredProjects->count() > 0)
                <div class="space-y-8">
                    @foreach($expiredProjects as $project)
                        <div class="group bg-surface-container-lowest rounded-3xl overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-lg transition-all duration-300 border border-outline-variant/20">
                            
                            <div class="md:w-1/3 relative h-48 md:h-auto overflow-hidden bg-primary-container">
                                @if($project->image)
                                    <img alt="{{ $project->title }}" class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $project->image) }}"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-secondary-container text-5xl font-black">AK</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                                    <span class="bg-error text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">Expiré le {{ \Carbon\Carbon::parse($project->endDate)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            
                            <div class="md:w-2/3 p-6 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-headline font-bold text-xl text-primary-container mb-2">{{ $project->title }}</h3>
                                    <p class="text-xs text-on-surface-variant mb-4 flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">location_on</span> {{ $project->ville ?? 'Maroc' }}
                                    </p>
                                    
                                    @php
                                        $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                        $percentage = min($percentage, 100);
                                    @endphp

                                    <div class="space-y-2 mb-6 bg-surface-container-low p-4 rounded-xl border border-outline-variant/10">
                                        <div class="flex justify-between text-sm font-bold">
                                            <span class="text-primary-container">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH collectés</span>
                                            <span class="text-on-surface-variant">Objectif : {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                        </div>
                                        <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-secondary to-secondary-container" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <p class="text-[10px] text-secondary font-bold text-right">{{ number_format($percentage, 0) }}% de l'objectif atteint</p>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3 border-t border-outline-variant/20 pt-4 mt-2">
                                    <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex-1 flex gap-2">
                                        @csrf
                                        <input type="date" name="newEndDate" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" 
                                               class="w-1/2 bg-surface border-outline-variant/30 rounded-lg text-xs focus:ring-secondary-container" title="Nouvelle date de fin">
                                        <button type="submit" class="w-1/2 py-2.5 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-transform flex items-center justify-center gap-1 shadow-sm">
                                            <span class="material-symbols-outlined text-[16px]">update</span> Prolonger
                                        </button>
                                    </form>

                                    <form action="{{ route('association.withdraw', $project->id) }}" method="POST" class="flex-1" onsubmit="return confirm('En clôturant ce projet, vous vous engagez à publier un rapport d\'impact pour les fonds récoltés. Continuer ?');">
                                        @csrf
                                        <button type="submit" class="w-full py-2.5 border-2 border-primary-container text-primary-container rounded-lg font-bold text-sm hover:bg-primary-container hover:text-white transition-colors flex items-center justify-center gap-1">
                                            <span class="material-symbols-outlined text-[16px]">swap_horiz</span> Clôturer & Retirer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-surface-container-lowest p-12 rounded-3xl text-center border-2 border-dashed border-outline-variant/40 shadow-sm mt-10">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">task_alt</span>
                    <h3 class="text-xl font-bold text-primary-container mb-2">Aucun projet expiré</h3>
                    <p class="text-on-surface-variant mb-6">Tous vos projets sont soit en cours, soit déjà complétés.</p>
                    <a href="{{ route('association.dashboard') }}" class="inline-flex items-center gap-2 text-secondary font-bold hover:underline transition-all">
                        Retourner au Tableau de Bord
                    </a>
                </div>
            @endif
        </div>
    </main>

</div>
</body>
</html>