<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tableau de Bord Admin | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        .progress-ring { background: conic-gradient(#F5A623 var(--progress), #e5e7eb var(--progress)); border-radius: 50%; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white">

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
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('admin.dashboard') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">dashboard</span>
            <span class="text-sm font-semibold">Tableau de Bord</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('admin.categories.*') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('admin.categories.*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">category</span>
            <span class="text-sm font-semibold">Catégories</span>
        </a>
        <a href="{{ route('admin.validations') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('admin.validations') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('admin.validations') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">fact_check</span>
            <span class="text-sm font-semibold">Validations KYC</span>
            @if($pendingAssociations->count() > 0)<span class="ml-auto w-5 h-5 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center">{{ $pendingAssociations->count() }}</span>@endif
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 {{ request()->routeIs('admin.users') ? 'active' : 'text-slate-600' }}">
            <span class="material-symbols-outlined text-xl" style="{{ request()->routeIs('admin.users') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">group</span>
            <span class="text-sm font-semibold">Utilisateurs</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-white/20">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-500/10 font-bold text-sm transition-all rounded-xl group">
                <span class="material-symbols-outlined text-xl">logout</span>
                Déconnexion
            </button>
        </form>
    </div>

    <div class="mt-auto p-5 bg-gradient-to-br from-[#0A1128] to-[#1a2744] text-white rounded-2xl text-xs shadow-xl border border-[#F5A623]/10">
        <div class="flex items-center justify-between mb-3">
            <span class="font-bold text-white/90">Système</span>
            <div class="flex items-center gap-1.5"><div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div><span class="text-emerald-400 font-bold">En ligne</span></div>
        </div>
        <div class="text-[10px] text-white/40">v2.0 · Laravel 11 · {{ now()->format('d M Y') }}</div>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-72 min-h-screen relative">
    <!-- Header -->
    <header class="fixed right-0 top-0 z-40 bg-white/70 backdrop-blur-2xl border-b border-black/[0.04] flex justify-between items-center px-8 py-4" style="width: calc(100% - 18rem);">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Tableau de Bord</h2>
            <span class="hidden sm:inline px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full uppercase tracking-wider border border-emerald-200">● En direct</span>
        </div>
        <div class="flex items-center gap-5">
            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2 rounded-xl hover:bg-slate-100 transition-colors">
                    <span class="material-symbols-outlined text-slate-500">notifications</span>
                    @if($pendingAssociations->count() + $pendingDonationsCount > 0)
                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[8px] font-black rounded-full flex items-center justify-center">{{ $pendingAssociations->count() + $pendingDonationsCount }}</span>
                    @endif
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-50">
                    <div class="p-4 border-b border-slate-100 bg-gradient-to-r from-[#0A1128] to-[#1a2744] text-white">
                        <h3 class="font-bold text-sm">Notifications</h3>
                        <p class="text-[10px] text-white/70 mt-0.5">{{ $pendingAssociations->count() + $pendingDonationsCount }} en attente</p>
                    </div>
                    
                    <div class="max-h-96 overflow-y-auto">
                        @if($pendingAssociations->count() > 0)
                            <div class="p-3 border-b border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Associations KYC</p>
                                @foreach($pendingAssociations->take(3) as $assoc)
                                    <a href="{{ route('admin.validations') }}" class="block p-2 rounded-lg hover:bg-amber-50 transition-all mb-1">
                                        <p class="text-xs font-bold text-[#0A1128]">{{ $assoc->name }}</p>
                                        <p class="text-[10px] text-slate-400">En attente de validation</p>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        
                        @if($pendingDonationsCount > 0)
                            <div class="p-3 border-b border-slate-100">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Dons Manuels</p>
                                @foreach($recentManualDonations->take(3) as $donation)
                                    <a href="{{ route('admin.validations') }}" class="block p-2 rounded-lg hover:bg-blue-50 transition-all mb-1">
                                        <p class="text-xs font-bold text-[#0A1128]">{{ number_format($donation->amount, 0, ',', ' ') }} DH</p>
                                        <p class="text-[10px] text-slate-400">{{ $donation->isAnonymous ? 'Anonyme' : ($donation->donator->name ?? 'Inconnu') }}</p>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        
                        @if(isset($withdrawalRequests) && $withdrawalRequests->count() > 0)
                            <div class="p-3">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Demandes de Retrait</p>
                                @foreach($withdrawalRequests->take(3) as $project)
                                    @php
                                        $processingAmount = $project->donations()->where('status', 'PROCESSING')->sum('amount');
                                    @endphp
                                    <a href="{{ route('admin.dashboard') }}" class="block p-2 rounded-lg hover:bg-green-50 transition-all mb-1">
                                        <p class="text-xs font-bold text-[#0A1128]">{{ $project->title }}</p>
                                        <p class="text-[10px] text-slate-400">{{ number_format($processingAmount, 0, ',', ' ') }} DH à transférer</p>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        
                        @if($pendingAssociations->count() == 0 && $pendingDonationsCount == 0 && (!isset($withdrawalRequests) || $withdrawalRequests->count() == 0))
                            <div class="p-8 text-center">
                                <span class="material-symbols-outlined text-4xl text-slate-300 block mb-2">notifications_off</span>
                                <p class="text-xs text-slate-400">Aucune notification</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-3 border-t border-slate-100 bg-slate-50">
                        <a href="{{ route('admin.validations') }}" class="block text-center text-[10px] font-bold text-[#F5A623] hover:text-[#0A1128] transition-colors">
                            Voir tout →
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right">
                    <p class="text-sm font-bold text-[#0A1128]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Super Admin</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Dashboard Content -->
    <div class="pt-24 pb-20 px-8 max-w-7xl mx-auto space-y-10">
        <section class="flex items-end justify-between reveal active">
            <div>
                <p class="text-sm font-bold text-[#F5A623] uppercase tracking-widest mb-1">Bienvenue, {{ auth()->user()->name }}</p>
                <h2 class="text-3xl font-black text-[#0A1128] tracking-tight">Vue d'ensemble</h2>
            </div>
            <p class="text-xs text-slate-400 font-medium">Dernière MAJ : {{ now()->format('d/m/Y H:i') }}</p>
        </section>

        <!-- Statistics Cards -->
        @php
            // الفلوس لي خرجات من المنصة (محولة للجمعيات)
            $totalTransferred = \App\Models\Donation::whereIn('status', ['RECEIVED', 'IMPACT'])->sum('amount') ?? 0;
            
            // الفلوس في المنصة (مصادق عليها ولكن ماخرجاتش)
            $fundsInPlatform = \App\Models\Donation::where('status', 'VALIDATED')->sum('amount') ?? 0;
            
            // طلبات السحب قيد المعالجة (مازال في المنصة)
            $fundsProcessing = \App\Models\Donation::where('status', 'PROCESSING')->sum('amount') ?? 0;
            
            // إجمالي الفلوس المجموعة (كلشي)
            $totalCollected = \App\Models\Donation::whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount') ?? 0;
            
            // الفلوس لي مازال في المنصة (VALIDATED + PROCESSING)
            $fundsInPlatformTotal = $fundsInPlatform + $fundsProcessing;
            
            $activeAssocs = \App\Models\User::where('role', 'association')->where('status', 'ACTIVE')->count() ?? 0;
            $totalDonors = \App\Models\User::where('role', 'donator')->count() ?? 0;
            $completedProjects = \App\Models\Project::where('status', 'COMPLETED')->count() ?? 0;
            $totalProjects = \App\Models\Project::count() ?? 1;
            $impactRate = ($completedProjects / $totalProjects) * 100;
        @endphp
        <section class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- Total Collecté -->
            <div class="md:col-span-3 bg-gradient-to-br from-[#0A1128] to-[#162040] rounded-3xl p-8 text-white shadow-xl relative overflow-hidden group reveal">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2.5 bg-white/10 rounded-xl backdrop-blur-sm">
                                    <span class="material-symbols-outlined text-[#F5A623] text-3xl" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                                </div>
                                <span class="text-[10px] font-bold text-[#0A1128] bg-[#F5A623] px-3 py-1 rounded-full uppercase tracking-widest shadow-md">📊 Vue Financière</span>
                            </div>
                            <p class="text-[10px] text-white/50 uppercase tracking-[0.15em] font-bold mb-2">Total des Fonds Collectés</p>
                            <h2 class="text-5xl md:text-6xl font-black drop-shadow-lg animate-count">
                                {{ number_format($totalCollected, 0, ',', ' ') }}
                                <span class="text-2xl text-[#F5A623]">DH</span>
                            </h2>
                        </div>
                    </div>
                    
                    <!-- Répartition des Fonds -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                        <!-- Fonds Transférés -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10 hover:bg-white/15 transition-all">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-emerald-400 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-white/50 uppercase tracking-wider font-bold">Sortis de la Plateforme</p>
                                    <p class="text-xl font-black text-white">{{ number_format($totalTransferred, 0, ',', ' ') }} <span class="text-xs text-emerald-400">DH</span></p>
                                </div>
                            </div>
                            <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500" style="width: {{ $totalCollected > 0 ? ($totalTransferred / $totalCollected * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-[9px] text-white/40 mt-2">Fonds transférés aux associations</p>
                        </div>
                        
                        <!-- Fonds en Attente -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10 hover:bg-white/15 transition-all">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-lg bg-amber-500/20 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-amber-400 text-xl" style="font-variation-settings: 'FILL' 1;">schedule</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-white/50 uppercase tracking-wider font-bold">Dans la Plateforme</p>
                                    <p class="text-xl font-black text-white">{{ number_format($fundsInPlatform, 0, ',', ' ') }} <span class="text-xs text-amber-400">DH</span></p>
                                </div>
                            </div>
                            <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-amber-400 to-amber-500" style="width: {{ $totalCollected > 0 ? ($fundsInPlatform / $totalCollected * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-[9px] text-white/40 mt-2">Fonds validés en attente de retrait</p>
                        </div>
                        
                        <!-- Demandes de Retrait -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 border border-white/10 hover:bg-white/15 transition-all">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-blue-400 text-xl" style="font-variation-settings: 'FILL' 1;">sync</span>
                                </div>
                                <div>
                                    <p class="text-[9px] text-white/50 uppercase tracking-wider font-bold">En Cours de Transfert</p>
                                    <p class="text-xl font-black text-white">{{ number_format($fundsProcessing, 0, ',', ' ') }} <span class="text-xs text-blue-400">DH</span></p>
                                </div>
                            </div>
                            <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-400 to-blue-500" style="width: {{ $totalCollected > 0 ? ($fundsProcessing / $totalCollected * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-[9px] text-white/40 mt-2">Demandes de retrait en traitement</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#F5A623]/10 rounded-full blur-3xl group-hover:bg-[#F5A623]/20 transition-colors duration-700"></div>
            </div>
            
            <!-- Associations -->
            <div class="neu-card p-6 group reveal" style="animation-delay:.1s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-emerald-50 border border-emerald-100">
                        <span class="material-symbols-outlined text-2xl text-emerald-600" style="font-variation-settings: 'FILL' 1;">foundation</span>
                    </div>
                    <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">Vérifiées</span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Associations</p>
                <h3 class="text-2xl font-black text-[#0A1128] animate-count">{{ $activeAssocs }}</h3>
            </div>

            <!-- Donateurs -->
            <div class="neu-card p-6 group reveal" style="animation-delay:.2s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-blue-50 border border-blue-100">
                        <span class="material-symbols-outlined text-2xl text-blue-600" style="font-variation-settings: 'FILL' 1;">favorite</span>
                    </div>
                    <span class="text-[10px] font-bold text-blue-500 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-100">Inscrits</span>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Donateurs</p>
                <h3 class="text-2xl font-black text-[#0A1128] animate-count">{{ $totalDonors }}</h3>
            </div>

            <!-- Taux d'Impact -->
            <div class="neu-card p-6 group reveal" style="animation-delay:.3s">
                <div class="flex items-center justify-between mb-4">
                    <div class="stat-icon bg-violet-50 border border-violet-100">
                        <span class="material-symbols-outlined text-2xl text-violet-600" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                    </div>
                </div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Taux d'Impact</p>
                <h3 class="text-2xl font-black text-[#0A1128] animate-count">{{ number_format($impactRate, 1) }}<span class="text-sm text-slate-400">%</span></h3>
                <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden"><div class="h-full bg-gradient-to-r from-violet-500 to-purple-400 rounded-full" style="width:{{ min($impactRate,100) }}%"></div></div>
            </div>
        </section>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <section class="lg:col-span-8 space-y-6">
                <!-- Withdrawal Requests -->
                @if(isset($withdrawalRequests) && $withdrawalRequests->count() > 0)
                <div class="neu-card p-7 reveal border-l-4 border-blue-500">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-black text-[#0A1128] mb-0.5 flex items-center gap-2">
                                <span class="material-symbols-outlined text-blue-600">account_balance</span>
                                Demandes de Retrait
                            </h3>
                            <p class="text-xs text-slate-400">Transferts de fonds en attente de validation</p>
                        </div>
                        <span class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-200 rounded-full">
                            <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-black text-blue-700">{{ $withdrawalRequests->count() }} EN ATTENTE</span>
                        </span>
                    </div>

                    <div class="space-y-3">
                        @foreach($withdrawalRequests as $i => $project)
                            @php
                                $processingAmount = $project->donations()->where('status', 'PROCESSING')->sum('amount');
                            @endphp
                            <div class="p-4 rounded-xl border border-blue-100 bg-blue-50/30 flex items-center gap-4 group hover:border-blue-300 hover:bg-blue-50/50 transition-all animate-slide" style="animation-delay:{{ $i * 0.1 }}s">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0 shadow-sm">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-[#0A1128] text-sm truncate">{{ $project->title }}</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $project->association->name }}</p>
                                    <p class="text-xs font-black text-blue-600 mt-1">{{ number_format($processingAmount, 0, ',', ' ') }} DH à transférer</p>
                                </div>
                                <form action="{{ route('admin.approveWithdrawal', $project->id) }}" method="POST" class="flex-shrink-0">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Confirmer le transfert de {{ number_format($processingAmount, 0, ',', ' ') }} DH à {{ $project->association->name }} ?');" class="px-4 py-2 bg-blue-600 text-white text-[10px] font-bold rounded-lg hover:bg-blue-700 transition-all">
                                        Valider le Transfert
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="neu-card p-7 reveal">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-black text-[#0A1128] mb-0.5">Validations en attente</h3>
                            <p class="text-xs text-slate-400">Associations récemment inscrites</p>
                        </div>
                        @if($pendingAssociations->count() > 0)
                            <span class="flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 border border-amber-200 rounded-full">
                                <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                                <span class="text-[10px] font-black text-amber-700">{{ $pendingAssociations->count() }} EN ATTENTE</span>
                            </span>
                        @endif
                    </div>

                    <div class="space-y-2">
                        @forelse($pendingAssociations as $i => $assoc)
                            <div class="p-4 rounded-xl border border-slate-100 flex items-center gap-4 group hover:border-[#F5A623]/30 hover:bg-amber-50/30 transition-all animate-slide" style="animation-delay:{{ $i * 0.1 }}s">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5A623] to-[#FFD085] flex items-center justify-center font-bold text-[#0A1128] text-sm flex-shrink-0 shadow-sm">
                                    {{ strtoupper(substr($assoc->name, 0, 2)) }}
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-[#0A1128] text-sm truncate">{{ $assoc->name }}</h4>
                                    <p class="text-[11px] text-slate-400">{{ $assoc->email }} · {{ $assoc->created_at->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.validations') }}" class="px-4 py-2 bg-[#0A1128] text-white text-[10px] font-bold rounded-lg hover:bg-[#F5A623] hover:text-[#0A1128] transition-all flex-shrink-0">
                                    Vérifier
                                </a>
                            </div>
                        @empty
                            <div class="p-10 text-center rounded-xl border-2 border-dashed border-slate-200">
                                <span class="material-symbols-outlined text-3xl text-emerald-400 mb-2 block" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <p class="text-sm font-bold text-slate-600">Tout est à jour</p>
                                <p class="text-xs text-slate-400 mt-0.5">Aucune association en attente</p>
                            </div>
                        @endforelse
                    </div>

                    @if($pendingAssociations->count() > 0)
                        <div class="mt-6 text-center pt-6 border-t border-white/30">
                            <a href="{{ route('admin.validations') }}" class="text-[#F5A623] font-black hover:text-[#0A1128] transition-colors">Voir toutes les validations →</a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Right Column: Manual Donations & Activity -->
            <section class="lg:col-span-4 space-y-8">

                <!-- Manual Donations -->
                <div class="bg-gradient-to-br from-[#0A1128] to-[#162040] text-white rounded-2xl p-7 relative overflow-hidden shadow-xl reveal">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-[#F5A623]/8 rounded-full blur-2xl"></div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-sm font-bold">Dons Manuels</h3>
                            @if($pendingDonationsCount > 0)
                                <span class="px-2.5 py-1 bg-[#F5A623] text-[#0A1128] text-[10px] font-black rounded-lg">{{ $pendingDonationsCount }}</span>
                            @endif
                        </div>

                        <div class="space-y-3">
                            @forelse($recentManualDonations as $donation)
                                <div class="bg-white/[0.06] border border-white/10 p-3.5 rounded-xl hover:bg-white/[0.1] transition-all">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <p class="text-xs font-bold">{{ $donation->isAnonymous ? 'Anonyme' : $donation->donator->name ?? 'Inconnu' }}</p>
                                            <p class="text-[10px] text-white/50 mt-0.5">{{ number_format($donation->amount, 0, ',', ' ') }} DH</p>
                                        </div>
                                        <span class="text-[9px] px-2 py-0.5 rounded bg-amber-400/20 text-amber-300 font-bold uppercase">Pending</span>
                                    </div>
                                    <a href="{{ route('admin.validations') }}" class="block py-1.5 text-[10px] font-bold bg-white/10 hover:bg-[#F5A623] hover:text-[#0A1128] text-center rounded-lg transition-all">
                                        Vérifier →
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-6 text-white/40 text-xs">
                                    <span class="material-symbols-outlined text-2xl block mb-1" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    Aucun don en attente
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div class="neu-card p-7 reveal">
                    <h3 class="text-sm font-black text-[#0A1128] mb-5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#F5A623] text-lg" style="font-variation-settings: 'FILL' 1;">timeline</span>
                        Activité Récente
                    </h3>
                    <div class="space-y-4 relative">
                        <div class="absolute left-[11px] top-2 bottom-2 w-px bg-gradient-to-b from-[#F5A623] to-slate-200"></div>

                        @forelse($recentActivities as $i => $activity)
                            <div class="relative pl-8 animate-slide" style="animation-delay:{{ $i * 0.15 }}s">
                                <div class="absolute left-0 top-0.5 w-[22px] h-[22px] rounded-full bg-white border-2 border-[#F5A623] shadow-sm flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[#F5A623] text-[10px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                </div>
                                <p class="text-xs font-bold text-[#0A1128]">{{ number_format($activity->amount, 0, ',', ' ') }} DH</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">{{ Str::limit($activity->project->title ?? 'Projet', 30) }}</p>
                                <span class="text-[9px] text-slate-300 font-medium">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="pl-8 text-center py-4">
                                <p class="text-xs text-slate-400">Aucune activité récente</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const reveals = document.querySelectorAll('.reveal');
        const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        reveals.forEach(reveal => revealObserver.observe(reveal));
    });
</script>
</body>
</html>