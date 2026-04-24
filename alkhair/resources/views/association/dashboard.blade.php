<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Association - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Espace Association : {{ $association->name }}</h1>
<div class="space-x-3">
                <a href="{{ route('association.profile') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition shadow-sm">
                    Mon Profil & RIB
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Se déconnecter</button>
                </form>
            </div>
        @if($association->status === 'PENDING')
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4 border border-yellow-300">
                <strong>Attention :</strong> Votre compte est en cours de vérification par l'administration.
                Vous ne pourrez créer des projets qu'après validation de vos documents KYC.
            </div>

        @elseif($association->status === 'ACTIVE')
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                Votre compte est validé. Vous pouvez maintenant gérer vos projets.
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @php
             $hasPendingReports = \App\Models\Project::where('association_id', $association->id)
                ->whereHas('donations', function ($query) {
                    $query->where('status', 'RECEIVED');
                })->exists();
        @endphp

        <div class="mb-8">
            @if($hasPendingReports)
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-bold">
                                Création de projet bloquée !
                            </p>
                            <p class="text-sm text-red-600 mt-1">
                                Vous avez reçu des fonds pour un ou plusieurs projets. Vous devez obligatoirement publier leur <a href="#projets" class="underline font-bold">Rapport d'Impact</a> avant de pouvoir lancer une nouvelle campagne de collecte.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('projects.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-medium shadow-sm inline-block">
                    + Créer un nouveau projet
                </a>
            @endif
        <!-- </div> -->

<h2 id="projets" class="text-xl font-semibold mb-3">Mes Projets</h2>            @if($projects->count() > 0)
                <ul class="list-disc pl-5">
                    @foreach($projects as $project)
                        <li class="mb-4 p-4 border rounded bg-gray-50">
                            <div class="flex justify-between items-center mb-2">
                                <strong>{{ $project->title }}</strong>
                                <span class="text-sm px-2 py-1 rounded {{ $project->status === 'OPEN' ? 'bg-green-100 text-green-800' : ($project->status === 'COMPLETED' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                    Statut: {{ $project->status }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-2">
                                Collecté : <strong>{{ $project->currentAmount }} DH</strong> sur {{ $project->goalAmount }} DH
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                Date de fin : <strong>{{ \Carbon\Carbon::parse($project->endDate)->format('d/m/Y') }}</strong>
                            </p>

                            @php
                                 $isExpired = \Carbon\Carbon::now()->greaterThan($project->endDate);
                                 $isFullyFunded = $project->currentAmount >= $project->goalAmount;
                            @endphp

                            @if($isExpired && !$isFullyFunded)
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-sm text-yellow-800 mb-2"> Le délai est expiré et l'objectif n'est pas atteint.</p>
                                    <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="date" name="newEndDate" required class="border-gray-300 rounded-md shadow-sm p-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                            Prolonger le délai
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if($project->status === 'COMPLETED')
                                @php
                                    $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
                                    $hasReceived = $project->donations()->where('status', 'RECEIVED')->exists();
                                    $hasReport = \App\Models\ImpactReport::where('project_id', $project->id)->exists();
                                @endphp

                                @if($hasReport)
                                    <div class="mt-3 p-3 bg-gray-100 border border-gray-300 rounded">
                                        <p class="text-sm text-gray-700 font-bold">Mission accomplie ! Rapport d'impact publié.</p>
                                    </div>
                                @elseif($hasReceived)
                                    <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-blue-800 font-bold"> Fonds reçus ! N'oubliez pas de publier le rapport d'impact.</p>
                                        <a href="{{ route('impact.create', $project->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Publier le rapport
                                        </a>
                                    </div>
                                @elseif($hasProcessing)
                                    <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                        <p class="text-sm text-yellow-800"> Demande de retrait en cours de traitement par l'administration.</p>
                                    </div>
                                @else
                                    <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-green-800"> Objectif atteint ! Vous pouvez retirer les fonds.</p>
                                        <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                                                Demander les fonds
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif

                        </li>
                    @endforeach
                </ul>
            @else
                <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun projet créé</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez créé aucun projet pour le moment.</p>
                    <p class="text-sm text-gray-400">Cliquez sur le bouton ci-dessus pour lancer votre première campagne de collecte !</p>
                </div>
            @endif
        @endif


    </div>

