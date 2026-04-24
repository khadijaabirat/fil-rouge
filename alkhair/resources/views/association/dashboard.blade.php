<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Espace Association | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
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
            <span class="font-semibold text-sm hidden md:block">{{ $association->name }}</span>
        </div>
    </div>
</nav>

<div class="flex pt-16 min-h-screen">
    
    <aside class="hidden md:flex h-screen w-64 fixed left-0 top-0 pt-24 flex-col gap-2 p-4 bg-surface-container-lowest border-r border-outline-variant/10">
        <nav class="flex flex-col gap-2 flex-grow">
            <a href="#" class="flex items-center gap-3 bg-primary-container text-white rounded-xl px-4 py-3 shadow-sm transition-transform translate-x-1">
                <span class="material-symbols-outlined text-secondary-container">dashboard</span>
                <span class="font-body text-sm font-semibold tracking-wide">Vue d'ensemble</span>
            </a>
            <a href="#projets" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">folder_open</span>
                <span class="font-body text-sm font-semibold tracking-wide">Mes Projets</span>
            </a>
            <a href="{{ route('impact.create', 0) }}" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">verified</span>
                <span class="font-body text-sm font-semibold tracking-wide">Preuves d'impact</span>
            </a>
        </nav>

        <div class="mt-auto mb-4 space-y-2">
            <a href="#" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">manage_accounts</span>
                <span class="font-body text-sm font-semibold tracking-wide">Mon Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-error px-4 py-3 hover:bg-error-container/50 rounded-xl transition-all duration-200">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body text-sm font-semibold tracking-wide">Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 p-6 md:p-10 bg-surface">
        
        @if($association->status === 'PENDING')
            <div class="mb-8 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl flex items-start gap-3 shadow-sm">
                <span class="material-symbols-outlined text-yellow-600">pending_actions</span>
                <div>
                    <strong class="block mb-1">Compte en cours de vérification</strong>
                    <span class="text-sm">L'administration vérifie actuellement vos documents KYC. Vous pourrez créer des projets dès la validation.</span>
                </div>
            </div>
        @elseif($association->status === 'ACTIVE')
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-8 p-4 bg-error-container border border-error/20 text-on-error-container rounded-xl flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-error">error</span>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            @endif
        @endif

        <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-headline font-extrabold tracking-tight text-primary-container mb-2">Tableau de bord</h1>
                <p class="text-on-surface-variant leading-relaxed">Suivez l'évolution de vos collectes et l'impact de vos actions en temps réel.</p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @php
                    $hasPendingReports = \App\Models\Project::where('association_id', $association->id)
                        ->whereHas('donations', function ($query) {
                            $query->where('status', 'RECEIVED');
                        })->exists();
                @endphp

                <a href="{{ route('impact.create', 0) }}" class="flex items-center gap-2 px-6 py-3 bg-surface-container-highest text-primary-container rounded-xl font-bold hover:bg-outline-variant/30 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    Publier un impact
                </a>

                @if(!$hasPendingReports && $association->status === 'ACTIVE')
                    <a href="{{ route('projects.create') }}" class="flex items-center gap-2 px-6 py-3 bg-primary-container text-white rounded-xl font-bold shadow-md hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        Nouveau Projet
                    </a>
                @endif
            </div>
        </header>

        @if($hasPendingReports && $association->status === 'ACTIVE')
            <div class="bg-error-container/30 border-l-4 border-error p-5 rounded-xl shadow-sm mb-10 flex items-start gap-4">
                <span class="material-symbols-outlined text-error text-2xl">warning</span>
                <div>
                    <h3 class="text-error font-bold font-headline mb-1">Création de projet bloquée</h3>
                    <p class="text-sm text-on-error-container/80 leading-relaxed">
                        Vous avez reçu des fonds pour un ou plusieurs projets terminés. Par souci de transparence, vous devez obligatoirement publier le <strong>Rapport d'Impact</strong> de ces projets avant de pouvoir lancer une nouvelle campagne.
                    </p>
                </div>
            </div>
        @endif

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="md:col-span-2 bg-primary-container text-white p-8 rounded-2xl shadow-lg relative overflow-hidden group">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="material-symbols-outlined text-secondary-container text-4xl">account_balance_wallet</span>
                        </div>
                        <p class="text-gray-300 font-medium text-sm uppercase tracking-widest mb-1">Fonds Totaux Collectés</p>
                        <h2 class="text-4xl md:text-5xl font-black text-white">{{ number_format($association->projects()->sum('currentAmount'), 0, ',', ' ') }} <span class="text-2xl text-secondary-container">DH</span></h2>
                    </div>
                </div>
                <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-secondary-container/20 rounded-full blur-3xl group-hover:bg-secondary-container/30 transition-colors duration-700"></div>
            </div>

            <div class="space-y-6">
                <div class="bg-surface-container-lowest p-6 rounded-2xl flex items-center justify-between border border-outline-variant/20 shadow-sm">
                    <div>
                        <p class="text-on-surface-variant text-xs font-bold uppercase tracking-widest mb-1">Projets Actifs</p>
                        <h3 class="text-3xl font-black text-primary-container">{{ $projects->where('status', 'OPEN')->count() }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-surface-container-low flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary-container">volunteer_activism</span>
                    </div>
                </div>
                
                <div class="bg-surface-container-lowest p-6 rounded-2xl flex items-center justify-between border border-outline-variant/20 shadow-sm">
                    <div>
                        <p class="text-on-surface-variant text-xs font-bold uppercase tracking-widest mb-1">Donateurs Uniques</p>
                        <h3 class="text-3xl font-black text-secondary">{{ \App\Models\Donation::whereHas('project', function($q) use ($association) { $q->where('association_id', $association->id); })->distinct('donator_id')->count() }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary-container">groups</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="projets" class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-headline font-extrabold text-primary-container">Gestion des Projets</h2>
            </div>

            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        @php
                            $isExpired = \Carbon\Carbon::now()->greaterThan($project->endDate);
                            $isFullyFunded = $project->currentAmount >= $project->goalAmount;
                            $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
                            $hasReceived = $project->donations()->where('status', 'RECEIVED')->exists();
                            $hasReport = \App\Models\ImpactReport::where('project_id', $project->id)->exists();
                            $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                            $percentage = min($percentage, 100);
                        @endphp

                        <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm border border-outline-variant/10 hover:shadow-lg transition-all duration-300 flex flex-col">
                            <div class="h-40 relative overflow-hidden bg-surface-container-low">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover" alt="{{ $project->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-container to-surface-tint"></div>
                                @endif
                                
                                <div class="absolute top-4 right-4 text-[0.65rem] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-sm
                                    {{ $project->status === 'OPEN' ? 'bg-secondary-container text-on-secondary-container' : ($project->status === 'COMPLETED' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white') }}">
                                    {{ $project->status === 'OPEN' ? 'Actif' : ($project->status === 'COMPLETED' ? 'Complété' : 'Suspendu') }}
                                </div>
                            </div>

                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold font-headline text-primary-container mb-2 line-clamp-1">{{ $project->title }}</h3>
                                    <p class="text-sm text-on-surface-variant line-clamp-2 mb-4">{{ $project->description }}</p>
                                </div>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-[0.75rem] font-bold font-label uppercase text-primary-container">
                                        <span>{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span>{{ number_format($percentage, 0) }}%</span>
                                    </div>
                                    <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-secondary to-secondary-container" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-[0.7rem] text-on-surface-variant font-medium">
                                        <span>Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                        <span>Fin: {{ \Carbon\Carbon::parse($project->endDate)->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-outline-variant/10">
                                    @if($isExpired && !$isFullyFunded && $project->status === 'OPEN')
                                        <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-xl">
                                            <p class="text-xs text-yellow-800 font-bold mb-2 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">warning</span> Délai expiré.</p>
                                            <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <input type="date" name="newEndDate" required class="bg-white border border-yellow-300 rounded-lg p-2 text-xs focus:ring-secondary-container flex-1">
                                                <button type="submit" class="bg-secondary-container text-on-secondary-container px-3 py-2 rounded-lg text-xs font-bold hover:bg-yellow-500 transition">
                                                    Prolonger
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($project->status === 'COMPLETED')
                                        @if($hasReport)
                                            <div class="p-3 bg-surface-container-low rounded-xl flex items-center gap-2 text-primary-container">
                                                <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                                <span class="text-sm font-bold">Rapport d'impact publié</span>
                                            </div>
                                        @elseif($hasReceived)
                                            <div class="p-3 bg-error-container/20 border border-error/20 rounded-xl flex justify-between items-center">
                                                <span class="text-xs text-error font-bold">Fonds reçus ! Action requise :</span>
                                                <a href="{{ route('impact.create', $project->id) }}" class="bg-primary-container text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-800 transition">
                                                    Publier rapport
                                                </a>
                                            </div>
                                        @elseif($hasProcessing)
                                            <div class="p-3 bg-surface-container-low rounded-xl flex items-center gap-2 text-on-surface-variant">
                                                <span class="material-symbols-outlined text-secondary-container">hourglass_top</span>
                                                <span class="text-sm font-medium">Transfert des fonds en cours...</span>
                                            </div>
                                        @else
                                            <div class="p-3 bg-green-50 border border-green-200 rounded-xl flex justify-between items-center">
                                                <span class="text-xs text-green-800 font-bold">Objectif atteint !</span>
                                                <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-green-700 transition">
                                                        Retirer les fonds
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex gap-2">
                                            <a href="{{ route('projects.show', $project->id) }}" class="flex-1 text-center py-2 bg-surface-container-low text-primary-container text-sm font-bold rounded-lg hover:bg-surface-container-high transition">Aperçu</a>
                                            <a href="{{ route('projects.edit', $project->id) }}" class="flex-1 text-center py-2 bg-surface-container-highest text-on-surface text-sm font-bold rounded-lg hover:bg-outline-variant/50 transition">Modifier</a>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-surface-container-lowest p-12 rounded-2xl text-center border-2 border-dashed border-outline-variant/50 shadow-sm">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">folder_off</span>
                    <h3 class="text-xl font-bold text-primary-container mb-2">Aucun projet créé</h3>
                    <p class="text-on-surface-variant mb-6">Commencez votre première campagne de collecte de fonds.</p>
                    @if($association->status === 'ACTIVE' && !$hasPendingReports)
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 bg-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-md hover:bg-slate-800 transition">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Créer un projet
                        </a>
                    @endif
                </div>
            @endif
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="activites">
            
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-2xl font-headline font-extrabold text-primary-container">Activités Récentes</h2>
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-outline-variant/10">
                    <div class="space-y-6">
                        @php
                            $recentDonations = \App\Models\Donation::whereHas('project', function($q) use ($association) {
                                $q->where('association_id', $association->id);
                            })->orderByDesc('created_at')->limit(3)->get();
                        @endphp

                        @forelse($recentDonations as $donation)
                            <div class="flex gap-4 items-start">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center mt-1">
                                    <span class="material-symbols-outlined text-secondary-container text-[20px]">payments</span>
                                </div>
                                <div class="flex-grow border-b border-outline-variant/10 pb-4">
                                    <h4 class="font-bold text-primary-container text-sm">Nouveau don reçu</h4>
                                    <p class="text-on-surface-variant text-sm mt-1">Un don de <strong class="text-secondary">{{ number_format($donation->amount, 0) }} DH</strong> a été effectué pour "{{ $donation->project->title }}".</p>
                                    <span class="text-xs text-outline font-medium mt-2 block">{{ $donation->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-on-surface-variant">Aucune activité récente pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-2xl font-headline font-extrabold text-primary-container">Bilan Global</h2>
                <div class="bg-primary-container text-white p-8 rounded-2xl relative overflow-hidden">
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary-container text-3xl">task_alt</span>
                            <div>
                                <p class="text-2xl font-bold">{{ \App\Models\ImpactReport::whereHas('project', function($q) use ($association) { $q->where('association_id', $association->id); })->count() }}</p>
                                <p class="text-xs text-white/70 uppercase tracking-widest font-bold">Rapports publiés</p>
                            </div>
                        </div>
                        <hr class="border-white/10">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-secondary-container text-3xl">volunteer_activism</span>
                            <div>
                                <p class="text-2xl font-bold">{{ $projects->where('status', 'COMPLETED')->count() }}</p>
                                <p class="text-xs text-white/70 uppercase tracking-widest font-bold">Projets complétés</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <span class="material-symbols-outlined text-[150px]">public</span>
                    </div>
                </div>
            </div>
            
        </section>

    </main>
</div>

</body>
</html>