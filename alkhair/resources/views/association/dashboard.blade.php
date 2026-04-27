<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Espace Association | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .neu-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(.4,0,.2,1); }
        .neu-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 20px 48px rgba(0,0,0,0.1); transform: translateY(-4px); }
        .glass-sidebar { background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-right: 1px solid rgba(0,0,0,0.06); }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        @keyframes countUp { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform: translateY(0); } }
        @keyframes fadeSlide { from { opacity:0; transform: translateX(-12px); } to { opacity:1; transform: translateX(0); } }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .animate-count { animation: countUp 0.8s ease-out backwards; }
        .animate-slide { animation: fadeSlide 0.5s ease-out backwards; }
        .stat-icon { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; transition: transform 0.3s; }
        .neu-card:hover .stat-icon { transform: scale(1.12) rotate(-4deg); }
        .sidebar-link { transition: all 0.25s ease; border-radius: 14px; }
        .sidebar-link:hover { background: rgba(10,17,40,0.04); }
        .sidebar-link.active { background: linear-gradient(135deg, #0A1128, #1a2744); color: #fff; box-shadow: 0 4px 16px rgba(10,17,40,0.3); }
        .progress-bar { background: linear-gradient(90deg, #F5A623 0%, #FFD085 50%, #F5A623 100%); background-size: 200% 100%; animation: shimmer 2s infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white min-h-screen flex">

<!-- Sidebar -->
<aside class="h-screen w-72 fixed left-0 top-0 z-50 glass-sidebar flex flex-col p-6">
    <div class="mb-10">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4 group">
            <div class="w-12 h-12">
                <x-application-logo class="w-12 h-12 group-hover:scale-105 transition-transform" />
            </div>
        </a>
    </div>

    <nav class="flex-grow space-y-2">
        <a href="{{ route('association.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('association.dashboard') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('association.dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            <span class="text-sm font-semibold">Vue d'ensemble</span>
        </a>
        <a href="{{ route('association.dashboard') }}#projets" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">folder_open</span>
            <span class="text-sm font-semibold">Mes Projets</span>
        </a>
        <a href="{{ route('association.projects.expired') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('association.projects.expired') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('association.projects.expired') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">hourglass_empty</span>
            <span class="text-sm font-semibold">Projets Expirés</span>
        </a>
        <a href="{{ route('impact.create') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">verified</span>
            <span class="text-sm font-semibold">Preuves d'impact</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50">
        <a href="{{ route('association.profile') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 mb-2 {{ request()->routeIs('association.profile') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('association.profile') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">manage_accounts</span>
            <span class="text-sm font-semibold">Mon Profil</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-500/10 font-bold text-sm transition-all rounded-xl group">
                <span class="material-symbols-outlined text-xl">logout</span>
                Déconnexion
            </button>
        </form>
    </div>

    <div class="mt-auto p-5 bg-gradient-to-br from-[#0A1128] to-[#1a2744] text-white rounded-2xl text-xs shadow-xl border border-[#F5A623]/10">
        <div class="flex items-center gap-3 mb-3">
            @if($association->profilePhoto)
                <img src="{{ asset('storage/' . str_replace(' ', '%20', $association->profilePhoto)) }}" alt="{{ $association->name }}" class="w-12 h-12 rounded-xl object-contain bg-white/10 p-1 border-2 border-[#F5A623]/30" onerror="this.onerror=null; this.src='{{ asset('images/default-logo.png') }}'; this.classList.add('hidden');">
            @else
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#F5A623] to-[#FFD085] flex items-center justify-center font-black text-[#0A1128] text-lg">
                    {{ strtoupper(substr($association->name, 0, 2)) }}
                </div>
            @endif
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <span class="font-bold text-white/90 text-xs">Statut</span>
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full {{ $association->status === 'ACTIVE' ? 'bg-emerald-400 animate-pulse' : 'bg-amber-400' }}"></div>
                        <span class="{{ $association->status === 'ACTIVE' ? 'text-emerald-400' : 'text-amber-400' }} font-bold text-xs">
                            {{ $association->status === 'ACTIVE' ? 'Vérifié' : 'En attente' }}
                        </span>
                    </div>
                </div>
                <div class="text-[10px] text-white/40 truncate">{{ $association->name }}</div>
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-72 flex-grow min-h-screen relative">
    <!-- Header -->
    <header class="fixed right-0 top-0 z-40 bg-white/70 backdrop-blur-2xl border-b border-black/[0.04] flex justify-between items-center px-8 py-4" style="width: calc(100% - 18rem);">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Espace Association</h2>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ $association->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Association</p>
                </div>
                @if($association->profilePhoto)
                    <img src="{{ asset('storage/' . str_replace(' ', '%20', $association->profilePhoto)) }}" alt="{{ $association->name }}" class="h-10 w-10 rounded-xl object-contain bg-white p-1 shadow-lg border-2 border-[#F5A623]/20" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20" style="display:none;">
                        <span class="material-symbols-outlined text-[20px]">building</span>
                    </div>
                @else
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20">
                        <span class="material-symbols-outlined text-[20px]">building</span>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <div class="pt-24 pb-20 px-8 max-w-7xl mx-auto space-y-10">

        <!-- Status Alerts -->
        @if($association->status === 'PENDING')
            <div class="neu-card p-6 border-l-4 border-[#F5A623] flex items-start gap-4 reveal active">
                <span class="material-symbols-outlined text-[#F5A623] text-3xl">pending_actions</span>
                <div>
                    <strong class="block text-lg font-black text-[#0A1128] mb-1">Compte en cours de vérification</strong>
                    <p class="text-sm text-slate-500">L'administration vérifie actuellement vos documents KYC. Vous pourrez créer des projets dès la validation.</p>
                </div>
            </div>
        @elseif($association->status === 'ACTIVE')
            @if(session('success'))
                <div class="neu-card p-5 border-l-4 border-emerald-500 flex items-center gap-4 reveal active">
                    <span class="material-symbols-outlined text-emerald-500 text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-bold text-sm text-emerald-700">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="neu-card p-5 border-l-4 border-red-500 flex items-center gap-4 reveal active">
                    <span class="material-symbols-outlined text-red-500 text-2xl">error</span>
                    <span class="font-bold text-sm text-red-700">{{ session('error') }}</span>
                </div>
            @endif
        @endif

        <section class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal active">
            <div>
                <p class="text-sm font-bold text-[#F5A623] uppercase tracking-widest mb-1">Bienvenue</p>
                <h2 class="text-3xl font-black text-[#0A1128] tracking-tight">Tableau de bord</h2>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('impact.create') }}" class="bg-white text-[#0A1128] border border-slate-200 px-5 py-2.5 rounded-xl font-bold hover:bg-slate-50 transition-all flex items-center gap-2 text-xs uppercase tracking-wider shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    Publier un impact
                </a>

                @if(!$hasPendingReports && !$hasCompletedWithoutReport && !$hasActiveProject && $association->status === 'ACTIVE')
                    <button onclick="window.location.href='{{ route('projects.create') }}'" class="bg-[#0A1128] text-white px-5 py-2.5 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all flex items-center gap-2 text-xs uppercase tracking-wider shadow-md">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        Nouveau Projet
                    </button>
                @elseif($hasActiveProject)
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 text-xs">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                        Projet actif en cours
                    </div>
                @elseif($hasPendingReports || $hasCompletedWithoutReport)
                    <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-2.5 rounded-xl font-bold flex items-center gap-2 text-xs">
                        <span class="material-symbols-outlined text-[18px]">warning</span>
                        Rapport d'impact requis
                    </div>
                @endif
            </div>
        </section>

        <!-- Alerts Section -->
        @if($hasPendingReports && $association->status === 'ACTIVE')
            <div class="neu-card border-l-4 border-red-500 p-6 flex items-start gap-4 reveal active">
                <span class="material-symbols-outlined text-red-500 text-3xl">warning</span>
                <div>
                    <h3 class="text-red-600 font-black text-lg mb-1">Création de projet bloquée - Fonds reçus</h3>
                    <p class="text-sm text-slate-600">Vous avez reçu des fonds pour un ou plusieurs projets terminés. Par souci de transparence, vous devez obligatoirement publier le <strong>Rapport d'Impact</strong> de ces projets avant de pouvoir lancer une nouvelle campagne.</p>
                </div>
            </div>
        @elseif($hasCompletedWithoutReport && $association->status === 'ACTIVE')
            <div class="neu-card border-l-4 border-red-500 p-6 flex items-start gap-4 reveal active">
                <span class="material-symbols-outlined text-red-500 text-3xl">warning</span>
                <div>
                    <h3 class="text-red-600 font-black text-lg mb-1">Création de projet bloquée - Rapport manquant</h3>
                    <p class="text-sm text-slate-600">Vous avez un projet complété sans rapport d'impact. Vous devez <strong>publier le rapport d'impact</strong> de ce projet avant de créer un nouveau projet.</p>
                    <a href="{{ route('impact.create') }}" class="inline-flex items-center gap-2 mt-3 bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-700 transition-all">
                        <span class="material-symbols-outlined text-[16px]">add</span>
                        Publier le rapport maintenant
                    </a>
                </div>
            </div>
        @elseif($hasActiveProject && $association->status === 'ACTIVE')
            <div class="neu-card border-l-4 border-amber-500 p-6 flex items-start gap-4 reveal active">
                <span class="material-symbols-outlined text-amber-500 text-3xl">info</span>
                <div>
                    <h3 class="text-amber-600 font-black text-lg mb-1">Projet actif en cours</h3>
                    <p class="text-sm text-slate-600">Vous avez déjà un projet actif. Pour garantir une meilleure gestion et concentration des efforts, vous devez <strong>terminer ou clôturer votre projet actuel</strong> avant d'en créer un nouveau.</p>
                </div>
            </div>
        @endif

        <!-- Stats Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 reveal">
            <!-- Main Stats Card -->
            <div class="md:col-span-2 bg-gradient-to-br from-[#0A1128] to-[#162040] rounded-3xl p-8 text-white shadow-xl relative overflow-hidden group">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <div class="p-2.5 bg-white/10 rounded-xl backdrop-blur-sm">
                                <span class="material-symbols-outlined text-[#F5A623] text-3xl" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                            </div>
                            <span class="text-[10px] font-bold text-[#0A1128] bg-[#F5A623] px-3 py-1 rounded-full uppercase tracking-widest shadow-md">Montant Total</span>
                        </div>
                        <p class="text-[10px] text-white/50 uppercase tracking-[0.15em] font-bold mb-2">Fonds Totaux Collectés</p>
                        <h2 class="text-5xl md:text-6xl font-black drop-shadow-lg animate-count">
                            {{ number_format($association->projects()->sum('currentAmount'), 0, ',', ' ') }}
                            <span class="text-2xl text-[#F5A623]">DH</span>
                        </h2>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#F5A623]/10 rounded-full blur-3xl group-hover:bg-[#F5A623]/20 transition-colors duration-700"></div>
            </div>

            <!-- Side Stats -->
            <div class="space-y-6">
                <!-- Active Projects -->
                <div class="neu-card p-6 flex items-center justify-between group" style="animation-delay: 0.1s">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Projets Actifs</p>
                        <h3 class="text-3xl font-black text-[#0A1128] animate-count">{{ $association->projects()->where('status', 'OPEN')->count() }}</h3>
                    </div>
                    <div class="stat-icon bg-blue-50 border border-blue-100">
                        <span class="material-symbols-outlined text-2xl text-blue-600" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                    </div>
                </div>

                <!-- Unique Donors -->
                <div class="neu-card p-6 flex items-center justify-between group" style="animation-delay: 0.2s">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Donateurs Uniques</p>
                        <h3 class="text-3xl font-black text-[#0A1128] animate-count">{{ \App\Models\Donation::whereHas('project', function($q) use ($association) { $q->where('association_id', $association->id); })->distinct('donator_id')->count() }}</h3>
                    </div>
                    <div class="stat-icon bg-emerald-50 border border-emerald-100">
                        <span class="material-symbols-outlined text-2xl text-emerald-600" style="font-variation-settings: 'FILL' 1;">groups</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Management Section -->
        <section id="projets" class="reveal">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-black text-[#0A1128]">Gestion des Projets</h2>
                    <p class="text-slate-500 text-sm mt-1">Administrez et suivez vos campagnes de collecte</p>
                </div>
            </div>

            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        @php
                            $isExpired = \Carbon\Carbon::now()->greaterThan($project->endDate);
                            $isFullyFunded = $project->currentAmount >= $project->goalAmount;
                            $hasProcessing = $project->donations->where('status', 'PROCESSING')->isNotEmpty();
                            $hasReceived = $project->donations->where('status', 'RECEIVED')->isNotEmpty();
                            $hasReport = $project->impactReport !== null;
                            $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                            $percentage = min($percentage, 100);
                        @endphp

                        <div class="neu-card overflow-hidden flex flex-col group animate-fade-in">
                            <!-- Project Image -->
                            <div class="h-48 relative overflow-hidden bg-slate-100">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . str_replace(' ', '%20', $project->image)) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $project->title }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20 items-center justify-center" style="display:none;">
                                        <span class="material-symbols-outlined text-6xl text-[#0A1128]/30">image</span>
                                    </div>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-6xl text-[#0A1128]/30">image</span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4 text-[10px] font-black px-3 py-1.5 rounded-lg uppercase tracking-wider shadow-sm backdrop-blur-md {{ $project->status === 'OPEN' ? 'bg-white/90 text-[#0A1128]' : ($project->status === 'COMPLETED' ? 'bg-emerald-500/90 text-white' : 'bg-slate-200/90 text-slate-700') }}">
                                    {{ $project->status === 'OPEN' ? 'Actif' : ($project->status === 'COMPLETED' ? 'Complété' : 'Suspendu') }}
                                </div>
                            </div>

                            <!-- Project Content -->
                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-black text-[#0A1128] mb-2 line-clamp-1 group-hover:text-[#F5A623] transition-colors">{{ $project->title }}</h3>
                                    <p class="text-xs text-slate-500 line-clamp-2 mb-5 leading-relaxed">{{ $project->description }}</p>
                                </div>

                                <!-- Progress Section -->
                                <div class="space-y-2 mb-6 bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <div class="flex justify-between text-[10px] font-black uppercase text-[#0A1128] tracking-wider mb-1">
                                        <span class="text-sm">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span class="text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                                    </div>
                                    <div class="h-2 w-full bg-[#e8ecf3] rounded-full overflow-hidden">
                                        <div class="h-full progress-bar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-[10px] text-slate-500 font-bold mt-2">
                                        <span>Objectif: <strong class="text-[#0A1128]">{{ number_format($project->goalAmount, 0, ',', ' ') }} DH</strong></span>
                                        <span>Fin: <strong class="text-[#0A1128]">{{ \Carbon\Carbon::parse($project->endDate)->format('d M Y') }}</strong></span>
                                    </div>
                                </div>

                                <!-- Action Section -->
                                <div class="mt-auto pt-4 border-t border-slate-100 space-y-3">
                                    @if($isExpired && !$isFullyFunded && $project->status === 'OPEN')
                                        <div class="bg-amber-50 border border-amber-100 p-4 rounded-xl">
                                            <p class="text-xs text-amber-800 font-bold mb-3 flex items-center gap-1.5">
                                                <span class="material-symbols-outlined text-[16px]">warning</span>
                                                Délai expiré. Prolongez la collecte.
                                            </p>
                                            <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <input type="date" name="newEndDate" required class="bg-white border border-amber-200 rounded-lg p-2 text-xs focus:ring-2 focus:ring-[#F5A623] flex-1 outline-none">
                                                <button type="submit" class="bg-[#0A1128] text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-sm">
                                                    Prolonger
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($project->status === 'CLOSED' && $project->currentAmount > 0)
                                        @if($hasProcessing)
                                            <div class="bg-blue-50 p-3 rounded-xl flex items-center gap-2 text-blue-700 border border-blue-100">
                                                <span class="material-symbols-outlined text-blue-500 animate-spin text-lg">hourglass_top</span>
                                                <span class="text-xs font-bold">Transfert des fonds en cours...</span>
                                            </div>
                                        @elseif($hasReceived)
                                            <div class="bg-red-50 border border-red-100 p-3.5 rounded-xl flex justify-between items-center gap-2">
                                                <span class="text-[10px] text-red-700 font-black uppercase">Fonds reçus !</span>
                                                <a href="{{ route('impact.create', $project->id) }}" class="bg-[#0A1128] text-white px-3 py-2 rounded-lg text-[10px] font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all whitespace-nowrap shadow-sm uppercase tracking-wider">
                                                    Publier rapport
                                                </a>
                                            </div>
                                        @else
                                            <div class="bg-orange-50 border border-orange-100 p-3.5 rounded-xl flex justify-between items-center gap-2">
                                                <span class="text-[10px] text-orange-700 font-black uppercase">⏰ Projet expiré</span>
                                                <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-orange-600 text-white px-3 py-2 rounded-lg text-[10px] font-bold hover:bg-orange-700 transition-all shadow-sm uppercase tracking-wider">
                                                        Clôturer & Retirer
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @elseif($project->status === 'COMPLETED')
                                        @if($hasReport)
                                            <div class="bg-emerald-50 p-3 rounded-xl flex items-center gap-2 text-emerald-700 border border-emerald-100">
                                                <span class="material-symbols-outlined text-emerald-600 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                                <span class="text-xs font-bold">Rapport d'impact publié</span>
                                            </div>
                                        @elseif($hasReceived)
                                            <div class="bg-red-50 border border-red-100 p-3.5 rounded-xl flex justify-between items-center gap-2">
                                                <span class="text-[10px] text-red-700 font-black uppercase">Fonds reçus !</span>
                                                <a href="{{ route('impact.create', $project->id) }}" class="bg-[#0A1128] text-white px-3 py-2 rounded-lg text-[10px] font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all whitespace-nowrap shadow-sm uppercase tracking-wider">
                                                    Publier rapport
                                                </a>
                                            </div>
                                        @elseif($hasProcessing)
                                            <div class="bg-blue-50 p-3 rounded-xl flex items-center gap-2 text-blue-700 border border-blue-100">
                                                <span class="material-symbols-outlined text-blue-500 animate-spin text-lg">hourglass_top</span>
                                                <span class="text-xs font-bold">Transfert des fonds en cours...</span>
                                            </div>
                                        @else
                                            <div class="bg-emerald-50 border border-emerald-100 p-3.5 rounded-xl flex justify-between items-center gap-2">
                                                <span class="text-[10px] text-emerald-700 font-black uppercase">✓ Objectif atteint</span>
                                                <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-emerald-600 text-white px-3 py-2 rounded-lg text-[10px] font-bold hover:bg-emerald-700 transition-all shadow-sm uppercase tracking-wider">
                                                        Retirer les fonds
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @else
                                        <div class="flex gap-2">
                                            <a href="{{ route('projects.show', $project->id) }}" class="flex-1 text-center py-2.5 bg-slate-100 text-[#0A1128] text-[10px] font-bold rounded-xl hover:bg-slate-200 transition-colors uppercase tracking-wider">Aperçu</a>
                                            <a href="{{ route('projects.edit', $project->id) }}" class="flex-1 text-center py-2.5 bg-white border border-slate-200 text-slate-600 text-[10px] font-bold rounded-xl hover:bg-slate-50 transition-colors uppercase tracking-wider shadow-sm">Modifier</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="neu-card p-16 text-center border-2 border-dashed border-slate-200 reveal">
                    <div class="w-20 h-20 mx-auto bg-amber-50 rounded-3xl flex items-center justify-center mb-6 border border-amber-100">
                        <span class="material-symbols-outlined text-4xl text-[#F5A623]">folder_off</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-3">Aucun projet créé</h3>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto text-sm">Commencez votre première campagne de collecte de fonds et impactez les communautés.</p>
                    @if($association->status === 'ACTIVE' && !$hasPendingReports && !$hasCompletedWithoutReport && !$hasActiveProject)
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 bg-[#0A1128] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all text-sm shadow-md">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Créer un projet
                        </a>
                    @endif
                </div>
            @endif
        </section>

        <!-- Activities and Summary Section -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="activites">
            <!-- Recent Activities -->
            <div class="lg:col-span-2 space-y-6 reveal">
                <div>
                    <h2 class="text-2xl font-black text-[#0A1128]">Activités Récentes</h2>
                    <p class="text-slate-500 text-sm mt-1">Derniers mouvements de vos collectes</p>
                </div>
                <div class="neu-card p-6">
                    <div class="space-y-4">
                        @php
                            $recentDonations = \App\Models\Donation::with('project')
                                ->whereHas('project', function($q) use ($association) {
                                    $q->where('association_id', $association->id);
                                })
                                ->orderByDesc('created_at')
                                ->limit(4)
                                ->get();
                        @endphp

                        @forelse($recentDonations as $donation)
                            <div class="flex gap-4 items-start p-3 hover:bg-slate-50 rounded-xl transition-colors animate-slide">
                                <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                                    <span class="material-symbols-outlined text-[#F5A623] text-xl">payments</span>
                                </div>
                                <div class="flex-grow border-b border-slate-100 pb-3">
                                    <h4 class="font-black text-[#0A1128] text-sm">Nouveau don reçu</h4>
                                    <p class="text-slate-500 text-xs mt-1 leading-relaxed">Un don de <span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded font-bold text-[10px]">{{ number_format($donation->amount, 0) }} DH</span> a été effectué pour <strong class="text-[#0A1128]">"{{ $donation->project->title }}"</strong>.</p>
                                    <span class="text-[10px] text-slate-400 font-bold mt-2 block uppercase tracking-wider">{{ $donation->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <span class="material-symbols-outlined text-4xl text-slate-300 mb-3 block">inbox</span>
                                <p class="text-slate-500 font-bold text-sm">Aucune activité récente pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Global Summary -->
            <div class="space-y-6 reveal" style="animation-delay: 0.2s">
                <div>
                    <h2 class="text-2xl font-black text-[#0A1128]">Bilan Global</h2>
                    <p class="text-slate-500 text-sm mt-1">Vos statistiques globales</p>
                </div>
                <div class="bg-gradient-to-br from-[#0A1128] to-[#1a2744] text-white p-8 rounded-3xl relative overflow-hidden shadow-xl">
                    <div class="relative z-10 space-y-5">
                        <!-- Reports Count -->
                        <div class="flex items-center gap-4 p-4 bg-white/10 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[#F5A623] text-3xl flex-shrink-0">task_alt</span>
                            <div>
                                <p class="text-2xl font-black text-white animate-count">{{ \App\Models\ImpactReport::whereHas('project', function($q) use ($association) { $q->where('association_id', $association->id); })->count() }}</p>
                                <p class="text-[10px] text-white/50 uppercase tracking-widest font-bold mt-0.5">Rapports publiés</p>
                            </div>
                        </div>

                        <!-- Completed Projects Count -->
                        <div class="flex items-center gap-4 p-4 bg-white/10 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[#F5A623] text-3xl flex-shrink-0">volunteer_activism</span>
                            <div>
                                <p class="text-2xl font-black text-white animate-count">{{ $projects->where('status', 'COMPLETED')->count() }}</p>
                                <p class="text-[10px] text-white/50 uppercase tracking-widest font-bold mt-0.5">Projets complétés</p>
                            </div>
                        </div>

                        <!-- Total Donors -->
                        <div class="flex items-center gap-4 p-4 bg-white/10 rounded-2xl border border-white/10 backdrop-blur-sm">
                            <span class="material-symbols-outlined text-[#F5A623] text-3xl flex-shrink-0">groups</span>
                            <div>
                                <p class="text-2xl font-black text-white animate-count">{{ \App\Models\Donation::whereHas('project', function($q) use ($association) { $q->where('association_id', $association->id); })->distinct('donator_id')->count() }}</p>
                                <p class="text-[10px] text-white/50 uppercase tracking-widest font-bold mt-0.5">Donateurs uniques</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-10 -bottom-10 opacity-5">
                        <span class="material-symbols-outlined text-[150px] text-white">public</span>
                    </div>
                </div>
            </div>
        </section>

    </div>
</main>

<script>
// Scroll reveal animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
});
</script>

</body>
</html>