</body>
</html>
<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
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
              "primary-container": "#021c36",
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
              "secondary-container": "#feb700",
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
<!-- TopNavBar from JSON -->
<nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-xl shadow-sm dark:shadow-none">
<div class="flex justify-between items-center max-w-7xl mx-auto px-6 h-20">
<div class="text-2xl font-black tracking-tighter text-blue-950 dark:text-white">Al-Khair</div>
<div class="hidden md:flex items-center gap-8 font-['Manrope'] font-semibold text-sm tracking-tight">
<a class="text-slate-600 dark:text-slate-400 hover:text-blue-900 dark:hover:text-amber-200 transition-colors" href="#">Projets</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-blue-900 dark:hover:text-amber-200 transition-colors" href="#">Impact</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-blue-900 dark:hover:text-amber-200 transition-colors" href="#">Transparence</a>
<a class="text-slate-600 dark:text-slate-400 hover:text-blue-900 dark:hover:text-amber-200 transition-colors" href="#">Don</a>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:scale-[1.02] transition-transform" data-icon="search">search</span>
<span class="material-symbols-outlined text-on-surface-variant cursor-pointer hover:scale-[1.02] transition-transform" data-icon="language">language</span>
<button class="px-5 py-2.5 rounded-full bg-secondary-container text-on-secondary-container font-bold text-sm hover:scale-[1.02] transition-all active:scale-95">Faire un don</button>
<div class="flex items-center gap-2 px-4 py-2 bg-surface-container-low rounded-lg text-blue-900 dark:text-amber-400 border-b-2 border-amber-500 pb-1 cursor-pointer">
<span class="material-symbols-outlined" data-icon="account_circle">account_circle</span>
<span class="font-['Manrope'] font-semibold text-sm">Mon Compte</span>
</div>
</div>
</div>
<div class="bg-slate-100/50 dark:bg-slate-800/50 h-[1px] w-full"></div>
</nav>
<!-- Main Dashboard Content -->
<main class="pt-28 pb-20 max-w-7xl mx-auto px-6">
<!-- Header Section -->
<header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
<div class="space-y-2">
<span class="text-on-tertiary-container font-label text-[0.75rem] font-bold tracking-[0.05rem] uppercase px-3 py-1 bg-tertiary-fixed rounded-full">Dashboard Association</span>
<h1 class="text-4xl md:text-5xl font-extrabold text-primary-container tracking-tight">Vue d'ensemble</h1>
<p class="text-on-surface-variant max-w-xl text-lg">Bienvenue, Institution Al-Khair. Suivez l'évolution de vos collectes et l'impact de vos actions en temps réel.</p>
</div>
<div class="flex flex-wrap gap-3">
<button class="flex items-center gap-2 px-6 py-3 bg-primary-container text-on-primary rounded-full font-bold hover:scale-[1.02] transition-all active:scale-95">
<span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                    Créer un projet
                </button>
<button class="flex items-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container rounded-full font-bold hover:scale-[1.02] transition-all active:scale-95">
<span class="material-symbols-outlined" data-icon="verified">verified</span>
                    Publier une preuve d'impact
                </button>
</div>
</header>
<!-- Stats Grid (Editorial Layout) -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
<!-- Large Stat Card -->
<div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-outline-variant/10 relative overflow-hidden group">
<div class="relative z-10 flex flex-col h-full justify-between">
<div>
<div class="flex justify-between items-start mb-6">
<span class="p-3 bg-surface-container-low rounded-lg text-primary-container">
<span class="material-symbols-outlined text-3xl" data-icon="account_balance_wallet">account_balance_wallet</span>
</span>
<span class="text-green-600 flex items-center gap-1 font-bold text-sm bg-green-50 px-2 py-1 rounded">
<span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>
                                +12.4%
                            </span>
