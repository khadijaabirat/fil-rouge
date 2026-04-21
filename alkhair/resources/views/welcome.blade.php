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

        <!-- Preloader -->
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
            <!-- Particles Background -->
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
                        <span class="counter" data-target="{{ $totalCollected }}">000000</span>
                    </div>
                    <div class="text-slate-500 font-bold uppercase tracking-widest text-sm">Dirhams collectés</div>
                </div>

                <div class="text-center group">
                    <div class="text-5xl font-black text-[#0A1128] mb-2">
                        <span class="counter" data-target="{{ $verifiedAssociations }}">000000</span>
                    </div>
                    <div class="text-slate-500 font-bold uppercase tracking-widest text-sm">Assoc. Vérifiées</div>
                </div>

                <div class="text-center group">
                    <div class="text-5xl font-black text-[#0A1128] mb-2">
                        <span class="counter" data-target="{{ $completedProjects }}">000000</span>
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
                    @foreach($categories as $category)
                        <button type="button" data-cat="{{ $category->id }}" class="cat-pill snap-start whitespace-nowrap px-6 py-3 rounded-full font-bold text-sm transition-all {{ request('category') == $category->id ? 'bg-[#0A1128] text-white shadow-lg shadow-black/20 scale-105' : 'bg-white text-slate-600 hover:bg-gray-100 border border-gray-200' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                <button type="submit" id="submit-filter" class="hidden">Filtrer</button>
            </form>

           @if($projects->count() > 0)
          
                <div class="ticker-container overflow-hidden relative w-full py-10">
                    
                    <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-[#F8FAFC] to-transparent z-10 pointer-events-none"></div>
                    <div class="absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-[#F8FAFC] to-transparent z-10 pointer-events-none"></div>

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
                </div> <div class="mt-12 text-center reveal">
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
    <section class="py-24 bg-white relative overflow-hidden reveal border-t border-gray-100">
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
            <!-- Animated Background Blobs -->
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

                <!-- Staggered Overlapping Cards Layout with Enhanced Animations -->
                <div class="max-w-7xl mx-auto px-6 lg:px-8 relative" style="min-height: 900px;">
                    @php
                        $completedProjects = $projects->take(8);
                        $positions = [
                            ['top' => '0', 'right' => '0', 'left' => 'auto', 'rotate' => 'rotate-2', 'z' => 'z-10', 'size' => 'w-72 lg:w-80'],
                            ['top' => '8rem', 'left' => '0', 'right' => 'auto', 'rotate' => '-rotate-3', 'z' => 'z-10', 'size' => 'w-72 lg:w-80'],
                            ['top' => '5rem', 'right' => '25%', 'left' => 'auto', 'rotate' => 'rotate-1', 'z' => 'z-20', 'size' => 'w-80 lg:w-96', 'featured' => true],
                            ['top' => '20rem', 'left' => '2.5rem', 'right' => 'auto', 'rotate' => 'rotate-2', 'z' => 'z-15', 'size' => 'w-72 lg:w-80'],
                            ['top' => '24rem', 'right' => '2.5rem', 'left' => 'auto', 'rotate' => '-rotate-2', 'z' => 'z-12', 'size' => 'w-72 lg:w-80', 'hidden' => 'hidden lg:block'],
                            ['bottom' => '8rem', 'left' => '25%', 'right' => 'auto', 'rotate' => 'rotate-3', 'z' => 'z-18', 'size' => 'w-72 lg:w-80', 'hidden' => 'hidden md:block'],
                            ['bottom' => '2.5rem', 'right' => '8rem', 'left' => 'auto', 'rotate' => '-rotate-1', 'z' => 'z-16', 'size' => 'w-72', 'hidden' => 'hidden lg:block'],
                            ['bottom' => '12rem', 'left' => '8rem', 'right' => 'auto', 'rotate' => 'rotate-1', 'z' => 'z-14', 'size' => 'w-72', 'hidden' => 'hidden xl:block'],
                        ];
                    @endphp

                    @foreach($completedProjects as $index => $project)
                        @php
                            $pos = $positions[$index] ?? $positions[0];
                            $isFeatured = isset($pos['featured']) && $pos['featured'];
                        @endphp
                        <a href="{{ route('projects.show', $project->id) }}" class="absolute {{ $pos['size'] }} neu-{{ $isFeatured ? 'float' : 'card' }} p-{{ $isFeatured ? '6' : '5' }} transform {{ $pos['rotate'] }} hover:rotate-0 hover:z-40 hover:scale-110 transition-all duration-500 cursor-pointer {{ $pos['z'] }} {{ $pos['hidden'] ?? '' }} group"
                             style="{{ isset($pos['top']) ? 'top: ' . $pos['top'] : '' }}; {{ isset($pos['bottom']) ? 'bottom: ' . $pos['bottom'] : '' }}; {{ isset($pos['left']) ? 'left: ' . $pos['left'] : '' }}; {{ isset($pos['right']) ? 'right: ' . $pos['right'] : '' }};">
                            
                            @if($isFeatured)
                                <div class="absolute -top-3 -right-3 bg-gradient-to-br from-[#F5A623] to-[#FFD085] text-white px-4 py-2 rounded-xl text-xs font-black shadow-lg z-10 animate-bounce" style="animation-duration: 2s;">
                                    ⭐ POPULAIRE
                                </div>
                            @endif

                            <div class="relative overflow-hidden rounded-2xl mb-4">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-{{ $isFeatured ? '56' : '48' }} object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-{{ $isFeatured ? '56' : '48' }} bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center">
                                        <span class="text-[#F5A623] text-4xl font-black">{{ $project->category->name ?? 'AK' }}</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/{{ $isFeatured ? '60' : '50' }} to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <div class="flex justify-between items-start mb-{{ $isFeatured ? '3' : '2' }}">
                                <h4 class="text-{{ $isFeatured ? '2xl' : 'xl' }} font-black text-[#0A1128] group-hover:text-[#F5A623] transition-colors">{{ Str::limit($project->title, 30) }}</h4>
                                <div class="neu-pressed px-3 py-1.5 rounded-lg text-xs font-bold text-[#F5A623] shadow-sm">{{ $project->category->name ?? 'Projet' }}</div>
                            </div>

                            <p class="text-sm text-slate-600 leading-relaxed mb-{{ $isFeatured ? '4' : '3' }}">{{ Str::limit($project->description, 60) }}</p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-{{ $isFeatured ? 'sm' : 'xs' }} text-emerald-600">
                                    <svg class="w-{{ $isFeatured ? '5' : '4' }} h-{{ $isFeatured ? '5' : '4' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="font-bold">{{ $isFeatured ? 'Impact Vérifié' : 'Vérifié' }}</span>
                                </div>
                                <span class="text-{{ $isFeatured ? 'sm' : 'xs' }} font-black text-{{ $isFeatured ? '[#F5A623]' : 'slate-400' }}">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</span>
                            </div>
                        </a>
                    @endforeach

                </div>

                <div class="text-center mt-24 lg:mt-32">
                    <p class="text-slate-500 mb-6 text-lg">Chaque projet est vérifié avec des preuves visuelles et des rapports détaillés</p>
                    <a href="#" class="inline-flex items-center gap-3 neu-button text-[#0A1128] font-black text-lg px-12 py-6 rounded-2xl group hover:shadow-2xl">
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
            <!-- Moroccan Pattern Overlay -->
            <div class="absolute inset-0 opacity-5" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0l30 30-30 30L0 30z' fill='%23F5A623' fill-opacity='0.4'/%3E%3C/svg%3E');"></div>
            
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

        <!-- Testimonials Section - Moroccan Style -->
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
                    <!-- Testimonial 1 -->
                    <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-[#F5A623] to-[#FFD085] flex items-center justify-center text-white text-xl font-black shadow-lg">
                                A
                            </div>
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
                        <p class="text-slate-600 leading-relaxed italic">"الشفافية الكاملة! رأيت بعيني صور المدرسة التي ساهمت في بنائها. هذا ما كنت أبحث عنه!"</p>
                        <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                            <span class="text-[#F5A623] font-black">2,500 DH</span>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-xl font-black shadow-lg">
                                F
                            </div>
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
                        <p class="text-slate-600 leading-relaxed italic">"Plateforme sécurisée et professionnelle. J'ai reçu des notifications à chaque étape. Bravo pour cette initiative marocaine!"</p>
                        <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                            <span class="text-emerald-600 font-black">1,200 DH</span>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-3xl border border-gray-100 shadow-lg shadow-gray-200/50 hover:-translate-y-2 transition-all duration-300 group">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-xl font-black shadow-lg">
                                Y
                            </div>
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
                        <p class="text-slate-600 leading-relaxed italic">"Enfin une plateforme digne de confiance! Le rapport d'impact avec vidéo m'a vraiment touché. Je recommande à 100%."</p>
                        <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-400 uppercase">Don effectué</span>
                            <span class="text-blue-600 font-black">5,000 DH</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section - Moroccan Inspired -->
        <section class="py-24 bg-gradient-to-br from-[#0A1128] via-[#1a2744] to-[#0A1128] text-white relative overflow-hidden reveal">
            <!-- Moroccan Geometric Pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23F5A623' fill-opacity='0.4'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            
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

                    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20">
                                <svg class="w-8 h-8 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <h5 class="font-bold text-lg mb-2">100% Sécurisé</h5>
                            <p class="text-sm text-blue-100/60">Paiements cryptés SSL</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20">
                                <svg class="w-8 h-8 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <h5 class="font-bold text-lg mb-2">Associations Vérifiées</h5>
                            <p class="text-sm text-blue-100/60">Audit KYC obligatoire</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 border border-white/20">
                                <svg class="w-8 h-8 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <h5 class="font-bold text-lg mb-2">Transparence Totale</h5>
                            <p class="text-sm text-blue-100/60">Rapports d'impact obligatoires</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
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
                    <!-- FAQ Item 1 -->
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

                    <!-- FAQ Item 2 -->
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

                    <!-- FAQ Item 3 -->
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

                    <!-- FAQ Item 4 -->
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

                    <!-- FAQ Item 5 -->
                    <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-all duration-300">
                        <button class="faq-question w-full text-left p-6 flex justify-between items-center gap-4 group">
                            <span class="font-bold text-[#0A1128] text-lg group-hover:text-[#F5A623] transition-colors">Que se passe-t-il si un projet n'atteint pas son objectif?</span>
                            <svg class="w-6 h-6 text-[#F5A623] transform transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                            <div class="p-6 pt-0 text-slate-600 leading-relaxed">
                                L'association a deux options:
                                <div class="mt-3 space-y-3">
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                                        <strong class="text-blue-900">Option 1: Prolongation</strong>
                                        <p class="text-sm text-blue-700 mt-1">L'association peut prolonger la date limite depuis son tableau de bord pour donner une chance supplémentaire de collecter les fonds restants.</p>
                                    </div>
                                    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded">
                                        <strong class="text-emerald-900">Option 2: Clôture et transfert</strong>
                                        <p class="text-sm text-emerald-700 mt-1">Le montant collecté (même incomplet) est transféré. L'association doit utiliser les fonds pour réaliser ce qui peut l'être et publier un rapport d'impact justifié.</p>
                                    </div>
                                </div>
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

        <footer class="bg-gradient-to-br from-gray-50 to-white pt-24 pb-12 border-t border-gray-200 reveal relative overflow-hidden">
            <!-- Moroccan Pattern Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#F5A623]/5 rounded-full blur-3xl"></div>
            
            <div class="container mx-auto px-4 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-gradient-to-br from-[#0A1128] to-[#1a2744] p-3 rounded-xl font-black text-[#F5A623] text-xl shadow-lg">
                                AK
                            </div>
                            <div>
                                <h5 class="text-2xl font-black text-[#0A1128] leading-none tracking-tight">AL-KHAIR</h5>
                                <p class="text-[10px] text-[#F5A623] font-bold tracking-widest uppercase">Plateforme Certifiée 2026</p>
                            </div>
                        </div>
                        <p class="text-slate-600 leading-relaxed mb-6 max-w-sm">
                            La première plateforme marocaine garantissant une transparence totale des dons solidaires. Développée avec ❤️ pour le Maroc.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1.5 bg-[#0A1128] text-white rounded-lg text-xs font-bold shadow-sm">Laravel 11</span>
                            <span class="px-3 py-1.5 bg-[#F5A623] text-[#0A1128] rounded-lg text-xs font-bold shadow-sm">Tailwind CSS</span>
                            <span class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-bold shadow-sm">Stripe</span>
                        </div>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-[#0A1128] hover:bg-[#F5A623] text-white rounded-xl flex items-center justify-center transition-all shadow-sm hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#0A1128] hover:bg-[#F5A623] text-white rounded-xl flex items-center justify-center transition-all shadow-sm hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-[#0A1128] hover:bg-[#F5A623] text-white rounded-xl flex items-center justify-center transition-all shadow-sm hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-6 flex items-center gap-2">
                            <span class="w-1 h-4 bg-[#F5A623] rounded-full"></span>
                            Plateforme
                        </h6>
                        <ul class="space-y-3 text-slate-600 font-medium">
                            <li><a class="hover:text-[#F5A623] transition-colors flex items-center gap-2 group" href="#projets">
                                <span class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-[#F5A623] transition-colors"></span>
                                Découvrir les projets
                            </a></li>
                            <li><a class="hover:text-[#F5A623] transition-colors flex items-center gap-2 group" href="{{ route('register') }}">
                                <span class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-[#F5A623] transition-colors"></span>
                                Devenir Donateur
                            </a></li>
                            <li><a class="hover:text-[#F5A623] transition-colors flex items-center gap-2 group" href="{{ route('register') }}">
                                <span class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-[#F5A623] transition-colors"></span>
                                Inscrire une association
                            </a></li>
                            <li><a class="hover:text-[#F5A623] transition-colors flex items-center gap-2 group" href="#impact">
                                <span class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-[#F5A623] transition-colors"></span>
                                Comment ça marche
                            </a></li>
                        </ul>
                    </div>

                    <div>
                        <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-6 flex items-center gap-2">
                            <span class="w-1 h-4 bg-[#F5A623] rounded-full"></span>
                            Contact
                        </h6>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-[#F5A623]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Email</p>
                                    <a href="mailto:contact@alkhair.ma" class="text-slate-600 font-medium hover:text-[#F5A623] transition-colors">contact@alkhair.ma</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-[#F5A623]/10 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-[#F5A623]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-1">Téléphone</p>
                                    <p class="text-slate-600 font-medium">+212 5 00 00 00 00</p>
                                </div>
                            </li>
                        </ul>
                        <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-xs font-bold border border-emerald-100 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Système Opérationnel
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                            <span class="text-lg">🇲🇦</span>
                            <p>© 2026 Al-Khair. Conçu et développé avec passion au Maroc.</p>
                        </div>
                        <div class="flex gap-6 text-sm">
                            <a href="#" class="text-slate-500 hover:text-[#0A1128] transition-colors font-medium">Confidentialité</a>
                            <a href="#" class="text-slate-500 hover:text-[#0A1128] transition-colors font-medium">Termes & Conditions</a>
                            <a href="#" class="text-slate-500 hover:text-[#0A1128] transition-colors font-medium">Mentions Légales</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

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



            // 4. Number Counter Animation for Stats (6 digits with leading zeros)
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
