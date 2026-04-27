<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Projets Expirés | Espace Association AL-KHAIR</title>
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
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
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
        <a href="{{ route('association.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="text-sm font-semibold">Vue d'ensemble</span>
        </a>
        <a href="{{ route('association.dashboard') }}#projets" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">folder_open</span>
            <span class="text-sm font-semibold">Mes Projets</span>
        </a>
        <a href="{{ route('association.projects.expired') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">hourglass_empty</span>
            <span class="text-sm font-semibold">Projets Expirés</span>
        </a>
        <a href="{{ route('impact.create', 0) }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">verified</span>
            <span class="text-sm font-semibold">Preuves d'impact</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50">
        <a href="{{ route('association.profile') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 mb-2 text-slate-600">
            <span class="material-symbols-outlined text-xl">manage_accounts</span>
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
</aside>

<!-- Main Content -->
<main class="ml-72 flex-grow min-h-screen relative">
    <!-- Header -->
    <header class="fixed right-0 top-0 z-40 bg-white/70 backdrop-blur-2xl border-b border-black/[0.04] flex justify-between items-center px-8 py-4" style="width: calc(100% - 18rem);">
        <div class="flex items-center gap-4">
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Projets Expirés</h2>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Association</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20">
                    <span class="material-symbols-outlined text-[20px]">building</span>
                </div>
            </div>
        </div>
    </header>

    <div class="pt-24 pb-20 px-8 max-w-6xl mx-auto space-y-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal active">
            <div class="max-w-2xl">
                <h1 class="text-4xl font-black text-[#0A1128] tracking-tight mb-2">Projets Expirés</h1>
                <p class="text-slate-500 text-sm leading-relaxed">Ces projets ont atteint leur date limite sans atteindre l'objectif financier initial. Veuillez décider de la marche à suivre pour chaque initiative.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-4 rounded-2xl border border-slate-200 shadow-sm">
                <div class="w-12 h-12 bg-amber-50 text-[#F5A623] rounded-xl flex items-center justify-center border border-amber-100">
                    <span class="material-symbols-outlined text-2xl">hourglass_empty</span>
                </div>
                <div>
                    <p class="text-2xl font-black text-[#0A1128]">{{ $expiredProjects->count() ?? 0 }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">En attente</p>
                </div>
            </div>
        </div>

        <div class="neu-card-static p-6 border-l-4 border-[#0A1128] flex items-start gap-4 reveal active bg-[#0A1128]/5">
            <span class="material-symbols-outlined text-[#0A1128] text-2xl mt-0.5" style="font-variation-settings: 'FILL' 1;">warning</span>
            <div>
                <h3 class="font-black text-[#0A1128] text-sm mb-1 uppercase tracking-wider">Protocole de Transparence & Rapports d'Impact</h3>
                <p class="text-xs text-slate-600 leading-relaxed max-w-4xl">
                    Conformément à la charte AL-KHAIR, toute décision de <strong class="text-[#0A1128]">Clôture et Transfert</strong> des fonds engagera votre association à fournir un <strong class="text-[#0A1128]">Rapport d'Impact</strong> détaillé. Même si l'objectif total n'est pas atteint, les donateurs doivent être informés de l'utilisation exacte de leurs contributions partielles.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="neu-card-static p-6 border-l-4 border-red-500 flex items-start gap-4 reveal active bg-red-50/30">
                <span class="material-symbols-outlined text-red-500 text-2xl">error</span>
                <ul class="list-disc list-inside text-xs text-red-600 font-medium space-y-1 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="neu-card-static p-5 border-l-4 border-emerald-500 flex items-center gap-4 reveal active bg-emerald-50/30">
                <span class="material-symbols-outlined text-emerald-500 text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="font-bold text-sm text-emerald-700">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="neu-card-static p-5 border-l-4 border-red-500 flex items-center gap-4 reveal active bg-red-50/30">
                <span class="material-symbols-outlined text-red-500 text-2xl">error</span>
                <span class="font-bold text-sm text-red-700">{{ session('error') }}</span>
            </div>
        @endif

        @if(isset($expiredProjects) && $expiredProjects->count() > 0)
            <div class="space-y-6">
                @foreach($expiredProjects as $project)
                    <div class="neu-card overflow-hidden flex flex-col md:flex-row group reveal">
                        <!-- Image Section -->
                        <div class="md:w-1/3 relative h-56 md:h-auto overflow-hidden bg-slate-100">
                            @if($project->image)
                                <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ asset('storage/' . str_replace(' ', '%20', $project->image)) }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20 items-center justify-center" style="display:none;">
                                    <span class="text-[#0A1128]/30 text-5xl font-black">AK</span>
                                </div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20 flex items-center justify-center">
                                    <span class="text-[#0A1128]/30 text-5xl font-black">AK</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/80 to-transparent flex items-end p-5">
                                <span class="bg-red-500 text-white text-[10px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-sm backdrop-blur-sm border border-red-400">Expiré le {{ \Carbon\Carbon::parse($project->endDate)->format('d/m/Y') }}</span>
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="md:w-2/3 p-6 md:p-8 flex flex-col justify-between">
                            <div>
                                <h3 class="font-black text-xl text-[#0A1128] mb-2 line-clamp-1 group-hover:text-[#F5A623] transition-colors">{{ $project->title }}</h3>
                                <p class="text-xs text-slate-500 mb-6 flex items-center gap-1 font-bold">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span> {{ $project->ville ?? 'Maroc' }}
                                </p>
                                
                                @php
                                    $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                    $percentage = min($percentage, 100);
                                @endphp

                                <div class="space-y-2 mb-8 bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                    <div class="flex justify-between text-[10px] font-black uppercase tracking-wider mb-1">
                                        <span class="text-sm text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span class="text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                                    </div>
                                    <div class="h-2 w-full bg-[#e8ecf3] rounded-full overflow-hidden">
                                        <div class="h-full progress-bar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-[10px] text-slate-500 font-bold mt-2">
                                        <span>Objectif: <strong class="text-[#0A1128]">{{ number_format($project->goalAmount, 0, ',', ' ') }} DH</strong></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                                <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex-1 flex gap-2">
                                    @csrf
                                    <input type="date" name="newEndDate" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-1/2 bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs focus:ring-2 focus:ring-[#F5A623] outline-none" title="Nouvelle date de fin">
                                    <button type="submit" class="w-1/2 py-2.5 bg-[#0A1128] text-white rounded-xl font-bold text-[10px] hover:bg-[#F5A623] hover:text-[#0A1128] transition-all flex items-center justify-center gap-1.5 shadow-sm uppercase tracking-wider">
                                        <span class="material-symbols-outlined text-[16px]">update</span> Prolonger
                                    </button>
                                </form>

                                @if($project->currentAmount > 0)
                                    @php
                                        $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
                                        $hasReceived = $project->donations()->where('status', 'RECEIVED')->exists();
                                    @endphp

                                    @if($hasProcessing)
                                        <div class="flex-1 bg-blue-50 border-2 border-blue-200 rounded-xl p-3 flex items-center justify-center gap-2">
                                            <span class="material-symbols-outlined text-blue-500 animate-spin text-lg">hourglass_top</span>
                                            <span class="text-xs font-bold text-blue-700">Transfert en cours...</span>
                                        </div>
                                    @elseif($hasReceived)
                                        <div class="flex-1 bg-red-50 border-2 border-red-200 rounded-xl p-3 flex items-center justify-center gap-2">
                                            <span class="text-xs font-bold text-red-700">Fonds reçus ! Publiez le rapport</span>
                                        </div>
                                    @else
                                        <form action="{{ route('association.withdraw', $project->id) }}" method="POST" class="flex-1" onsubmit="console.log('Form submitting...', '{{ route('association.withdraw', $project->id) }}'); return confirm('En clôturant ce projet, vous vous engagez à publier un rapport d\'impact pour les fonds récoltés. Continuer ?');">
                                            @csrf
                                            <button type="submit" onclick="console.log('Button clicked for project {{ $project->id }}');" class="w-full py-2.5 bg-orange-600 text-white rounded-xl font-bold text-[10px] hover:bg-orange-700 transition-all flex items-center justify-center gap-1.5 shadow-sm uppercase tracking-wider">
                                                <span class="material-symbols-outlined text-[16px]">swap_horiz</span> Clôturer & Retirer
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="flex-1 bg-slate-50 border-2 border-slate-200 rounded-xl p-3 flex items-center justify-center">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Aucun fonds collecté</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="neu-card p-16 text-center border-2 border-dashed border-slate-200 reveal">
                <div class="w-20 h-20 mx-auto bg-slate-50 rounded-3xl flex items-center justify-center mb-6 border border-slate-100">
                    <span class="material-symbols-outlined text-4xl text-slate-300">task_alt</span>
                </div>
                <h3 class="text-2xl font-black text-[#0A1128] mb-2">Aucun projet expiré</h3>
                <p class="text-slate-500 mb-8 max-w-md mx-auto text-sm">Tous vos projets sont soit en cours, soit déjà complétés.</p>
                <a href="{{ route('association.dashboard') }}" class="inline-flex items-center gap-2 bg-[#0A1128] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all text-sm shadow-md">
                    Retourner au Tableau de Bord
                </a>
            </div>
        @endif
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