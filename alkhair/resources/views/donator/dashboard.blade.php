<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Espace Donateur | AL-KHAIR</title>
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

@php
    $totalDonated = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->sum('amount') : 0;
    $projectsSupported = isset($myDonations) ? $myDonations->whereIn('status', ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT'])->unique('project_id')->count() : 0;
    $livesTouched = $projectsSupported * 125; // رقم تقديري للأثر
@endphp

<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl shadow-sm flex justify-between items-center px-8 py-4 border-b border-outline-variant/10">
    <div class="flex items-center gap-8">
        <span class="text-2xl font-extrabold tracking-tighter text-primary-container font-headline">AL-KHAIR</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3 bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/20">
            <div class="w-8 h-8 rounded-full overflow-hidden bg-primary-container flex items-center justify-center text-white font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <span class="font-semibold text-sm">{{ auth()->user()->name }}</span>
        </div>
    </div>
</nav>

<div class="flex pt-16 min-h-screen">
    
    <aside class="hidden md:flex h-screen w-64 fixed left-0 top-0 pt-24 flex-col gap-2 p-4 bg-surface-container-lowest border-r border-outline-variant/10">
        <nav class="flex flex-col gap-2 flex-grow">
            <a href="#" class="flex items-center gap-3 bg-primary-container text-white rounded-xl px-4 py-3 shadow-sm transition-transform translate-x-1">
                <span class="material-symbols-outlined text-secondary-container">dashboard</span>
                <span class="font-body text-sm font-semibold tracking-wide">Tableau de bord</span>
            </a>
            <a href="#projets" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">explore</span>
                <span class="font-body text-sm font-semibold tracking-wide">Explorer les projets</span>
            </a>
            <a href="#historique" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">history</span>
                <span class="font-body text-sm font-semibold tracking-wide">Mon Historique</span>
            </a>
        </nav>

        <div class="mt-auto mb-4">
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
        
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <header class="mb-10 flex justify-between items-end">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-4xl font-headline font-extrabold tracking-tight text-primary-container mb-2">
                    Bienvenue, {{ explode(' ', auth()->user()->name)[0] }} !
                </h1>
                <p class="text-on-surface-variant leading-relaxed">
                    Vos contributions construisent un héritage de transparence. Merci pour votre générosité continue envers la communauté.
                </p>
            </div>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/20 hover:border-secondary-container transition-colors">
                <span class="material-symbols-outlined text-secondary-container text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                <h3 class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Total Donné</h3>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl md:text-4xl font-headline font-extrabold text-primary-container">{{ number_format($totalDonated, 0, ',', ' ') }}</span>
                    <span class="text-sm font-bold text-on-surface-variant">DH</span>
                </div>
            </div>
            
            <div class="bg-primary-container text-white p-8 rounded-2xl shadow-lg relative overflow-hidden">
                <div class="relative z-10">
                    <span class="material-symbols-outlined text-secondary-container text-4xl mb-4">account_tree</span>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-300 mb-2">Projets Soutenus</h3>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl md:text-4xl font-headline font-extrabold">{{ $projectsSupported }}</span>
                        <span class="text-sm font-medium text-gray-300">projets</span>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">archive</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/20">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">diversity_3</span>
                <h3 class="text-xs font-bold uppercase tracking-widest text-on-surface-variant mb-2">Vies Impactées (Est.)</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl md:text-4xl font-headline font-extrabold text-primary-container">+{{ number_format($livesTouched, 0, ',', ' ') }}</span>
                    <span class="material-symbols-outlined text-secondary-container">trending_up</span>
                </div>
            </div>
        </section>

        <section id="historique" class="mb-16">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-headline font-extrabold text-primary-container">Historique Récent</h2>
            </div>
            
            @if(isset($myDonations) && $myDonations->count() > 0)
                <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-left">
                            <thead class="bg-surface-container-low border-b border-outline-variant/20">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Date</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Projet</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Montant</th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-on-surface-variant">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10">
                                @foreach($myDonations->take(5) as $donation)
                                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                                        <td class="px-6 py-5 text-sm text-on-surface-variant font-medium">
                                            {{ $donation->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-5 font-bold text-primary-container">
                                            {{ $donation->project->title ?? 'Projet clôturé' }}
                                        </td>
                                        <td class="px-6 py-5 font-extrabold text-secondary">
                                            {{ number_format($donation->amount, 0, ',', ' ') }} DH
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($donation->status === 'PENDING')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-100 text-[10px] font-bold uppercase tracking-widest text-yellow-800">En attente</span>
                                            @elseif($donation->status === 'VALIDATED' || $donation->status === 'RECEIVED')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-[10px] font-bold uppercase tracking-widest text-green-800">
                                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings: 'FILL' 1;">check_circle</span> Validé
                                                </span>
                                            @elseif($donation->status === 'IMPACT')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-primary-container text-[10px] font-bold uppercase tracking-widest text-secondary-container">
                                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings: 'FILL' 1;">verified</span> Impact
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-[10px] font-bold uppercase tracking-widest text-red-800">Refusé</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-surface-container-lowest p-12 rounded-2xl text-center border border-dashed border-outline-variant shadow-sm">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">history_toggle_off</span>
                    <h3 class="text-xl font-bold text-primary-container mb-2">Aucun don effectué</h3>
                    <p class="text-on-surface-variant">Vous n'avez pas encore fait de don. Explorez les projets ci-dessous !</p>
                </div>
            @endif
        </section>

        <section id="projets">
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-headline font-extrabold text-primary-container">Projets Solidaires</h2>
            </div>

            <div class="bg-surface-container-lowest p-4 rounded-2xl shadow-sm border border-outline-variant/20 mb-8">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <span class="material-symbols-outlined absolute left-3 top-3 text-outline-variant">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un projet..." class="w-full pl-10 pr-4 py-3 bg-surface border border-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all outline-none">
                    </div>
                    <div class="w-full md:w-64 relative">
                        <select name="category" class="w-full px-4 py-3 bg-surface border border-outline-variant/30 rounded-xl focus:ring-2 focus:ring-primary-container outline-none appearance-none font-medium text-on-surface-variant">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-3 text-outline-variant pointer-events-none">expand_more</span>
                    </div>
                    <button type="submit" class="bg-primary-container text-white px-8 py-3 rounded-xl hover:bg-slate-800 transition font-bold shadow-md">
                        Filtrer
                    </button>
                    @if(request('search') || request('category'))
                        <a href="{{ url()->current() }}" class="bg-surface-container-high text-on-surface-variant px-6 py-3 rounded-xl hover:bg-surface-container-highest transition font-bold text-center flex items-center justify-center">
                            Effacer
                        </a>
                    @endif
                </form>
            </div>

            @if(isset($projects) && $projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-outline-variant/10 group flex flex-col">
                            <div class="h-48 bg-surface-container-low relative overflow-hidden">
                                <img src="{{ $project->image ? asset('storage/' . $project->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute top-4 left-4 bg-surface-container-lowest/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full text-primary-container shadow-sm uppercase tracking-wider">
                                    {{ $project->category->name ?? 'Général' }}
                                </div>
                            </div>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <p class="text-xs font-bold text-secondary uppercase tracking-widest mb-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">foundation</span>
                                    {{ $project->association->name ?? 'Association' }}
                                </p>
                                <h3 class="text-xl font-headline font-extrabold text-primary-container mb-3 line-clamp-2">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-sm text-on-surface-variant mb-6 line-clamp-3 flex-grow">
                                    {{ $project->description }}
                                </p>

                                <div class="mb-6">
                                    <div class="flex justify-between text-xs font-bold mb-2">
                                        <span class="text-primary-container">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                        <span class="text-outline">Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                    </div>
                                    <div class="w-full bg-surface-container-high rounded-full h-2.5 overflow-hidden">
                                        @php
                                            $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                            $percentage = min($percentage, 100);
                                        @endphp
                                        <div class="bg-gradient-to-r from-secondary to-secondary-container h-full rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <div class="flex gap-3 mt-auto">
                                    <a href="{{ route('projects.show', $project->id) }}" class="flex-1 text-center bg-surface-container-low text-primary-container py-3 rounded-xl hover:bg-surface-container-high transition font-bold text-sm border border-outline-variant/20">
                                        Détails
                                    </a>
                                    <a href="{{ route('donations.create', $project->id) }}" class="flex-1 text-center bg-secondary-container text-on-secondary-container py-3 rounded-xl hover:bg-yellow-500 transition font-bold text-sm shadow-md">
                                        Soutenir
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-10 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="bg-surface-container-lowest p-12 rounded-2xl text-center border border-dashed border-outline-variant shadow-sm">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">search_off</span>
                    <h3 class="text-xl font-bold text-primary-container mb-2">Aucun projet trouvé</h3>
                    <p class="text-on-surface-variant">Essayez de modifier vos critères de recherche.</p>
                </div>
            @endif
        </section>

    </main>
</div>

</body>
</html>