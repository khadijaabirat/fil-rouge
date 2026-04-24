<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "al-navy": "#0A1128",
                        "al-gold": "#F5A623",
                        "secondary-fixed": "#ffdea8",
                        "on-tertiary-fixed": "#370e00",
                        "outline-variant": "#c4c6ce",
                        "surface-container-low": "#f2f4f6",
                        "surface-bright": "#f8f9fb",
                        "on-tertiary-fixed-variant": "#7f2b00",
                        "on-primary": "#ffffff",
                        "tertiary-container": "#370e00",
                        "secondary-fixed-dim": "#ffba20",
                        "surface-variant": "#e0e3e5",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-container": "#6f85a3",
                        "primary-fixed-dim": "#b1c8e9",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#4a607c",
                        "on-secondary-fixed-variant": "#5e4200",
                        "inverse-on-surface": "#eff1f3",
                        "on-primary-fixed": "#021c36",
                        "inverse-primary": "#b1c8e9",
                        "secondary": "#7c5800",
                        "primary-container": "#0A1128",
                        "primary": "#000000",
                        "inverse-surface": "#2d3133",
                        "surface": "#f8f9fb",
                        "tertiary-fixed-dim": "#ffb599",
                        "on-secondary-container": "#6b4b00",
                        "outline": "#74777e",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-dim": "#d8dadc",
                        "primary-fixed": "#d2e4ff",
                        "on-surface-variant": "#43474d",
                        "on-background": "#191c1e",
                        "on-surface": "#191c1e",
                        "on-secondary": "#ffffff",
                        "background": "#f8f9fb",
                        "error": "#ba1a1a",
                        "surface-container": "#eceef0",
                        "tertiary": "#000000",
                        "secondary-container": "#F5A623",
                        "tertiary-fixed": "#ffdbce",
                        "on-error-container": "#93000a",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#271900",
                        "on-primary-fixed-variant": "#324863",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-container": "#e05814"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-xl shadow-sm dark:shadow-none">
    <div class="flex justify-between items-center max-w-7xl mx-auto px-6 h-20">
        <div class="text-2xl font-black tracking-tighter text-al-navy dark:text-white">Al-Khair</div>
        <div class="hidden md:flex items-center gap-8 font-['Manrope'] font-semibold text-sm tracking-tight">
            <a class="text-slate-600 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold transition-colors" href="#projets">Projets</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold transition-colors" href="#activites">Impact</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold transition-colors" href="#">Transparence</a>
        </div>
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:scale-[1.02] transition-transform">search</span>
            <a href="{{ route('association.profile') }}" class="px-5 py-2.5 rounded-full bg-al-navy text-white font-bold text-sm hover:scale-[1.02] transition-all active:scale-95">Mon Profil</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-5 py-2.5 rounded-full bg-red-500 text-white font-bold text-sm hover:scale-[1.02] transition-all active:scale-95">Déconnecter</button>
            </form>
        </div>
    </div>
    <div class="bg-slate-100/50 dark:bg-slate-800/50 h-[1px] w-full"></div>
</nav>

