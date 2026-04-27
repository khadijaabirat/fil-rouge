<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Espace Donateur | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        
        .neu-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(.4,0,.2,1); }
        .neu-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 20px 48px rgba(0,0,0,0.1); transform: translateY(-4px); }
        .neu-card-static { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
        
        .glass-sidebar { background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-right: 1px solid rgba(0,0,0,0.06); }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        .sidebar-link { transition: all 0.25s ease; border-radius: 14px; }
        .sidebar-link:hover { background: rgba(10,17,40,0.04); }
        .sidebar-link.active { background: linear-gradient(135deg, #0A1128, #1a2744); color: #fff; box-shadow: 0 4px 16px rgba(10,17,40,0.3); }

        .progress-bar { background: linear-gradient(90deg, #F5A623 0%, #FFD085 50%, #F5A623 100%); background-size: 200% 100%; animation: shimmer 2s infinite; }
        @keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white min-h-screen flex">

@php
    $totalDonated = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount') : 0;
    $projectsSupported = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->unique('project_id')->count() : 0;
    $livesTouched = $projectsSupported * 125;
@endphp

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
        <a href="{{ route('donator.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">dashboard</span>
            <span class="text-sm font-semibold">Tableau de bord</span>
        </a>
        <a href="#projets" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">explore</span>
            <span class="text-sm font-semibold">Projets Solidaires</span>
        </a>
        <a href="#historique" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">receipt_long</span>
            <span class="text-sm font-semibold">Historique des dons</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">person</span>
            <span class="text-sm font-semibold">Mon Profil</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50 space-y-3">
        <a href="#projets" class="w-full py-4 bg-[#0A1128] text-white rounded-xl font-black text-[10px] uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-[#F5A623] hover:text-[#0A1128] shadow-lg transition-all active:scale-95">
            <span class="material-symbols-outlined text-[18px]">favorite</span>
            Faire un don
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-500/10 font-bold text-sm transition-all rounded-xl group">
                <span class="material-symbols-outlined text-xl">logout</span>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-72 flex-grow min-h-screen relative">
    <!-- Header -->
    <header class="fixed right-0 top-0 z-40 bg-white/70 backdrop-blur-2xl border-b border-black/[0.04] flex justify-between items-center px-8 py-4" style="width: calc(100% - 18rem);">
        <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Bienvenue, {{ auth()->user()->name }}</h2>
        <div class="flex items-center gap-5">
            @if(session('success'))
                <div class="px-4 py-1.5 bg-emerald-50 border border-emerald-100 rounded-lg text-emerald-600 text-xs font-bold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="px-4 py-1.5 bg-blue-50 border border-blue-100 rounded-lg text-blue-600 text-xs font-bold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">info</span>
                    {{ session('info') }}
                </div>
            @endif
            @if(session('error'))
                <div class="px-4 py-1.5 bg-red-50 border border-red-100 rounded-lg text-red-600 text-xs font-bold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">error</span>
                    {{ session('error') }}
                </div>
            @endif
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Membre Actif</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-white text-sm shadow-lg border border-slate-700 overflow-hidden">
                    @if(auth()->user()->profilePhoto)
                        <img src="{{ asset('storage/' . auth()->user()->profilePhoto) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr(auth()->user()->name, 0, 1) }}
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="pt-28 pb-20 px-8 max-w-7xl mx-auto space-y-8">
        
        <section class="flex flex-col md:flex-row justify-between items-end gap-6 reveal active">
            <div>
                <span class="text-[10px] font-black text-[#F5A623] uppercase tracking-[0.2em] mb-2 block">Dernière MAJ : {{ now()->format('d/m/Y H:i') }}</span>
                <h3 class="text-4xl font-black text-[#0A1128] tracking-tight">Vue d'ensemble</h3>
            </div>
        </section>

        <!-- Hero Stats Section -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 reveal active" style="animation-delay: 0.1s">
            <!-- Main Card -->
            <div class="lg:col-span-2 relative overflow-hidden bg-gradient-to-br from-[#0A1128] to-[#162040] rounded-[2rem] p-10 text-white shadow-2xl flex flex-col justify-between min-h-[300px] group border border-slate-700">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm border border-white/10">
                            <span class="material-symbols-outlined text-[#F5A623] text-2xl" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#F5A623]">Capital de Bienfaisance</span>
                    </div>
                    <h2 class="text-5xl md:text-7xl font-black mt-2 tracking-tighter">
                        {{ number_format($totalDonated, 0, ',', ' ') }} <span class="text-2xl text-slate-400 ml-2">DH</span>
                    </h2>
                </div>
                <div class="relative z-10 flex flex-wrap gap-6 items-end justify-between mt-10">
                    <div class="flex gap-10">
                        <div class="flex flex-col">
                            <p class="text-[10px] text-white/50 uppercase tracking-[0.2em] font-black mb-2">Dons Réalisés</p>
                            <p class="text-3xl font-black text-white">{{ isset($myDonations) ? $myDonations->count() : 0 }}</p>
                        </div>
                        <div class="flex flex-col border-l border-white/10 pl-10">
                            <p class="text-[10px] text-white/50 uppercase tracking-[0.2em] font-black mb-2">Projets Soutenus</p>
                            <p class="text-3xl font-black text-white">{{ $projectsSupported }}</p>
                        </div>
                    </div>
                    <div class="bg-emerald-500/20 border border-emerald-500/30 px-5 py-2.5 rounded-xl flex items-center gap-2 backdrop-blur-sm shadow-lg">
                        <span class="material-symbols-outlined text-emerald-400 text-lg" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Compte Vérifié</span>
                    </div>
                </div>
                <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#F5A623]/20 rounded-full blur-[80px] group-hover:bg-[#F5A623]/30 transition-colors duration-700 pointer-events-none"></div>
                <div class="absolute right-10 top-10 w-48 h-48 bg-blue-500/10 blur-[60px] rounded-full pointer-events-none"></div>
            </div>

            <!-- Impact Card -->
            <div class="neu-card-static p-10 flex flex-col justify-between relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-3xl text-blue-600" style="font-variation-settings: 'FILL' 1;">diversity_3</span>
                        </div>
                        <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 uppercase tracking-widest shadow-sm">Impact</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-4">Vies Impactées</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Vos dons ont permis d'améliorer les conditions de vie d'environ <strong class="text-[#F5A623] text-lg block mt-2">{{ number_format($livesTouched, 0, ',', ' ') }} personnes</strong></p>
                </div>
                <div class="absolute -bottom-12 -right-12 text-[#0A1128]/5 pointer-events-none">
                    <span class="material-symbols-outlined text-[180px]" style="font-variation-settings: 'FILL' 1;">public</span>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projets" class="reveal active" style="animation-delay: 0.2s">
            <div class="flex justify-between items-end mb-8 mt-12">
                <div>
                    <h2 class="text-3xl font-black tracking-tight text-[#0A1128]">Projets en cours</h2>
                    <p class="text-slate-500 font-bold mt-1">Découvrez les campagnes solidaires</p>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="neu-card-static p-4 mb-8">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-3">
                    <div class="flex-1 relative">
                        <span class="material-symbols-outlined absolute left-4 top-4 text-slate-400">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un projet..." class="w-full pl-12 pr-4 py-4 bg-slate-50 border-0 rounded-xl focus:ring-2 focus:ring-[#F5A623] transition-all font-bold text-sm text-[#0A1128]">
                    </div>
                    <div class="w-full md:w-64 relative">
                        <select name="category_id" class="w-full pl-4 pr-12 py-4 bg-slate-50 border-0 rounded-xl focus:ring-2 focus:ring-[#F5A623] appearance-none font-bold text-sm text-[#0A1128] cursor-pointer">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-4 text-slate-400 pointer-events-none">expand_more</span>
                    </div>
                    <button type="submit" class="bg-[#0A1128] text-white px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-md active:scale-95">
                        Filtrer
                    </button>
                    @if(request('search') || request('category_id'))
                        <a href="{{ url()->current() }}" class="bg-slate-100 text-slate-500 px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all flex items-center justify-center shadow-sm">
                            Effacer
                        </a>
                    @endif
                </form>
            </div>

            @if(isset($projects) && $projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="neu-card overflow-hidden flex flex-col group border-transparent hover:border-slate-100">
                            <!-- Project Image -->
                            <div class="h-56 relative overflow-hidden bg-slate-100">
                                <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-[#0A1128]/20 to-transparent"></div>
                                <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-md text-[#0A1128] text-[10px] font-black px-3 py-1.5 rounded-lg shadow-sm uppercase tracking-widest">
                                    {{ $project->category->name ?? 'Général' }}
                                </div>
                            </div>

                            <!-- Project Content -->
                            <div class="p-8 flex flex-col flex-grow bg-white">
                                <h4 class="font-black text-xl text-[#0A1128] mb-3 leading-tight line-clamp-2 group-hover:text-[#F5A623] transition-colors">{{ $project->title }}</h4>
                                <p class="text-sm text-slate-500 mb-6 line-clamp-2 flex-grow font-medium leading-relaxed">{{ $project->description }}</p>

                                <!-- Progress Section -->
                                <div class="mb-8 space-y-3">
                                    <div class="flex justify-between font-black text-sm mb-1">
                                        <span class="text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span class="text-[#F5A623]">
                                            @php
                                                $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                                $percentage = min($percentage, 100);
                                            @endphp
                                            {{ number_format($percentage, 0) }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden shadow-inner">
                                        <div class="progress-bar h-full rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                                        Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-4 mt-auto">
                                    <a href="{{ route('projects.show', $project->id) }}" class="flex-1 text-center bg-slate-50 text-slate-500 py-3.5 rounded-xl hover:bg-slate-100 hover:text-[#0A1128] transition-colors font-black text-[10px] uppercase tracking-widest border border-slate-200">Détails</a>
                                    <a href="{{ route('donations.create', $project->id) }}" class="flex-1 text-center bg-[#0A1128] text-white py-3.5 rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] transition-all font-black text-[10px] uppercase tracking-widest shadow-lg active:scale-95">Soutenir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-10 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="neu-card-static p-16 text-center border-2 border-dashed border-slate-200">
                    <div class="w-20 h-20 mx-auto bg-slate-50 rounded-[2rem] flex items-center justify-center mb-6 border border-slate-100 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-slate-300">search_off</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-2">Aucun projet trouvé</h3>
                    <p class="text-slate-500 font-medium">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endif
        </section>

        <!-- Donations History Section -->
        <section id="historique" class="neu-card-static p-8 reveal active" style="animation-delay: 0.3s">
            <div class="flex justify-between items-center mb-8 mt-4">
                <div>
                    <h3 class="text-3xl font-black text-[#0A1128]">Historique des Dons</h3>
                    <p class="text-slate-500 font-bold mt-1">Retrouvez vos contributions passées</p>
                </div>
            </div>

            @if(isset($myDonations) && $myDonations->count() > 0)
                <div class="overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="w-full text-left bg-white">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-5 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black">Date</th>
                                <th class="py-5 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black">Projet</th>
                                <th class="py-5 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black text-right">Montant</th>
                                <th class="py-5 px-6 text-[10px] uppercase tracking-widest text-slate-400 font-black text-center">Statut & Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($myDonations as $donation)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-6 px-6 text-sm text-slate-400 font-bold">
                                        {{ $donation->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="py-6 px-6">
                                        <a href="{{ $donation->project ? route('projects.show', $donation->project->id) : '#' }}" class="font-black text-[#0A1128] hover:text-[#F5A623] transition-colors line-clamp-1 text-base">
                                            {{ $donation->project->title ?? 'Projet clôturé' }}
                                        </a>
                                    </td>
                                    <td class="py-6 px-6 text-right font-black text-[#0A1128] text-lg">
                                        {{ number_format($donation->amount, 0, ',', ' ') }} <span class="text-[#F5A623] text-sm ml-1">DH</span>
                                    </td>
                                    <td class="py-6 px-6">
                                        <div class="flex justify-center flex-col items-center gap-3">
                                            @if($donation->status === 'PENDING')
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100 shadow-sm">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">pending</span> En attente
                                                </span>
                                            @elseif($donation->status === 'VALIDATED')
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">check_circle</span> Validé
                                                </span>
                                            @elseif($donation->status === 'PROCESSING')
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest border border-blue-100 shadow-sm">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">sync</span> En cours
                                                </span>
                                            @elseif($donation->status === 'RECEIVED')
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-purple-50 text-purple-600 text-[10px] font-black uppercase tracking-widest border border-purple-100 shadow-sm">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">done_all</span> Reçu
                                                </span>
                                            @elseif($donation->status === 'IMPACT')
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-[#0A1128] text-[#F5A623] text-[10px] font-black uppercase tracking-widest shadow-md">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">verified</span> Impact
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 rounded-lg bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100 shadow-sm">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">cancel</span> Échoué
                                                </span>
                                            @endif

                                            @if(in_array($donation->status, ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT']))
                                                <a href="{{ route('donations.receipt', $donation->id) }}" class="text-[#0A1128] bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-md text-[10px] font-black flex items-center gap-1 transition-colors uppercase tracking-widest" title="Télécharger le reçu">
                                                    <span class="material-symbols-outlined text-[14px]">download</span>
                                                    Reçu
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-16 text-center border-2 border-dashed border-slate-200 rounded-2xl">
                    <div class="w-20 h-20 mx-auto bg-amber-50 rounded-[2rem] flex items-center justify-center mb-6 border border-amber-100 shadow-sm">
                        <span class="material-symbols-outlined text-4xl text-[#F5A623]">favorite</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-2">Aucun don effectué</h3>
                    <p class="text-slate-500 font-medium mb-8">Commencez à soutenir les projets solidaires dès maintenant !</p>
                    <a href="{{ url('/projects') }}" class="inline-flex items-center gap-2 bg-[#0A1128] text-white px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">explore</span>
                        Explorer les projets
                    </a>
                </div>
            @endif
        </section>

    </div>
</main>

<script>
    // Scroll reveal animation
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>