</div>
<p class="text-on-surface-variant font-medium">Montant total collecté</p>
<h2 class="text-5xl font-black text-primary-container mt-2">1 245 850 €</h2>
</div>
<div class="mt-8 flex gap-4 overflow-hidden grayscale opacity-30 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
<div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container w-[75%]"></div>
</div>
</div>
</div>
<!-- Subtle Decorative Element -->
<div class="absolute -right-12 -bottom-12 w-64 h-64 bg-primary-container/5 rounded-full blur-3xl"></div>
</div>
<!-- Smaller Stat Cards Stack -->
<div class="space-y-6">
<div class="bg-primary-container text-on-primary p-6 rounded-xl flex items-center justify-between">
<div>
<p class="text-on-primary/70 text-sm font-medium">Projets actifs</p>
<h3 class="text-3xl font-bold">24</h3>
</div>
<span class="material-symbols-outlined text-4xl opacity-50" data-icon="volunteer_activism">volunteer_activism</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex items-center justify-between border border-outline-variant/10">
<div>
<p class="text-on-surface-variant text-sm font-medium">Donateurs uniques</p>
<h3 class="text-3xl font-bold text-primary-container">8 432</h3>
</div>
<span class="material-symbols-outlined text-4xl text-on-primary-container" data-icon="groups">groups</span>
</div>
<div class="bg-surface-container-low p-6 rounded-xl flex items-center justify-between border border-outline-variant/10">
<div>
<p class="text-on-surface-variant text-sm font-medium">Preuves validées</p>
<h3 class="text-3xl font-bold text-primary-container">156</h3>
</div>
<span class="material-symbols-outlined text-4xl text-on-tertiary-container" data-icon="task_alt">task_alt</span>
</div>
</div>
</section>
<!-- Projects Section -->
<section class="mb-20">
<div class="flex items-center justify-between mb-8">
<h2 class="text-2xl font-bold text-primary-container">Suivi des Projets</h2>
<button class="text-primary-container font-semibold flex items-center gap-1 hover:underline">
                    Voir tout
                    <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
