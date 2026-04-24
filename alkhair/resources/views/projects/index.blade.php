<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tous les Projets | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>

    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: #e8ecf3;
        }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        
        .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); }

        /* Custom Scroll Reveal Animation */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#e8ecf3] text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white">

    <header id="main-nav" class="fixed w-full top-0 z-50 transition-all duration-300 bg-[#0A1128]/80 backdrop-blur-xl shadow-xl py-2">
        <nav class="container mx-auto px-4 flex justify-between items-center bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 shadow-lg shadow-black/5">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#F5A623] to-[#FFD085] p-2 rounded-xl font-black text-[#0A1128] text-xl shadow-md">AK</div>
                <div>
                    <a href="{{ url('/') }}">
                        <h1 class="text-2xl font-black text-white drop-shadow-md leading-none tracking-tight">AL-KHAIR</h1>
                        <p class="text-[10px] text-[#F5A623] font-bold tracking-widest uppercase">Certifié 2026</p>
                    </a>
                </div>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ url('/') }}">Accueil</a>
                <a class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]" href="{{ route('projects.index') }}">Projets</a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-white/90 font-medium hover:text-[#F5A623] transition">Dashboard</a>
                    @elseif(Auth::user()->isAssociation())
                        <a href="{{ route('association.dashboard') }}" class="text-white/90 font-medium hover:text-[#F5A623] transition">Mon Espace</a>
                    @elseif(Auth::user()->isDonator())
                        <a href="{{ route('donator.dashboard') }}" class="text-white/90 font-medium hover:text-[#F5A623] transition">Mon Espace</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                        @csrf
                        <button type="submit" class="glass hover:bg-red-500/20 text-white text-sm font-bold px-5 py-2 rounded-xl transition-all shadow-sm">Quitter</button>
                    </form>
                @else
                    <a class="text-white/90 font-medium hover:text-[#F5A623] transition" href="{{ route('login') }}">Connexion</a>
                    <a class="bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg shadow-[#F5A623]/30 flex items-center gap-2" href="{{ route('register') }}">
                        S'inscrire <span class="text-lg leading-none">→</span>
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <section class="relative min-h-[50vh] flex items-center overflow-hidden pt-32 pb-20">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-[#0A1128] via-[#1a2744] to-[#0A1128]"></div>
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#F5A623]/20 rounded-full blur-3xl float-animation"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl float-animation" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 glass text-white px-5 py-2 rounded-full text-xs font-bold mb-8 uppercase tracking-widest shadow-lg">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ $projects->total() ?? 0 }} Projets Actifs
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-[1.05] tracking-tight reveal active">
                Explorez tous les <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5A623] via-[#FFD085] to-[#F5A623]">projets solidaires</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100/80 mb-10 leading-relaxed font-light max-w-3xl mx-auto reveal active">
                Découvrez les initiatives qui changent des vies à travers le Maroc. Chaque projet est vérifié et transparent.
            </p>
        </div>
    </section>

    <section class="container mx-auto px-4 -mt-10 relative z-20 mb-16 reveal active">
        <div class="glass-card rounded-[2rem] shadow-2xl p-8">
            <form action="{{ route('projects.index') }}" method="GET" id="filter-form">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Rechercher</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input name="search" value="{{ request('search') }}" class="w-full h-14 pl-12 pr-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all" placeholder="Nom du projet, ville, association..." type="text"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Catégorie</label>
                        <select name="category_id" class="w-full h-14 px-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all bg-white">
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Trier par</label>
                        <select name="sort" class="w-full h-14 px-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all bg-white">
                            <option value="">Plus récents</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
                            <option value="deadline_soon" {{ request('sort') == 'deadline_soon' ? 'selected' : '' }}>Date limite proche</option>
                            <option value="progress_high" {{ request('sort') == 'progress_high' ? 'selected' : '' }}>🔥 Presque financés</option>
                        </select>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-6 mt-2">
                    <button type="button" id="toggle-advanced" class="text-sm font-bold text-[#F5A623] hover:text-[#0A1128] transition-colors flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 transition-transform" id="advanced-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        Filtres avancés
                    </button>
                    
                    <div id="advanced-filters" class="hidden grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Date de début</label>
                            <input name="date_from" value="{{ request('date_from') }}" type="date" class="w-full h-14 px-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all"/>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Date de fin</label>
                            <input name="date_to" value="{{ request('date_to') }}" type="date" class="w-full h-14 px-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all"/>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-[#0A1128] mb-2 uppercase tracking-wider">Date limite avant</label>
                            <input name="deadline_before" value="{{ request('deadline_before') }}" type="date" class="w-full h-14 px-4 rounded-xl border-2 border-gray-200 focus:border-[#F5A623] focus:ring-4 focus:ring-[#F5A623]/20 text-base transition-all"/>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 items-center justify-between mt-6">
                    <div class="flex gap-3">
                        <button type="submit" class="bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold px-8 py-3 rounded-xl transition-all shadow-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filtrer
                        </button>
                        <a href="{{ route('projects.index') }}" class="bg-white border-2 border-gray-200 hover:border-[#0A1128] text-[#0A1128] font-bold px-8 py-3 rounded-xl transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Réinitialiser
                        </a>
                    </div>
                    <div class="text-sm text-slate-500 font-medium">
                        <span class="font-bold text-[#0A1128]">{{ $projects->total() ?? 0 }}</span> projet(s) trouvé(s)
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="container mx-auto px-4 pb-24">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg shadow-gray-200/40 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col group reveal">
                        
                        <div class="relative h-56 overflow-hidden bg-[#0A1128]">
                            @if($project->image)
                                <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90" src="{{ asset('storage/' . $project->image) }}"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-[#F5A623] text-5xl font-black">AK</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 to-transparent"></div>

                            <div class="absolute top-4 left-4 flex gap-2">
                                <span class="bg-white/90 backdrop-blur text-[#0A1128] text-[10px] font-black uppercase px-3 py-1.5 rounded-lg shadow-sm">
                                    {{ $project->category->name ?? 'Solidaire' }}
                                </span>
                                @if($project->currentAmount >= $project->goalAmount)
                                    <span class="bg-emerald-500 text-white text-[10px] font-black uppercase px-3 py-1.5 rounded-lg shadow-sm">
                                        ✓ Financé
                                    </span>
                                @endif
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <p class="text-xs font-bold uppercase tracking-widest text-[#F5A623] mb-1">{{ $project->association->name ?? 'Association' }}</p>
                                <h3 class="text-xl font-bold leading-tight">{{ Str::limit($project->title, 50) }}</h3>
                            </div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <p class="text-sm text-slate-600 mb-6 line-clamp-3 leading-relaxed">{{ Str::limit($project->description, 120) }}</p>

                            <div class="mb-6 mt-auto">
                                @php
                                    $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                    $percentage = min($percentage, 100);
                                @endphp
                                <div class="flex justify-between text-sm mb-2 font-bold">
                                    <span class="text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                    <span class="text-slate-400">{{ number_format($percentage, 0) }}%</span>
                                </div>
                                <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-[#F5A623] to-[#FFD085] rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-slate-400 mt-2 font-medium">
                                    <span>Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                    <span>Fin: {{ \Carbon\Carbon::parse($project->endDate)->format('d M Y') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('projects.show', $project->id) }}" class="w-full block text-center bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold py-3 rounded-xl transition-all shadow-lg group-hover:shadow-xl">
                                Soutenir ce projet →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center reveal">
                {{ $projects->links() }}
            </div>
        @else
            <div class="text-center py-20 px-4 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200 reveal">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-3xl font-black text-[#0A1128] mb-3">Aucun projet trouvé</h3>
                <p class="text-slate-500 mb-8 text-lg">Essayez de modifier vos critères de recherche.</p>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 bg-[#0A1128] hover:bg-[#F5A623] text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg">
                    Réinitialiser les filtres
                </a>
            </div>
        @endif
    </section>

    <footer class="bg-[#0A1128] text-white pt-16 pb-8">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-black mb-4 tracking-widest text-[#F5A623]">AL-KHAIR</h2>
            <p class="text-slate-400 text-sm mb-8">Plateforme marocaine de dons solidaires avec transparence totale.</p>
            <div class="border-t border-white/10 pt-8">
                <p class="text-xs text-slate-500">© 2026 Al-Khair. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Scroll Reveal Logic
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

            // Advanced Filters Toggle
            const toggleBtn = document.getElementById('toggle-advanced');
            const advancedFilters = document.getElementById('advanced-filters');
            const advancedIcon = document.getElementById('advanced-icon');

            if (toggleBtn && advancedFilters) {
                toggleBtn.addEventListener('click', () => {
                    advancedFilters.classList.toggle('hidden');
                    advancedIcon.style.transform = advancedFilters.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                });
            }
        });
    </script>
</body>
</html>