<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Al-Khair | Plateforme Solidaire du Futur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <style data-purpose="custom-css">
        body { 
            font-family: 'Inter', sans-serif;
            background: #e8ecf3;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --brand-navy: #0A1128;
            --brand-gold: #F5A623;
            --brand-gold-hover: #F7B74A;
            --neu-bg: #e8ecf3;
            --neu-shadow-dark: #c5cad5;
            --neu-shadow-light: #ffffff;
        }
        
        /* Neumorphism Shadows */
        .neu-flat {
            background: #e8ecf3;
            box-shadow: 8px 8px 16px #c5cad5, -8px -8px 16px #ffffff;
        }
        
        .neu-pressed {
            background: #e8ecf3;
            box-shadow: inset 6px 6px 12px #c5cad5, inset -6px -6px 12px #ffffff;
        }
        
        .neu-float {
            background: #e8ecf3;
            box-shadow: 12px 12px 24px #c5cad5, -12px -12px 24px #ffffff;
        }
        
        .neu-card {
            background: linear-gradient(145deg, #f0f4f8, #e8ecf3);
            box-shadow: 10px 10px 20px #c5cad5, -10px -10px 20px #ffffff;
            border-radius: 30px;
        }
        
        .neu-card:hover {
            box-shadow: 15px 15px 30px #c5cad5, -15px -15px 30px #ffffff;
        }
        
        .neu-button {
            background: linear-gradient(145deg, #f0f4f8, #e0e5ec);
            box-shadow: 6px 6px 12px #c5cad5, -6px -6px 12px #ffffff;
            transition: all 0.3s ease;
        }
        
        .neu-button:hover {
            box-shadow: 8px 8px 16px #c5cad5, -8px -8px 16px #ffffff;
        }
        
        .neu-button:active {
            box-shadow: inset 4px 4px 8px #c5cad5, inset -4px -4px 8px #ffffff;
        }

        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        .blob { animation: float 10s infinite ease-in-out; }
        @keyframes float {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        /* Preloader */
        #preloader {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #e8ecf3 0%, #f0f4f8 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s, visibility 0.5s;
        }
        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
        }
        .loader-ring {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(245, 166, 35, 0.1);
            border-top-color: #F5A623;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Parallax */
        .parallax {
            transition: transform 0.1s ease-out;
        }

        /* Gradient Text Animation */
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .gradient-animate {
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }

         .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .counter { font-family: 'Courier New', monospace; letter-spacing: 0.1em; }
         @keyframes scroll-ticker {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }  
        }
        .animate-ticker {
            display: flex;
            width: max-content;
            animation: scroll-ticker 100s linear infinite;  
        }
         .ticker-container:hover .animate-ticker {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="bg-[#e8ecf3] text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white">

    <div id="preloader">
        <div class="text-center">
            <div class="loader-ring mx-auto mb-4"></div>
            <div class="flex items-center gap-2">
                <div class="bg-gradient-to-br from-[#F5A623] to-[#FFD085] p-2 rounded-xl font-black text-[#0A1128] text-xl shadow-md">AK</div>
                <h1 class="text-2xl font-black text-white">AL-KHAIR</h1>
            </div>
        </div>
    </div>

    <header id="main-nav" class="fixed w-full top-0 z-50 transition-all duration-300 bg-transparent py-4">
        <nav class="container mx-auto px-4 flex justify-between items-center bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 shadow-lg shadow-black/5">
            <a href="{{ url('/') }}" class="flex items-center group">
                <x-application-logo class="w-12 h-12 text-white group-hover:scale-105 transition-transform" />
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="#projets">Projets</a>
                <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="#impact">Impact</a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Dashboard Admin</a>
                    @elseif(Auth::user()->isAssociation())
                        <a href="{{ route('association.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Espace Association</a>
                    @elseif(Auth::user()->isDonator())
                        <a href="{{ route('donator.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Mon Espace</a>
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

    <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-20">
        <div id="particles-js" class="absolute inset-0 z-0"></div>
        
        <div class="absolute inset-0 z-0">
            <img alt="Morocco Atlas" class="w-full h-full object-cover parallax" data-speed="0.5" src="https://images.unsplash.com/photo-1542887800-faca0261c9e1?q=80&w=2000&auto=format&fit=crop"/>
            <div class="absolute inset-0 bg-gradient-to-tr from-[#0A1128] via-[#0A1128]/90 to-transparent"></div>
        </div>

        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-[#F5A623]/20 rounded-full blur-3xl blob z-0"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl blob z-0" style="animation-delay: 2s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl reveal">
                <div class="inline-flex items-center gap-2 glass text-white px-5 py-2 rounded-full text-xs font-bold mb-8 uppercase tracking-widest shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Plateforme Auditée & Sécurisée
                </div>
                <h2 class="text-6xl md:text-8xl font-black text-white mb-6 leading-[1.05] tracking-tight">
                    L'impact <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5A623] via-[#FFD085] to-[#F5A623] gradient-animate">qui change tout.</span>
                </h2>
                <p class="text-xl md:text-2xl text-blue-100/80 mb-10 leading-relaxed font-light max-w-2xl">
                    Soutenez les projets certifiés des associations marocaines. Suivez chaque dirham, de votre carte bancaire jusqu'au sourire du bénéficiaire.
                </p>
                <div class="flex flex-col sm:flex-row gap-5">
                    <a href="#projets" class="bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold text-lg px-8 py-4 rounded-2xl transition-all shadow-xl shadow-[#F5A623]/30 flex items-center justify-center gap-3">
                        Découvrir les causes
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 -mt-20 relative z-20 mb-24 reveal">
        <div class="glass-card rounded-[2rem] shadow-2xl p-8 md:p-12 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-0 md:divide-x divide-gray-200/50">

        <div class="text-center group">
                <div class="text-5xl font-black text-[#0A1128] mb-2">
                    <span class="counter" data-target="{{ $totalCollected ?? 0 }}">000000</span>
                </div>
                <div class="text-slate-500 font-bold uppercase tracking-widest text-sm">Dirhams collectés</div>
            </div>

            <div class="text-center group">
                <div class="text-5xl font-black text-[#0A1128] mb-2">
                    <span class="counter" data-target="{{ $verifiedAssociations ?? 0 }}">000000</span>
                </div>
                <div class="text-slate-500 font-bold uppercase tracking-widest text-sm">Assoc. Vérifiées</div>
            </div>

            <div class="text-center group">
                <div class="text-5xl font-black text-[#0A1128] mb-2">
                    <span class="counter" data-target="{{ $completedProjects ?? 0 }}">000000</span>
                </div>
                <div class="text-slate-500 font-bold uppercase tracking-widest text-sm">Projets Achevés</div>
            </div>

        </div>
    </section>
    
    <section id="projets" class="pt-10 pb-20 container mx-auto px-4 reveal">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h3 class="text-4xl font-black text-[#0A1128] mb-4 tracking-tight">Explorez par cause</h3>
            <p class="text-slate-500 text-lg">Sélectionnez une catégorie ci-dessous pour filtrer les projets instantanément.</p>
        </div>

        <form id="filter-form" action="{{ url()->current() }}" method="GET" class="max-w-5xl mx-auto mb-16">
            <div class="relative mb-8 group">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <svg class="h-6 w-6 text-slate-400 group-focus-within:text-[#F5A623] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input name="search" value="{{ request('search') }}" class="w-full h-16 pl-16 pr-6 rounded-2xl border-none bg-white shadow-lg shadow-gray-200/50 focus:ring-4 focus:ring-[#F5A623]/20 text-lg transition-all" placeholder="Chercher un projet, une ville..." type="text"/>
            </div>

            <input type="hidden" name="category" id="category-input" value="{{ request('category') }}">

            <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide snap-x">
                <button type="button" data-cat="" class="cat-pill snap-start whitespace-nowrap px-6 py-3 rounded-full font-bold text-sm transition-all {{ request('category') == '' ? 'bg-[#0A1128] text-white shadow-lg shadow-black/20 scale-105' : 'bg-white text-slate-600 hover:bg-gray-100 border border-gray-200' }}">
                    Toutes les urgences
                </button>
                @if(isset($categories))
                    @foreach($categories as $category)
                        <button type="button" data-cat="{{ $category->id }}" class="cat-pill snap-start whitespace-nowrap px-6 py-3 rounded-full font-bold text-sm transition-all {{ request('category') == $category->id ? 'bg-[#0A1128] text-white shadow-lg shadow-black/20 scale-105' : 'bg-white text-slate-600 hover:bg-gray-100 border border-gray-200' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                @endif
            </div>

            <button type="submit" id="submit-filter" class="hidden">Filtrer</button>
        </form>

        @if(isset($projects) && $projects->count() > 0)
        
            <div class="ticker-container overflow-hidden relative w-full py-10">
                
                <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-[#e8ecf3] to-transparent z-10 pointer-events-none"></div>
                <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-[#e8ecf3] to-transparent z-10 pointer-events-none"></div>

                <div class="animate-ticker flex gap-8">
                    
                    @foreach($projects as $project)
                        <div class="w-[300px] md:w-[380px] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-lg shadow-gray-200/40 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col group">
                            <div class="relative h-52 overflow-hidden">
                                @if($project->image)
                                    <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ asset('storage/' . $project->image) }}"/>
                                @elseif(isset($project->association) && $project->association->profilePhoto)
                                    <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ asset('storage/' . $project->association->profilePhoto) }}"/>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-[#F5A623] text-5xl font-black block mb-2">AK</span>
                                            <span class="text-white text-xs font-bold uppercase tracking-widest">{{ $project->category->name ?? 'Projet' }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/80 to-transparent"></div>

                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="bg-white/90 backdrop-blur text-[#0A1128] text-[10px] font-black uppercase px-3 py-1.5 rounded-lg shadow-sm">
                                        {{ $project->category->name ?? 'Solidaire' }}
                                    </span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-xs font-bold uppercase tracking-widest text-[#F5A623] mb-1">Assoc. {{ $project->association->name ?? 'Inconnue' }}</p>
                                    <h4 class="text-lg font-bold leading-tight">{{ Str::limit($project->title, 40) }}</h4>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
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
                                    <div class="h-full bg-gradient-to-r from-[#F5A623] to-[#FFD085] rounded-full relative" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <a href="{{ route('projects.show', $project->id) }}" class="w-full block text-center bg-gray-50 hover:bg-[#0A1128] text-[#0A1128] hover:text-white border border-gray-200 hover:border-[#0A1128] font-bold py-3 rounded-xl transition-colors">
                                    Soutenir
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @foreach($projects as $project)
                        <div class="w-[300px] md:w-[380px] flex-shrink-0 bg-white rounded-3xl overflow-hidden shadow-lg shadow-gray-200/40 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 border border-gray-100 flex flex-col group" aria-hidden="true">
                            <div class="relative h-52 overflow-hidden">
                                @if($project->image)
                                    <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ asset('storage/' . $project->image) }}"/>
                                @elseif(isset($project->association) && $project->association->profilePhoto)
                                    <img alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ asset('storage/' . $project->association->profilePhoto) }}"/>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-[#F5A623] text-5xl font-black block mb-2">AK</span>
                                            <span class="text-white text-xs font-bold uppercase tracking-widest">{{ $project->category->name ?? 'Projet' }}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/80 to-transparent"></div>

                                <div class="absolute top-4 left-4 flex gap-2">
                                    <span class="bg-white/90 backdrop-blur text-[#0A1128] text-[10px] font-black uppercase px-3 py-1.5 rounded-lg shadow-sm">
                                        {{ $project->category->name ?? 'Solidaire' }}
                                    </span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-xs font-bold uppercase tracking-widest text-[#F5A623] mb-1">Assoc. {{ $project->association->name ?? 'Inconnue' }}</p>
                                    <h4 class="text-lg font-bold leading-tight">{{ Str::limit($project->title, 40) }}</h4>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
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
                                    <div class="h-full bg-gradient-to-r from-[#F5A623] to-[#FFD085] rounded-full relative" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <a href="{{ route('projects.show', $project->id) }}" class="w-full block text-center bg-gray-50 hover:bg-[#0A1128] text-[#0A1128] hover:text-white border border-gray-200 hover:border-[#0A1128] font-bold py-3 rounded-xl transition-colors">
                                    Soutenir
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            
            <div class="mt-12 text-center reveal">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-3 bg-white text-[#0A1128] border-2 border-[#0A1128] font-black px-8 py-4 rounded-2xl hover:bg-[#0A1128] hover:text-[#F5A623] transition-all duration-300 shadow-lg group">
                    Explorer tous les projets
                    <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        @else
            <div class="text-center py-20 px-4 bg-white rounded-3xl shadow-sm border border-dashed border-gray-200 reveal">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-[#0A1128] mb-2">Aucun projet trouvé</h3>
                <p class="text-slate-500 mb-6">Essayez de modifier vos critères de recherche.</p>
                <a href="{{ url('/') }}" class="text-[#F5A623] font-bold hover:underline">← Réinitialiser les filtres</a>
            </div>
        @endif
    </section>

    <section id="impact" class="py-24 bg-white relative overflow-hidden reveal border-t border-gray-100">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold mb-6 border border-emerald-100">
                            <span class="text-lg leading-none">📸</span> 100% Transparence
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-[#0A1128] mb-6 tracking-tight leading-tight">
                            La confiance se construit par la <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-emerald-600">preuve visuelle.</span>
                        </h3>
                        <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                            Nous ne nous contentons pas de collecter des fonds. L'association est <strong class="text-[#0A1128]">strictement tenue</strong> de soumettre un <span class="text-[#0A1128] font-bold border-b-2 border-[#F5A623]">Impact Report indépendant</span> après la réalisation du projet.
                        </p>

                        <ul class="space-y-5 mb-10">
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold shadow-sm">✓</div>
                                <div>
                                    <h5 class="text-[#0A1128] font-bold">Photos et vidéos sur le terrain</h5>
                                    <p class="text-slate-500 text-sm mt-1">Des preuves tangibles de l'achèvement du projet.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 mt-0.5 font-bold shadow-sm">✓</div>
                                <div>
                                    <h5 class="text-[#0A1128] font-bold">Détails des bénéficiaires</h5>
                                    <p class="text-slate-500 text-sm mt-1">Explication claire de l'impact direct sur la communauté.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:w-1/2 relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100 to-[#F5A623]/20 rounded-[2.5rem] transform rotate-3 scale-105 opacity-50"></div>

                        <div class="bg-white rounded-[2rem] shadow-2xl border border-gray-100 p-6 relative z-10 transform -rotate-1 hover:rotate-0 transition-transform duration-500">
                            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xl">🌟</div>
                                    <div>
                                        <h4 class="font-bold text-[#0A1128] text-sm">Rapport d'Impact Approuvé</h4>
                                        <p class="text-xs text-slate-400">Il y a 2 jours</p>
                                    </div>
                                </div>
                                <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-lg text-xs font-bold">Objectif Atteint</span>
                            </div>
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop" alt="Preuve Visuelle" class="w-full h-48 object-cover rounded-xl mb-4 grayscale-[20%] hover:grayscale-0 transition-all">
                            <h5 class="font-black text-[#0A1128] text-lg mb-2">Construction du puits à Zagora</h5>
                            <p class="text-slate-500 text-sm mb-4 line-clamp-2">"Grâce à vos dons, plus de 150 familles ont désormais accès à l'eau potable au quotidien..."</p>
                            <div class="bg-gray-50 rounded-xl p-3 flex justify-between items-center border border-gray-100">
                                <span class="text-xs font-bold text-slate-500 uppercase">Fonds utilisés</span>
                                <span class="font-black text-emerald-600">45 000 DH</span>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -left-6 bg-[#0A1128] text-white p-4 rounded-2xl shadow-xl border border-white/10 z-20 animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center gap-3">
                                <div class="bg-[#F5A623] p-2 rounded-full text-[#0A1128]">🔒</div>
                                <div>
                                    <p class="text-xs text-slate-400 uppercase tracking-wider">Garantie</p>
                                    <p class="font-bold text-sm">100% Vérifié</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="py-20 lg:py-32 bg-gradient-to-br from-[#e8ecf3] via-white to-[#e8ecf3] relative reveal border-t border-gray-200 overflow-hidden">
        <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#F5A623]/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-50 to-emerald-100 border-2 border-emerald-200 text-emerald-700 rounded-full text-sm font-black mb-8 uppercase tracking-widest shadow-lg shadow-emerald-200/50 animate-bounce" style="animation-duration: 2s;">
                    <span class="text-2xl leading-none">📸</span> Impact Réel & Vérifié
                </div>
                <h3 class="text-5xl md:text-7xl font-black text-[#0A1128] mb-8 tracking-tight leading-[1.1]">
                    L'impact en <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 animate-pulse">images</span>
                </h3>
                <p class="text-slate-600 text-xl md:text-2xl font-light leading-relaxed">Découvrez les <strong class="text-[#0A1128] font-bold">sourires</strong> et les <strong class="text-[#0A1128] font-bold">vies changées</strong> grâce aux rapports d'impact soumis par nos associations partenaires.</p>
                <div class="mt-8 flex items-center justify-center gap-3">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 border-2 border-white shadow-lg"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 border-2 border-white shadow-lg"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#F5A623] to-[#FFD085] border-2 border-white shadow-lg"></div>
                    </div>
                    <p class="text-sm text-slate-500 font-bold">+150 rapports d'impact publiés</p>
                </div>
            </div>

            <div class="relative w-full mx-auto h-[600px] md:h-[800px] flex items-center justify-center mt-12 mb-20 overflow-visible">
                @php
                    $scatter = [
                        ['classes' => 'rotate-[4deg] -translate-x-24 md:-translate-x-[26rem] lg:-translate-x-[42rem] translate-y-16 z-[5] hidden xl:block'],
                        ['classes' => '-rotate-[8deg] -translate-x-16 md:-translate-x-[20rem] lg:-translate-x-[34rem] -translate-y-12 z-10 hidden lg:block'],
                        ['classes' => 'rotate-[6deg] -translate-x-20 md:-translate-x-[16rem] lg:-translate-x-[28rem] translate-y-24 z-20 hidden md:block'],
                        ['classes' => '-rotate-[5deg] -translate-x-12 md:-translate-x-[12rem] lg:-translate-x-[20rem] -translate-y-20 z-30 hidden sm:block'],
                        ['classes' => 'rotate-[4deg] -translate-x-8 md:-translate-x-[8rem] lg:-translate-x-[12rem] translate-y-32 z-40'],
                        ['classes' => '-rotate-[2deg] -translate-x-4 md:-translate-x-[4rem] lg:-translate-x-[4rem] -translate-y-8 z-50'],
                        ['classes' => 'rotate-[3deg] translate-x-4 md:translate-x-[2rem] lg:translate-x-[3rem] translate-y-12 z-[60]'],
                        ['classes' => '-rotate-[3deg] translate-x-8 md:translate-x-[8rem] lg:translate-x-[10rem] -translate-y-24 z-[55]'],
                        ['classes' => 'rotate-[5deg] translate-x-12 md:translate-x-[14rem] lg:translate-x-[18rem] translate-y-28 z-40'],
                        ['classes' => '-rotate-[6deg] translate-x-16 md:translate-x-[20rem] lg:translate-x-[26rem] -translate-y-12 z-30 hidden sm:block'],
                        ['classes' => 'rotate-[8deg] translate-x-20 md:translate-x-[26rem] lg:translate-x-[32rem] translate-y-8 z-20 hidden lg:block'],
                        ['classes' => '-rotate-[4deg] translate-x-24 md:translate-x-[30rem] lg:translate-x-[38rem] -translate-y-28 z-10 hidden xl:block'],
                        ['classes' => 'rotate-[7deg] translate-x-28 md:translate-x-[34rem] lg:translate-x-[44rem] translate-y-20 z-[15] hidden 2xl:block'],
                    ];
                @endphp

                @if(isset($impactReports) && count($impactReports) > 0)
                    @foreach($impactReports->take(13) as $index => $report)
                        @php
                            $proj = $report->project;
                            $style = $scatter[$index % 13]['classes'];
                        @endphp
                        
                        <a href="{{ route('projects.show', $proj->id) }}" 
                           class="absolute w-60 sm:w-72 md:w-80 bg-white p-3 pb-8 sm:p-4 sm:pb-12 rounded-lg shadow-2xl border border-gray-200 transform {{ $style }} hover:rotate-0 hover:z-[60] hover:scale-110 transition-all duration-500 cursor-pointer group">
                            
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-16 h-6 bg-white/40 backdrop-blur-md border border-white/60 shadow-sm transform -rotate-2 z-10 opacity-70 group-hover:opacity-0 transition-opacity"></div>

                            <div class="relative overflow-hidden rounded mb-4 shadow-inner bg-gray-100 h-48 sm:h-56 md:h-64">
                                @if($report->image)
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $proj->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @elseif($proj->image)
                                    <img src="{{ asset('storage/' . $proj->image) }}" alt="{{ $proj->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center">
                                        <span class="text-[#F5A623] text-4xl font-black">AK</span>
                                    </div>
                                @endif
                            </div>

                            <div class="px-2 text-center">
                                <h4 class="text-sm sm:text-base font-black text-[#0A1128] leading-tight mb-2 font-['Indie_Flower',sans-serif]">{{ Str::limit($proj->title, 30) }}</h4>
                                <div class="flex items-center justify-center gap-3">
                                    <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-wider">Impact Vérifié ✓</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>

            <div class="text-center mt-24 lg:mt-32">
                <p class="text-slate-500 mb-6 text-lg">Chaque projet est vérifié avec des preuves visuelles et des rapports détaillés</p>
                <a href="{{ route('impact.index') }}" class="inline-flex items-center gap-3 neu-button text-[#0A1128] font-black text-lg px-12 py-6 rounded-2xl group hover:shadow-2xl">
                    <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <span>Voir tous les rapports d'impact</span>
                    <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <div class="mt-8 flex items-center justify-center gap-8 text-sm">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-slate-600 font-bold">100% Vérifié</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse" style="animation-delay: 0.5s;"></div>
                        <span class="text-slate-600 font-bold">Photos Réelles</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-[#F5A623] rounded-full animate-pulse" style="animation-delay: 1s;"></div>
                        <span class="text-slate-600 font-bold">Impact Mesuré</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gradient-to-br from-[#0A1128] via-[#1a2744] to-[#0A1128] text-white relative overflow-hidden reveal">
        <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 0l30 30-30 30L0 30z\' fill=\'%23F5A623\' fill-opacity=\'0.4\'/%3E%3C/svg%3E');"></div>
        
        <div class="absolute top-0 right-0 w-[500px] h-[500px] border-[40px] border-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#F5A623]/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#F5A623]/20 border border-[#F5A623]/30 text-[#F5A623] rounded-full text-xs font-bold mb-6 uppercase tracking-widest">
                    <span class="text-lg leading-none">🇲🇦</span> Made in Morocco
                </div>
                <h3 class="text-5xl font-black mb-4 tracking-tight">Traçabilité Absolue.</h3>
                <p class="text-xl text-blue-200/60 font-light leading-relaxed">
                    De la carte bancaire à la réalisation sur le terrain. Un processus audité en 4 étapes garantit que votre don arrive à destination.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-3xl hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#F5A623]/20 transition-all duration-300 group">
                    <div class="text-[#F5A623] text-4xl font-black mb-6 opacity-50 group-hover:opacity-100 transition-opacity">01</div>
                    <div class="w-12 h-12 bg-[#F5A623]/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Vérification (KYC)</h4>
                    <p class="text-sm text-blue-100/60 leading-relaxed">Chaque association est légalement auditée avant de rejoindre la plateforme.</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-3xl hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#F5A623]/20 transition-all duration-300 group">
                    <div class="text-[#F5A623] text-4xl font-black mb-6 opacity-50 group-hover:opacity-100 transition-opacity">02</div>
                    <div class="w-12 h-12 bg-[#F5A623]/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Collecte Sécurisée</h4>
                    <p class="text-sm text-blue-100/60 leading-relaxed">Vos dons sont sécurisés (Stripe) et bloqués tant que l'objectif n'est pas atteint.</p>
                </div>
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-3xl hover:-translate-y-2 hover:shadow-2xl hover:shadow-[#F5A623]/20 transition-all duration-300 group">
                    <div class="text-[#F5A623] text-4xl font-black mb-6 opacity-50 group-hover:opacity-100 transition-opacity">03</div>
                    <div class="w-12 h-12 bg-[#F5A623]/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold mb-3">Transfert (Processing)</h4>
                    <p class="text-sm text-blue-100/60 leading-relaxed">L'administrateur valide le virement vers le RIB officiel de l'association.</p>
                </div>
                <div class="bg-gradient-to-br from-[#F5A623] to-[#FFD085] p-8 rounded-3xl text-[#0A1128] hover:-translate-y-2 hover:scale-105 transition-all duration-300 shadow-2xl shadow-[#F5A623]/30 group">
                    <div class="text-[#0A1128] text-4xl font-black mb-6 opacity-50 group-hover:opacity-100 transition-opacity">04</div>
                    <div class="w-12 h-12 bg-[#0A1128]/20 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#0A1128]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-black mb-3">Preuve (Impact)</h4>
                    <p class="text-sm font-medium leading-relaxed">Le projet est bloqué jusqu'à publication d'un rapport avec photos des réalisations.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white relative overflow-hidden reveal">
        <div class="absolute top-0 left-0 w-64 h-64 bg-[#F5A623]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#F5A623]/10 border border-[#F5A623]/20 text-[#F5A623] rounded-full text-xs font-bold mb-6 uppercase tracking-widest">
                    <span class="text-lg leading-none">⭐</span> Témoignages
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-[#0A1128] mb-4 tracking-tight">Ils nous font confiance</h3>
                <p class="text-slate-500 text-lg">Découvrez les histoires de ceux qui ont fait la différence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#F5A623] to-[#FFD085] flex items-center justify-center text-white text-xl font-black shadow-lg">A</div>
                        <div>
                            <h5 class="font-bold text-[#0A1128]">Ahmed Benali</h5>
                            <p class="text-xs text-slate-500 font-medium">Donateur à Casablanca</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 leading-relaxed italic">"La transparence est totale! J'ai vu les photos de l'école construite grâce à mes dons. C'est exactement ce que je cherchais!"</p>
                    <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                        <span class="text-[#F5A623] font-black">2,500 DH</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xl font-black shadow-lg">F</div>
                        <div>
                            <h5 class="font-bold text-[#0A1128]">Fatima Zahra</h5>
                            <p class="text-xs text-slate-500 font-medium">Donatrice à Rabat</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 leading-relaxed italic">"Une plateforme sécurisée et professionnelle. J'ai reçu des notifications à chaque étape. Bravo pour cette initiative marocaine!"</p>
                    <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                        <span class="text-emerald-600 font-black">1,200 DH</span>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xl font-black shadow-lg">Y</div>
                        <div>
                            <h5 class="font-bold text-[#0A1128]">Youssef Alami</h5>
                            <p class="text-xs text-slate-500 font-medium">Donateur à Marrakech</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-4">
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-[#F5A623]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-slate-600 leading-relaxed italic">"Enfin une plateforme digne de confiance! Le rapport d'impact avec la vidéo m'a vraiment touché. Je recommande à 100%."</p>
                    <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                        <span class="text-blue-600 font-black">5,000 DH</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white relative overflow-hidden reveal">
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#F5A623]/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[#F5A623]/10 border border-[#F5A623]/20 text-[#F5A623] rounded-full text-xs font-bold mb-6 uppercase tracking-widest">
                    <span class="text-lg leading-none">❓</span> Questions Fréquentes
                </div>
                <h3 class="text-4xl md:text-5xl font-black text-[#0A1128] mb-4 tracking-tight">Vous avez des questions?</h3>
                <p class="text-slate-500 text-lg">Nous avons les réponses. Découvrez comment AL-KHAIR fonctionne.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center gap-4 group">
                        <span class="font-bold text-[#0A1128] text-lg group-hover:text-[#F5A623] transition-colors">Comment puis-je être sûr que mon don arrive à destination?</span>
                        <svg class="w-6 h-6 text-[#F5A623] transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            <p class="mb-3">AL-KHAIR garantit une <strong class="text-[#0A1128]">traçabilité absolue</strong> en 4 étapes:</p>
                            <ul class="space-y-2 ml-4">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#F5A623] font-bold">1.</span>
                                    <span>Vérification KYC de l'association avant inscription</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#F5A623] font-bold">2.</span>
                                    <span>Paiement sécurisé via Stripe (cryptage SSL)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#F5A623] font-bold">3.</span>
                                    <span>Transfert validé par l'administrateur vers le RIB officiel</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#F5A623] font-bold">4.</span>
                                    <span>Rapport d'impact obligatoire avec photos/vidéos du projet réalisé</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center gap-4 group">
                        <span class="font-bold text-[#0A1128] text-lg group-hover:text-[#F5A623] transition-colors">Quel est le montant minimum pour faire un don?</span>
                        <svg class="w-6 h-6 text-[#F5A623] transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            Le montant minimum est de <strong class="text-[#F5A623] text-xl">100 DH</strong>. Ce seuil permet de couvrir les frais de transaction et garantit un impact réel sur le terrain. Chaque dirham compte!
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center gap-4 group">
                        <span class="font-bold text-[#0A1128] text-lg group-hover:text-[#F5A623] transition-colors">Puis-je faire un don anonyme?</span>
                        <svg class="w-6 h-6 text-[#F5A623] transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            Oui, absolument! Lors du processus de don, vous pouvez cocher l'option <strong class="text-[#0A1128]">"Don anonyme"</strong>. Votre nom ne sera pas affiché publiquement dans la liste des contributeurs, mais vous recevrez toujours votre reçu et les notifications de suivi.
                        </div>
                    </div>
                </div>

                <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <button class="faq-question w-full text-left p-6 flex justify-between items-center gap-4 group">
                        <span class="font-bold text-[#0A1128] text-lg group-hover:text-[#F5A623] transition-colors">Comment les associations sont-elles vérifiées?</span>
                        <svg class="w-6 h-6 text-[#F5A623] transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                            Chaque association doit passer par un <strong class="text-[#0A1128]">processus KYC (Know Your Customer)</strong> rigoureux:
                            <ul class="mt-3 space-y-2 ml-4">
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500">✓</span>
                                    <span>Upload du document légal (récépissé, statuts...)</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500">✓</span>
                                    <span>Vérification du numéro de licence officiel</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500">✓</span>
                                    <span>Validation manuelle par l'administrateur</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-500">✓</span>
                                    <span>Vérification du RIB bancaire officiel</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <p class="text-slate-500 mb-4">Vous avez d'autres questions?</p>
                <a href="mailto:contact@alkhair.ma" class="inline-flex items-center gap-2 bg-[#0A1128] hover:bg-[#F5A623] text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contactez-nous
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gradient-to-br from-[#0A1128] via-[#1a2744] to-[#0A1128] text-white relative overflow-hidden reveal">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'80\' height=\'80\' viewBox=\'0 0 80 80\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23F5A623\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z\' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#F5A623]/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-5 py-2 bg-[#F5A623]/20 border border-[#F5A623]/30 text-[#F5A623] rounded-full text-xs font-bold mb-8 uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-[#F5A623] animate-pulse"></span>
                    Rejoignez le mouvement
                </div>
                
                <h3 class="text-5xl md:text-6xl font-black mb-6 tracking-tight leading-tight">
                    Prêt à faire la <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F5A623] to-[#FFD085]">différence</span>?
                </h3>
                
                <p class="text-xl md:text-2xl text-blue-100/70 mb-12 leading-relaxed font-light max-w-2xl mx-auto">
                    Chaque dirham compte. Chaque projet change des vies. Commencez votre parcours solidaire aujourd'hui.
                </p>

                <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                    <a href="{{ route('register') }}" class="group bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-black text-lg px-10 py-5 rounded-2xl transition-all shadow-2xl shadow-[#F5A623]/40 flex items-center gap-3">
                        Créer un compte
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                    <a href="#projets" class="group bg-white/10 backdrop-blur-sm border-2 border-white/30 hover:bg-white/20 text-white font-bold text-lg px-10 py-5 rounded-2xl transition-all flex items-center gap-3">
                        Explorer les projets
                        <svg class="w-6 h-6 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gradient-to-br from-gray-50 to-white pt-16 pb-8 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div>
                    <a href="{{ url('/') }}" class="inline-block mb-4">
                        <x-application-logo class="w-32 h-32 text-[#0A1128]" />
                    </a>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Plateforme marocaine de dons solidaires avec transparence totale.
                    </p>
                </div>

                <div>
                    <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-4">Navigation</h6>
                    <ul class="space-y-2 text-slate-600 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-[#F5A623] transition-colors">Accueil</a></li>
                        <li><a href="{{ route('projects.index') }}" class="hover:text-[#F5A623] transition-colors">Projets</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-[#F5A623] transition-colors">S'inscrire</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-4">Contact</h6>
                    <ul class="space-y-2 text-slate-600 text-sm">
                        <li>Email: contact@alkhair.ma</li>
                        <li>Tél: +212 5 00 00 00 00</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-200 text-center">
                <p class="text-sm text-slate-500">© 2026 Al-Khair. Conçu avec passion au Maroc 🇲🇦</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Navbar Scroll Effect (Glassmorphism on scroll)
            const navbar = document.getElementById('main-nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('bg-[#0A1128]/80', 'backdrop-blur-xl', 'shadow-xl');
                    navbar.classList.remove('bg-transparent', 'py-4');
                    navbar.classList.add('py-2');
                } else {
                    navbar.classList.remove('bg-[#0A1128]/80', 'backdrop-blur-xl', 'shadow-xl');
                    navbar.classList.add('bg-transparent', 'py-4');
                    navbar.classList.remove('py-2');
                }
            });

            // 2. Interactive Category Pills (Auto-Submit Form)
            const catPills = document.querySelectorAll('.cat-pill');
            const catInput = document.getElementById('category-input');
            const form = document.getElementById('filter-form');

            catPills.forEach(pill => {
                pill.addEventListener('click', () => {
                    catInput.value = pill.getAttribute('data-cat');
                    pill.innerHTML = `<svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
                    form.submit();
                });
            });

            // 3. Scroll Reveal Animations (Intersection Observer)
            const reveals = document.querySelectorAll('.reveal');
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.15 };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);  
                    }
                });
            }, observerOptions);

            reveals.forEach(reveal => revealObserver.observe(reveal));

            // 4. Number Counter Animation for Stats
            const counters = document.querySelectorAll('.counter');
            const animationDuration = 2500;
            const targetDigits = 6;

            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseFloat(counter.getAttribute('data-target')) || 0;
                        let startTime = null;

                        const updateCount = (currentTime) => {
                            if (!startTime) startTime = currentTime;
                            const progress = currentTime - startTime;
                            
                            const percentage = Math.min(progress / animationDuration, 1);
                            const easeOut = 1 - Math.pow(1 - percentage, 3);
                            const currentVal = Math.floor(target * easeOut);
                            
                            counter.innerText = currentVal.toString().padStart(targetDigits, '0');

                            if (progress < animationDuration) {
                                requestAnimationFrame(updateCount);
                            } else {
                                counter.innerText = Math.floor(target).toString().padStart(targetDigits, '0');
                            }
                        };
                        
                        requestAnimationFrame(updateCount);
                        observer.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(counter => counterObserver.observe(counter));

            // 5. Preloader
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.getElementById('preloader').classList.add('hidden');
                }, 800);
            });

            // 6. Particles.js Configuration
            if (typeof particlesJS !== 'undefined') {
                particlesJS('particles-js', {
                    particles: {
                        number: { value: 60, density: { enable: true, value_area: 800 } },
                        color: { value: '#F5A623' },
                        shape: { type: 'circle' },
                        opacity: { value: 0.3, random: true },
                        size: { value: 3, random: true },
                        line_linked: {
                            enable: true,
                            distance: 150,
                            color: '#F5A623',
                            opacity: 0.2,
                            width: 1
                        },
                        move: {
                            enable: true,
                            speed: 1.5,
                            direction: 'none',
                            random: false,
                            straight: false,
                            out_mode: 'out',
                            bounce: false
                        }
                    },
                    interactivity: {
                        detect_on: 'canvas',
                        events: {
                            onhover: { enable: true, mode: 'grab' },
                            onclick: { enable: true, mode: 'push' },
                            resize: true
                        },
                        modes: {
                            grab: { distance: 140, line_linked: { opacity: 0.5 } },
                            push: { particles_nb: 4 }
                        }
                    },
                    retina_detect: true
                });
            }

            // 7. FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                const answer = item.querySelector('.faq-answer');
                const icon = question.querySelector('svg');

                question.addEventListener('click', () => {
                    const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
                    
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            const otherAnswer = otherItem.querySelector('.faq-answer');
                            const otherIcon = otherItem.querySelector('.faq-question svg');
                            otherAnswer.style.maxHeight = '0';
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    });

                    if (isOpen) {
                        answer.style.maxHeight = '0';
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });

            // 8. Smooth Scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && document.querySelector(href)) {
                        e.preventDefault();
                        document.querySelector(href).scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // 9. Back to Top Button
            const backToTop = document.createElement('button');
            backToTop.innerHTML = `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>`;
            backToTop.className = 'fixed bottom-8 right-8 bg-[#F5A623] hover:bg-[#0A1128] text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition-all duration-300 z-50 opacity-0 invisible hover:scale-110';
            backToTop.id = 'back-to-top';
            document.body.appendChild(backToTop);

            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    backToTop.classList.remove('opacity-0', 'invisible');
                    backToTop.classList.add('opacity-100', 'visible');
                } else {
                    backToTop.classList.add('opacity-0', 'invisible');
                    backToTop.classList.remove('opacity-100', 'visible');
                }
            });

            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>