</button>
</div>
<!-- Bento Grid style for projects -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Project Card 1 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/5 hover:shadow-md transition-shadow">
<div class="h-48 relative overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Children receiving educational supplies in a classroom setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBdw7MYQOg2-CSFkz3Wnp4ZEC72w6lJjzgb9YzGsmZCLevsH3Flyp08CE_l1PFV8QcXG8z1rGvBF1WaxiPTymAp29OeMEFmEb1YydQmmiVosVgBFB1KXldesfW2vFfvYlpuC-Stma7LFglMz2TRNOCgSGo4dhBbAyna43ndFw6fTzxuxzqTrqv6wF5Hf2ADKMwJPC09CFqU7r52STHIUclawTbjtSrtEm_6gq1jF772niiNsR9Gc_VdcL71hlR2Xkp3LLue-i-qXgY"/>
<div class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container text-[0.65rem] font-bold px-2 py-1 rounded uppercase tracking-wider">Urgent</div>
</div>
<div class="p-6">
<h3 class="text-xl font-bold text-primary-container mb-2">Éducation pour tous : Nord-Kivu</h3>
<p class="text-on-surface-variant text-sm line-clamp-2 mb-6">Fourniture de kits scolaires et reconstruction de 3 salles de classe pour 250 enfants déplacés.</p>
<div class="space-y-2">
<div class="flex justify-between text-[0.75rem] font-bold font-label uppercase text-on-surface-variant">
<span>12 450 € collectés</span>
<span>80%</span>
</div>
<div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container w-[80%]"></div>
</div>
<div class="flex justify-between text-[0.7rem] text-on-surface-variant/70">
<span>Objectif : 15 000 €</span>
<span>12 jours restants</span>
</div>
</div>
</div>
</div>
<!-- Project Card 2 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/5 hover:shadow-md transition-shadow">
<div class="h-48 relative overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Community gathered around a new clean water well in a rural village" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2tFuJ6TjkdaVBgfrpOyTSVrLelTm7XujTdG3GwsnrdYnBBUS0Jj98i2gIHQzxIouz3UiYluDt1TprtVve9FxrY7G9jFdeFNBLVIsBAyujVdrwbwTugddvH5vMheSiyHxNkQrSpjwgXXYixy_6CdveHaUwe19xOnIvqFEkUu5XaZ-y55EwVb53T_VX3eg63iIyNxkyHIuAzRi9PiIIXd4CCAhVjd_Vk5leKWvuTeW8_ZdLAfG8PcEfkqJTPkKfL7_bCYGY_PyjhaE"/>
<div class="absolute top-4 right-4 bg-surface-container-highest text-on-surface-variant text-[0.65rem] font-bold px-2 py-1 rounded uppercase tracking-wider">Vérifié</div>
</div>
<div class="p-6">
<h3 class="text-xl font-bold text-primary-container mb-2">Puits de Vie : Commune de Sadio</h3>
<p class="text-on-surface-variant text-sm line-clamp-2 mb-6">Installation de deux puits solaires pour garantir un accès permanent à l'eau potable.</p>
<div class="space-y-2">
<div class="flex justify-between text-[0.75rem] font-bold font-label uppercase text-on-surface-variant">
<span>4 120 € collectés</span>
<span>45%</span>
</div>
<div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container w-[45%]"></div>
</div>
<div class="flex justify-between text-[0.7rem] text-on-surface-variant/70">
<span>Objectif : 9 000 €</span>
<span>28 jours restants</span>
</div>
</div>
</div>
</div>
<!-- Project Card 3 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/5 hover:shadow-md transition-shadow">
<div class="h-48 relative overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Medical professional providing care at a mobile health clinic" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0vSfP4Cmd2_B8ORjm2h5Ru0_umv4jDewRIaO27uva2s9Ty41jFerUtrljZtPvQ54XPC20oNNuT3ByOu8Lbd-hApTdTMtSrW2jpZdBDynlaGP_IgBPUfp5TnrXRogMOw8JRiD9YvwKr7-4SlkzDCB4EFI6xokFLLsWdtLe8DVTgA8bRBFt8tvMnT_tVM-qy5mTcoywwr1_fAH4dI0ygiWaWkLE0G_co0vlYxwTx5_qeRGGXyxlTd6TVGYVAwQ7hYJdnmqrnrnWHQk"/>
<div class="absolute top-4 right-4 bg-tertiary-container text-on-tertiary-container text-[0.65rem] font-bold px-2 py-1 rounded uppercase tracking-wider">Urgent</div>
</div>
<div class="p-6">
<h3 class="text-xl font-bold text-primary-container mb-2">Clinique Mobile : Désert du Thar</h3>
<p class="text-on-surface-variant text-sm line-clamp-2 mb-6">Financement d'une unité médicale mobile pour les soins pédiatriques d'urgence.</p>
<div class="space-y-2">
<div class="flex justify-between text-[0.75rem] font-bold font-label uppercase text-on-surface-variant">
<span>22 900 € collectés</span>
<span>92%</span>
</div>
<div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container w-[92%]"></div>
</div>
<div class="flex justify-between text-[0.7rem] text-on-surface-variant/70">
<span>Objectif : 25 000 €</span>
<span>3 jours restants</span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Recent Activities & Impact Feed -->
<section class="grid grid-cols-1 lg:grid-cols-3 gap-12">
<div class="lg:col-span-2 space-y-8">
<h2 class="text-2xl font-bold text-primary-container">Dernières Activités</h2>
<div class="bg-surface-container-low rounded-2xl p-8">
<div class="space-y-8">
<!-- Activity Item -->
<div class="flex gap-6">
<div class="flex-shrink-0 w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container" data-icon="history_edu">history_edu</span>
</div>
<div>
<h4 class="font-bold text-primary-container">Preuve d'impact soumise</h4>
<p class="text-on-surface-variant text-sm mt-1">L'étape "Fondations terminées" pour le projet <span class="text-secondary font-semibold">Puits de Vie</span> a été envoyée pour validation.</p>
<span class="text-[0.7rem] text-on-surface-variant/60 mt-2 block italic">Il y a 2 heures</span>
</div>
</div>
<!-- Activity Item -->
<div class="flex gap-6">
<div class="flex-shrink-0 w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-secondary-container" data-icon="payments">payments</span>
</div>
<div>
<h4 class="font-bold text-primary-container">Don majeur reçu</h4>
<p class="text-on-surface-variant text-sm mt-1">Un don de 2 500 € a été effectué anonymement pour la <span class="text-secondary font-semibold">Clinique Mobile</span>.</p>
<span class="text-[0.7rem] text-on-surface-variant/60 mt-2 block italic">Il y a 5 heures</span>
</div>
</div>
<!-- Activity Item -->
<div class="flex gap-6">
<div class="flex-shrink-0 w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container" data-icon="campaign">campaign</span>
</div>
<div>
<h4 class="font-bold text-primary-container">Nouvelle campagne publiée</h4>
<p class="text-on-surface-variant text-sm mt-1">Le projet <span class="text-secondary font-semibold">Éducation pour tous</span> est désormais en ligne et accepte les dons.</p>
<span class="text-[0.7rem] text-on-surface-variant/60 mt-2 block italic">Hier, à 18:45</span>
</div>
</div>
</div>
</div>
</div>
<!-- Impact Sidebar -->
<div class="space-y-8">
<h2 class="text-2xl font-bold text-primary-container">Impact Global</h2>
<div class="bg-primary-container text-on-primary p-8 rounded-2xl relative overflow-hidden">
<div class="relative z-10">
<p class="text-on-primary/60 font-label text-[0.7rem] uppercase tracking-widest mb-6">Indicateurs clés</p>
<div class="space-y-6">
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary-container" data-icon="child_care">child_care</span>
<div>
<p class="text-2xl font-bold">12k+</p>
<p class="text-xs text-on-primary/70">Enfants scolarisés</p>
</div>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary-container" data-icon="water_drop">water_drop</span>
<div>
<p class="text-2xl font-bold">450k</p>
<p class="text-xs text-on-primary/70">Litres d'eau fournis/jour</p>
</div>
</div>
<div class="flex items-center gap-4">
<span class="material-symbols-outlined text-secondary-container" data-icon="health_and_safety">health_and_safety</span>
<div>
<p class="text-2xl font-bold">85</p>
<p class="text-xs text-on-primary/70">Centres médicaux soutenus</p>
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
<!-- Footer from JSON -->
<footer class="bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12">
<div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto px-6 font-['Inter'] text-sm leading-relaxed text-blue-950 dark:text-blue-100">
<div>
<span class="text-xl font-bold text-blue-900 dark:text-white mb-4 block">Al-Khair</span>
<p class="text-slate-500 dark:text-slate-400">Institution humanitaire engagée pour la transparence et l'action directe.</p>
</div>
<div>
<h4 class="font-bold mb-4">Navigation</h4>
<div class="flex flex-col gap-2">
<a class="text-slate-500 dark:text-slate-400 hover:text-blue-700 dark:hover:text-amber-200 hover:underline transition-all" href="#">Mentions Légales</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-blue-700 dark:hover:text-amber-200 hover:underline transition-all" href="#">Confidentialité</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-blue-700 dark:hover:text-amber-200 hover:underline transition-all" href="#">Recrutement</a>
</div>
</div>
<div>
<h4 class="font-bold mb-4">Aide</h4>
<div class="flex flex-col gap-2">
<a class="text-slate-500 dark:text-slate-400 hover:text-blue-700 dark:hover:text-amber-200 hover:underline transition-all" href="#">Contact</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-blue-700 dark:hover:text-amber-200 hover:underline transition-all" href="#">FAQ</a>
</div>
</div>
<div>
<h4 class="font-bold mb-4">Newsletter</h4>
<p class="text-slate-500 dark:text-slate-400 mb-4">Restez informé de nos derniers impacts.</p>
<div class="flex gap-2">
<input class="bg-white dark:bg-slate-800 border-none rounded-lg text-sm flex-1 focus:ring-amber-500" placeholder="votre@email.com" type="email"/>
<button class="bg-blue-900 text-white p-2 rounded-lg">
<span class="material-symbols-outlined" data-icon="send">send</span>
</button>
</div>
</div>
</div>
<div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex justify-between items-center text-slate-500 dark:text-slate-400">
<p>© 2024 Al-Khair Institution. Tous droits réservés.</p>
<div class="flex gap-4">
<span class="material-symbols-outlined cursor-pointer" data-icon="facebook">social_leaderboard</span>
<span class="material-symbols-outlined cursor-pointer" data-icon="x">crossword</span>
<span class="material-symbols-outlined cursor-pointer" data-icon="linked_camera">linked_camera</span>
</div>
</div>
</footer>
</body></html>