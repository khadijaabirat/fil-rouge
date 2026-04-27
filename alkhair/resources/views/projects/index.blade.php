<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tous les Projets | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .glass-nav { background: rgba(10,17,40,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-bottom: 1px solid rgba(245,166,35,0.15); }
        .card { background: #fff; border-radius: 1.25rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 6px 20px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(.4,0,.2,1); }
        .card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.1); transform: translateY(-6px); }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-20px)} }
        .float-animation { animation: float 6s ease-in-out infinite; }
        .progress-bar { background: linear-gradient(90deg, #F5A623 0%, #FFD085 50%, #F5A623 100%); background-size: 200% 100%; animation: shimmer 2s infinite; }
        @keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }
    </style>
</head>
<body class="bg-[#f0f2f5] text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white">

@include('partials.navbar')

    <section class="relative pt-28 pb-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0A1128]"></div>
        <div class="absolute top-1/3 left-1/4 w-72 h-72 bg-[#F5A623]/15 rounded-full blur-3xl float-animation"></div>
        <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl float-animation" style="animation-delay:2s"></div>

        <div class="container mx-auto px-4 relative z-10 text-center py-12">
            <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur text-white/90 px-4 py-1.5 rounded-full text-xs font-bold mb-6 border border-white/10">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                {{ $projects->total() ?? 0 }} Projets disponibles
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-4 leading-tight tracking-tight reveal active">
                Projets <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5A623] to-[#FFD085]">solidaires</span>
            </h1>
            <p class="text-lg text-blue-100/60 max-w-2xl mx-auto reveal active">Chaque projet est vérifié et transparent. Trouvez celui qui vous parle.</p>
        </div>
    </section>

    <section class="container mx-auto px-4 -mt-8 relative z-20 mb-12 reveal active">
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-black/[0.04]">
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $i => $project)
                    <div class="card flex flex-col group reveal" style="animation-delay:{{ ($i % 6) * 0.08 }}s">
                        
                        <div class="relative h-52 overflow-hidden bg-[#0A1128]">
                            @if($project->image)
                                <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ asset('storage/' . $project->image) }}"/>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center">
                                    <span class="text-[#F5A623]/30 text-6xl font-black">AK</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

                            <div class="absolute top-3 left-3 flex gap-1.5">
                                <span class="bg-white text-[#0A1128] text-[10px] font-bold px-2.5 py-1 rounded-lg shadow">
                                    {{ $project->category->name ?? 'Solidaire' }}
                                </span>
                                @if($project->currentAmount >= $project->goalAmount)
                                    <span class="bg-emerald-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-lg">✓ Financé</span>
                                @endif
                            </div>

                            <div class="absolute bottom-3 left-3 right-3 text-white">
                                <p class="text-[10px] font-bold text-[#F5A623] mb-0.5">{{ $project->association->name ?? 'Association' }}</p>
                                <h3 class="text-base font-bold leading-snug line-clamp-2">{{ $project->title }}</h3>
                            </div>
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <p class="text-xs text-slate-500 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit($project->description, 100) }}</p>

                            <div class="mb-4 mt-auto">
                                @php
                                    $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                    $percentage = min($percentage, 100);
                                @endphp
                                <div class="flex justify-between text-xs mb-1.5">
                                    <span class="font-bold text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                                    <span class="font-bold text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full progress-bar rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-[10px] text-slate-400 mt-1.5 font-medium">
                                    <span>Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                    <span>{{ \Carbon\Carbon::parse($project->endDate)->format('d M Y') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('projects.show', $project->id) }}" class="w-full block text-center bg-[#0A1128] hover:bg-[#F5A623] text-white hover:text-[#0A1128] font-bold text-sm py-3 rounded-xl transition-all">
                                Soutenir →
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

    @include('partials.footer')

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