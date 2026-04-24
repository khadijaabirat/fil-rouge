<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Espace Donateur | AL-KHAIR ARCHIVE</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                        "secondary": "#7c5800",
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-effect { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased flex min-h-screen overflow-x-hidden">

@php
    $totalDonated = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount') : 0;
    $projectsSupported = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->unique('project_id')->count() : 0;
    $livesTouched = $projectsSupported * 125; // رقم تقديري للأثر
@endphp

<aside class="hidden md:flex h-screen w-72 border-r bg-surface-container-lowest flex-col p-6 gap-y-4 sticky top-0 border-outline-variant/20 shadow-sm">
    <div class="mb-8">
        <span class="font-headline font-black text-xl text-primary-container uppercase tracking-widest">AL-KHAIR</span>
        <p class="font-body font-medium text-sm tracking-wide text-on-surface-variant mt-1">Espace Donateur</p>
    </div>
    
    <nav class="flex flex-col gap-y-2 flex-grow">
        <a href="#" class="flex items-center gap-3 px-4 py-3 cursor-pointer transition-all bg-primary-container text-white font-bold rounded-lg shadow-sm">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-body text-sm tracking-wide">Tableau de bord</span>
        </a>
        
        <a href="#projets" class="flex items-center gap-3 px-4 py-3 cursor-pointer transition-all text-on-surface-variant hover:bg-surface-container-low hover:text-primary-container hover:translate-x-1 duration-200 rounded-lg">
            <span class="material-symbols-outlined">explore</span>
            <span class="font-body font-medium text-sm tracking-wide">Projets Solidaires</span>
        </a>
        
        <a href="#historique" class="flex items-center gap-3 px-4 py-3 cursor-pointer transition-all text-on-surface-variant hover:bg-surface-container-low hover:text-primary-container hover:translate-x-1 duration-200 rounded-lg">
            <span class="material-symbols-outlined">receipt_long</span>
            <span class="font-body font-medium text-sm tracking-wide">Historique des dons</span>
        </a>
    </nav>
    
    <div class="pt-6 border-t border-outline-variant/20">
        <a href="#projets" class="block text-center w-full bg-secondary-container text-on-secondary-container font-bold py-3 rounded-lg hover:scale-[0.98] transition-transform shadow-md">
            Faire un don
        </a>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 cursor-pointer transition-all text-red-500 hover:bg-red-50 rounded-lg">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-body font-medium text-sm tracking-wide">Déconnexion</span>
            </button>
        </form>
    </div>
</aside>

<main class="flex-grow flex flex-col min-h-screen">
    
    <header class="bg-white/80 backdrop-blur-xl docked full-width top-0 sticky z-50 flex justify-between items-center w-full px-8 py-4 shadow-sm shadow-black/5">
        <div class="flex items-center gap-4">
            <h1 class="font-headline font-extrabold text-2xl tracking-tighter text-primary-container md:hidden">AL-KHAIR</h1>
        </div>
        <div class="flex items-center gap-6 ml-auto">
            <div class="flex items-center gap-3 pl-6 border-l border-outline-variant/20">
                <div class="text-right hidden sm:block">
                    <p class="font-headline font-bold text-sm tracking-tight text-primary-container">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-secondary">Membre Actif</p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-secondary bg-primary-container flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </header>

    <div class="p-6 md:p-10 space-y-10">
        
        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 relative overflow-hidden bg-primary-container rounded-xl p-8 text-white shadow-xl flex flex-col justify-between min-h-[280px]">
                <div class="relative z-10">
                    <span class="text-xs font-bold uppercase tracking-[0.2em] text-white/60">Capital de Bienfaisance Total</span>
                    <h2 class="text-5xl md:text-6xl font-headline font-extrabold mt-4 tracking-tighter">{{ number_format($totalDonated, 0, ',', ' ') }} DH</h2>
                </div>
                <div class="relative z-10 flex flex-wrap gap-4 items-end justify-between mt-8">
                    <div class="flex gap-8">
                        <div>
                            <p class="text-xs text-white/50 uppercase tracking-widest mb-1">Dons Réalisés</p>
                            <p class="text-2xl font-headline font-bold">{{ isset($myDonations) ? $myDonations->count() : 0 }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-white/50 uppercase tracking-widest mb-1">Projets Soutenus</p>
                            <p class="text-2xl font-headline font-bold">{{ $projectsSupported }}</p>
                        </div>
                    </div>
                    <div class="bg-amber-500/20 glass-effect border border-amber-500/30 px-4 py-2 rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">verified</span>
                        <span class="text-sm font-bold tracking-wide">Compte Vérifié</span>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-secondary opacity-20 blur-[80px] rounded-full pointer-events-none"></div>
                <div class="absolute right-10 top-10 w-32 h-32 bg-amber-400 opacity-10 blur-[40px] rounded-full pointer-events-none"></div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl p-8 flex flex-col justify-between border border-outline-variant/20 shadow-sm">
                <div>
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-amber-50 flex items-center justify-center rounded-xl">
                            <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">diversity_3</span>
                        </div>
                        <span class="text-[10px] font-black bg-amber-100 text-secondary px-3 py-1 rounded-full tracking-widest uppercase">Impact</span>
                    </div>
                    <h3 class="text-xl font-headline font-bold text-primary-container">Vies Impactées</h3>
                    <p class="text-sm text-on-surface-variant mt-2 leading-relaxed">Vos dons ont permis d'améliorer les conditions de vie d'environ <strong class="text-secondary">{{ number_format($livesTouched, 0, ',', ' ') }} personnes</strong>.</p>
                </div>
            </div>
        </section>

        <section id="projets">
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-headline font-bold tracking-tight text-primary-container">Projets en cours</h2>
            </div>

            <div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-outline-variant/20 mb-8">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <span class="material-symbols-outlined absolute left-3 top-3 text-outline-variant">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un projet..." class="w-full pl-10 pr-4 py-3 bg-surface border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all outline-none">
                    </div>
                    <div class="w-full md:w-64 relative">
                        <select name="category" class="w-full px-4 py-3 bg-surface border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary-container outline-none appearance-none font-medium text-on-surface-variant">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-outline-variant pointer-events-none">expand_more</span>
                    </div>
                    <button type="submit" class="bg-primary-container text-white px-8 py-3 rounded-lg hover:bg-slate-800 transition font-bold shadow-md">
                        Filtrer
                    </button>
                    @if(request('search') || request('category'))
                        <a href="{{ url()->current() }}" class="bg-surface-container-high text-on-surface-variant px-6 py-3 rounded-lg hover:bg-surface-container-highest transition font-bold text-center flex items-center justify-center">
                            Effacer
                        </a>
                    @endif
                </form>
            </div>

            @if(isset($projects) && $projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 border border-outline-variant/10 flex flex-col">
                            <div class="h-48 relative overflow-hidden group">
                                <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-[10px] font-bold px-3 py-1 rounded-full text-primary-container shadow-sm uppercase tracking-wider">
                                    {{ $project->category->name ?? 'Général' }}
                                </div>
                                <h4 class="absolute bottom-4 left-4 right-4 text-white font-bold text-lg leading-tight line-clamp-2">{{ $project->title }}</h4>
                            </div>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <p class="text-xs text-on-surface-variant mb-4 line-clamp-2 flex-grow">{{ $project->description }}</p>

                                <div class="mb-6">
                                    <div class="flex justify-between text-xs font-bold mb-2">
                                        <span class="text-primary-container">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span class="text-outline-variant">Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                    </div>
                                    <div class="w-full bg-surface-container-high rounded-full h-2 overflow-hidden">
                                        @php
                                            $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                            $percentage = min($percentage, 100);
                                        @endphp
                                        <div class="bg-gradient-to-r from-secondary to-secondary-container h-full rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-auto">
                                    <a href="{{ route('projects.show', $project->id) }}" class="flex-1 text-center bg-surface-container-low text-primary-container py-2.5 rounded-lg hover:bg-surface-container-high transition font-bold text-sm border border-outline-variant/20">Détails</a>
                                    <a href="{{ route('donations.create', $project->id) }}" class="flex-1 text-center bg-secondary-container text-on-secondary-container py-2.5 rounded-lg hover:bg-yellow-500 transition font-bold text-sm shadow-sm">Soutenir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="bg-surface-container-lowest p-12 rounded-xl text-center border border-dashed border-outline-variant shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-outline-variant mb-4">search_off</span>
                    <h3 class="text-lg font-bold text-primary-container mb-2">Aucun projet trouvé</h3>
                    <p class="text-sm text-on-surface-variant">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endif
        </section>

        <section id="historique" class="bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-outline-variant/20 mb-10">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-headline font-bold tracking-tight text-primary-container">Historique des Dons</h3>
            </div>
            
            @if(isset($myDonations) && $myDonations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] uppercase tracking-widest text-on-surface-variant font-black border-b border-outline-variant/30">
                                <th class="pb-4 px-2">Date</th>
                                <th class="pb-4 px-2">Projet</th>
                                <th class="pb-4 px-2 text-right">Montant</th>
                                <th class="pb-4 px-2 text-center">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @foreach($myDonations as $donation)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="py-5 px-2 text-sm font-medium text-on-surface-variant">
                                        {{ $donation->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="py-5 px-2 font-bold text-primary-container">
                                        {{ $donation->project->title ?? 'Projet clôturé' }}
                                    </td>
                                    <td class="py-5 px-2 text-right font-headline font-bold text-secondary">
                                        {{ number_format($donation->amount, 0, ',', ' ') }} DH
                                    </td>
                                    <td class="py-5 px-2">
                                        <div class="flex justify-center">
                                            @if($donation->status === 'PENDING')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-[10px] font-bold uppercase tracking-wider border border-yellow-200">En attente</span>
                                            @elseif($donation->status === 'VALIDATED')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-[10px] font-bold uppercase tracking-wider border border-green-200">Validé</span>
                                            @elseif($donation->status === 'PROCESSING')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-[10px] font-bold uppercase tracking-wider border border-blue-200">En cours</span>
                                            @elseif($donation->status === 'RECEIVED')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase tracking-wider border border-indigo-200">Reçu</span>
                                            @elseif($donation->status === 'IMPACT')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-container text-secondary-container text-[10px] font-bold uppercase tracking-wider">🌟 Impact</span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-700 text-[10px] font-bold uppercase tracking-wider border border-red-200">Échoué</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <span class="material-symbols-outlined text-4xl text-outline-variant mb-2">history_toggle_off</span>
                    <p class="text-on-surface-variant font-medium">Vous n'avez pas encore fait de don.</p>
                </div>
            @endif
        </section>
        
    </div>

    <footer class="bg-surface-container-lowest w-full py-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center px-10 mt-auto">
        <div>
            <span class="font-headline font-bold text-primary-container">AL-KHAIR</span>
            <p class="font-body text-[10px] font-medium uppercase tracking-widest text-on-surface-variant mt-1">© 2024 La plateforme solidaire.</p>
        </div>
    </footer>
</main>

</body>
</html>