<!-- Main Dashboard Content -->
<main class="pt-28 pb-20 max-w-7xl mx-auto px-6">
    <!-- Status Alerts -->
    @if($association->status === 'PENDING')
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-6 border border-yellow-300">
            <strong>Attention :</strong> Votre compte est en cours de vérification par l'administration.
            Vous ne pourrez créer des projets qu'après validation de vos documents KYC.
        </div>
    @elseif($association->status === 'ACTIVE')
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
    @endif

    <!-- Header Section -->
    <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
        <div class="space-y-2">
            <span class="text-al-gold font-label text-[0.75rem] font-bold tracking-[0.05rem] uppercase px-3 py-1 bg-al-navy/10 rounded-full">Tableau de bord Association</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-al-navy tracking-tight">Vue d'ensemble</h1>
            <p class="text-on-surface-variant max-w-xl text-lg">Bienvenue, {{ $association->name }}. Suivez l'évolution de vos collectes et l'impact de vos actions en temps réel.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            @php
                $hasPendingReports = \App\Models\Project::where('association_id', $association->id)
                    ->whereHas('donations', function ($query) {
                        $query->where('status', 'RECEIVED');
                    })->exists();
            @endphp
            @if(!$hasPendingReports && $association->status === 'ACTIVE')
                <a href="{{ route('projects.create') }}" class="flex items-center gap-2 px-6 py-3 bg-al-navy text-white rounded-full font-bold hover:scale-[1.02] transition-all active:scale-95">
                    <span class="material-symbols-outlined">add_circle</span>
                    Créer un projet
                </a>
            @endif
            <a href="{{ route('impact.create', 0) }}" class="flex items-center gap-2 px-6 py-3 bg-al-gold text-white rounded-full font-bold hover:scale-[1.02] transition-all active:scale-95">
                <span class="material-symbols-outlined">verified</span>
                Publier une preuve d'impact
            </a>
        </div>
    </header>

    <!-- Pending Reports Alert -->
    @php
        $hasPendingReports = \App\Models\Project::where('association_id', $association->id)
            ->whereHas('donations', function ($query) {
                $query->where('status', 'RECEIVED');
            })->exists();
    @endphp

    @if($hasPendingReports && $association->status === 'ACTIVE')
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm mb-8">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-bold">Création de projet bloquée !</p>
                    <p class="text-sm text-red-600 mt-1">
                        Vous avez reçu des fonds pour un ou plusieurs projets. Vous devez obligatoirement publier leur <a href="#projets" class="underline font-bold">Rapport d'Impact</a> avant de pouvoir lancer une nouvelle campagne de collecte.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Grid -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
        <!-- Large Stat Card -->
        <div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/10 relative overflow-hidden group">
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <div class="flex justify-between items-start mb-6">
                        <span class="p-3 bg-surface-container-low rounded-lg text-al-navy">
                            <span class="material-symbols-outlined text-3xl">account_balance_wallet</span>
                        </span>
                        <span class="text-green-600 flex items-center gap-1 font-bold text-sm bg-green-50 px-2 py-1 rounded">
                            <span class="material-symbols-outlined text-sm">trending_up</span>
                            +12.4%
                        </span>
                    </div>
                    <p class="text-on-surface-variant font-medium">Montant total collecté</p>
                    <h2 class="text-5xl font-black text-al-navy mt-2">{{ number_format($association->projects()->sum('currentAmount'), 0, ',', ' ') }} DH</h2>
                </div>
                <div class="mt-8 flex gap-4 overflow-hidden grayscale opacity-30 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                    <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-al-gold to-al-navy w-[75%]"></div>
                    </div>
                </div>
            </div>
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-al-navy/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Smaller Stat Cards Stack -->
        <div class="space-y-6">
            <div class="bg-al-navy text-white p-6 rounded-xl flex items-center justify-between">
                <div>
                    <p class="text-white/70 text-sm font-medium">Projets actifs</p>
                    <h3 class="text-3xl font-bold">{{ $projects->count() }}</h3>
                </div>
                <span class="material-symbols-outlined text-4xl opacity-50">volunteer_activism</span>
            </div>
            <div class="bg-surface-container-low p-6 rounded-xl flex items-center justify-between border border-outline-variant/10">
                <div>
                    <p class="text-on-surface-variant text-sm font-medium">Donateurs uniques</p>
                    <h3 class="text-3xl font-bold text-al-navy">{{ \App\Models\Donation::whereHas('project', function($q) { $q->where('association_id', $association->id); })->distinct('donator_id')->count() }}</h3>
                </div>
                <span class="material-symbols-outlined text-4xl text-al-navy">groups</span>
            </div>
            <div class="bg-surface-container-low p-6 rounded-xl flex items-center justify-between border border-outline-variant/10">
                <div>
                    <p class="text-on-surface-variant text-sm font-medium">Preuves validées</p>
                    <h3 class="text-3xl font-bold text-al-navy">{{ \App\Models\ImpactReport::whereHas('project', function($q) { $q->where('association_id', $association->id); })->count() }}</h3>
                </div>
                <span class="material-symbols-outlined text-4xl text-al-gold">task_alt</span>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="mb-20" id="projets">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-al-navy">Suivi des Projets</h2>
            @if($projects->count() > 0)
                <a href="#" class="text-al-navy font-semibold flex items-center gap-1 hover:underline">
                    Voir tout
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            @endif
        </div>

        @if($projects->count() > 0)
            <!-- Bento Grid style for projects -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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

                    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/5 hover:shadow-md transition-shadow flex flex-col">
                        <div class="h-48 relative overflow-hidden bg-gradient-to-br from-al-navy to-al-gold">
                            <div class="absolute top-4 right-4 bg-al-gold text-white text-[0.65rem] font-bold px-2 py-1 rounded uppercase tracking-wider">
                                {{ $project->status === 'OPEN' ? 'Actif' : ($project->status === 'COMPLETED' ? 'Complété' : 'Fermé') }}
                            </div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-al-navy mb-2">{{ $project->title }}</h3>
                                <p class="text-on-surface-variant text-sm line-clamp-2 mb-6">{{ Str::limit($project->description, 100) }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between text-[0.75rem] font-bold font-label uppercase text-on-surface-variant">
                                    <span>{{ number_format($project->currentAmount, 0, ',', ' ') }} DH collectés</span>
                                    <span>{{ number_format($percentage, 0) }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-al-gold to-al-navy" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-[0.7rem] text-on-surface-variant/70">
                                    <span>Objectif : {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                    <span>{{ \Carbon\Carbon::parse($project->endDate)->diffForHumans() }}</span>
                                </div>
                            </div>

                            @if($isExpired && !$isFullyFunded && $project->status === 'OPEN')
                                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-sm text-yellow-800 mb-2">Le délai est expiré et l'objectif n'est pas atteint.</p>
                                    <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="date" name="newEndDate" required class="border-gray-300 rounded-md shadow-sm p-1 text-sm focus:ring-al-navy focus:border-al-navy flex-1">
                                        <button type="submit" class="bg-al-gold text-white px-3 py-1 rounded text-sm hover:bg-opacity-90">
                                            Prolonger
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if($project->status === 'COMPLETED')
                                @if($hasReport)
                                    <div class="mt-3 p-3 bg-gray-100 border border-gray-300 rounded">
                                        <p class="text-sm text-gray-700 font-bold">✓ Rapport d'impact publié.</p>
                                    </div>
                                @elseif($hasReceived)
                                    <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-blue-800 font-bold">Fonds reçus !</p>
                                        <a href="{{ route('impact.create', $project->id) }}" class="bg-al-navy text-white px-3 py-1 rounded text-sm hover:bg-opacity-90">
                                            Publier rapport
                                        </a>
                                    </div>
                                @elseif($hasProcessing)
                                    <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                        <p class="text-sm text-yellow-800">Demande de retrait en cours de traitement.</p>
                                    </div>
                                @else
                                    <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-green-800">Objectif atteint !</p>
                                        <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                                                Demander les fonds
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun projet créé</h3>
                <p class="text-gray-500 mb-4">Vous n'avez créé aucun projet pour le moment.</p>
                @if($association->status === 'ACTIVE' && !$hasPendingReports)
                    <a href="{{ route('projects.create') }}" class="inline-block bg-al-navy text-white px-6 py-3 rounded-lg font-bold hover:bg-opacity-90 transition">
                        Créer votre premier projet
                    </a>
                @endif
            </div>
        @endif
    </section>

    <!-- Recent Activities & Impact Feed -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-12" id="activites">
        <div class="lg:col-span-2 space-y-8">
            <h2 class="text-2xl font-bold text-al-navy">Dernières Activités</h2>
            <div class="bg-surface-container-low rounded-2xl p-8">
                <div class="space-y-8">
                    @php
                        $recentDonations = \App\Models\Donation::whereHas('project', function($q) {
                            $q->where('association_id', $association->id);
                        })->orderByDesc('created_at')->limit(3)->get();

                        $recentReports = \App\Models\ImpactReport::whereHas('project', function($q) {
                            $q->where('association_id', $association->id);
                        })->orderByDesc('created_at')->limit(3)->get();
                    @endphp

                    @forelse($recentReports as $report)
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-al-navy/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-al-navy">history_edu</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-al-navy">Preuve d'impact soumise</h4>
                                <p class="text-on-surface-variant text-sm mt-1">Le projet <span class="text-al-gold font-semibold">{{ $report->project->title }}</span> a publié son rapport d'impact.</p>
                                <span class="text-[0.7rem] text-on-surface-variant/60 mt-2 block italic">{{ $report->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex gap-6 opacity-50">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center">
                                <span class="material-symbols-outlined text-on-surface-variant">history_edu</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-on-surface-variant">Aucune activité récente</h4>
                                <p class="text-on-surface-variant text-sm mt-1">Les preuves d'impact que vous publierez apparaîtront ici.</p>
                            </div>
                        </div>
                    @endforelse

                    @forelse($recentDonations as $donation)
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-al-gold/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-al-gold">payments</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-al-navy">Don reçu</h4>
                                <p class="text-on-surface-variant text-sm mt-1">Un don de <span class="text-al-gold font-semibold">{{ number_format($donation->amount, 0) }} DH</span> a été effectué pour la <span class="text-al-gold font-semibold">{{ $donation->project->title }}</span>.</p>
                                <span class="text-[0.7rem] text-on-surface-variant/60 mt-2 block italic">{{ $donation->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Impact Sidebar -->
        <div class="space-y-8">
            <h2 class="text-2xl font-bold text-al-navy">Impact Global</h2>
            <div class="bg-al-navy text-white p-8 rounded-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-white/60 font-label text-[0.7rem] uppercase tracking-widest mb-6">Indicateurs clés</p>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-al-gold">child_care</span>
                            <div>
                                <p class="text-2xl font-bold">{{ \App\Models\ImpactReport::whereHas('project', function($q) { $q->where('association_id', $association->id); })->sum('peopleImpacted') }}+</p>
                                <p class="text-xs text-white/70">Personnes impactées</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-al-gold">water_drop</span>
                            <div>
                                <p class="text-2xl font-bold">{{ $projects->count() }}</p>
                                <p class="text-xs text-white/70">Projets en cours</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-al-gold">health_and_safety</span>
                            <div>
                                <p class="text-2xl font-bold">{{ \App\Models\ImpactReport::whereHas('project', function($q) { $q->where('association_id', $association->id); })->count() }}</p>
                                <p class="text-xs text-white/70">Rapports d'impact</p>
                            </div>
                        </div>
                    </div>
                    <button class="mt-10 w-full py-4 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl transition-colors font-bold text-sm">
                        Télécharger le rapport annuel
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto px-6 font-['Inter'] text-sm leading-relaxed text-al-navy dark:text-blue-100">
        <div>
            <span class="text-xl font-bold text-al-navy dark:text-white mb-4 block">Al-Khair</span>
            <p class="text-slate-500 dark:text-slate-400">Institution humanitaire engagée pour la transparence et l'action directe.</p>
        </div>
        <div>
            <h4 class="font-bold mb-4">Navigation</h4>
            <div class="flex flex-col gap-2">
                <a class="text-slate-500 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold hover:underline transition-all" href="#">Mentions Légales</a>
                <a class="text-slate-500 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold hover:underline transition-all" href="#">Confidentialité</a>
                <a class="text-slate-500 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold hover:underline transition-all" href="#">Recrutement</a>
            </div>
        </div>
        <div>
            <h4 class="font-bold mb-4">Aide</h4>
            <div class="flex flex-col gap-2">
                <a class="text-slate-500 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold hover:underline transition-all" href="#">Contact</a>
                <a class="text-slate-500 dark:text-slate-400 hover:text-al-navy dark:hover:text-al-gold hover:underline transition-all" href="#">FAQ</a>
            </div>
        </div>
        <div>
            <h4 class="font-bold mb-4">Newsletter</h4>
            <p class="text-slate-500 dark:text-slate-400 mb-4">Restez informé de nos derniers impacts.</p>
            <div class="flex gap-2">
                <input class="bg-white dark:bg-slate-800 border-none rounded-lg text-sm flex-1 focus:ring-al-gold" placeholder="votre@email.com" type="email"/>
                <button class="bg-al-navy text-white p-2 rounded-lg">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex justify-between items-center text-slate-500 dark:text-slate-400">
        <p>© 2024 Al-Khair Institution. Tous droits réservés.</p>
        <div class="flex gap-4">
            <span class="material-symbols-outlined cursor-pointer hover:text-al-navy transition-colors">social_leaderboard</span>
            <span class="material-symbols-outlined cursor-pointer hover:text-al-navy transition-colors">crossword</span>
            <span class="material-symbols-outlined cursor-pointer hover:text-al-navy transition-colors">linked_camera</span>
        </div>
    </div>
</footer>
</body>
</html>
