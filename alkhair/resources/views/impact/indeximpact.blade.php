<!DOCTYPE html>
<html class="light scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>L'Archive Éthique - Rapports d'Impact | AL-KHAIR</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
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
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fb; }
        h1, h2, h3, h4, h5, .font-headline { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .glass-nav { background: rgba(2, 28, 54, 0.95); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        
        /* Reveal Animation */
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.5, 0, 0, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased selection:bg-secondary-container selection:text-primary-container">

    <header class="fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="glass-nav w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-3">
                        <div class="bg-gradient-to-br from-[#F5A623] to-[#FFD085] p-2 rounded-xl font-black text-[#0A1128] text-xl shadow-md">AK</div>
                        <a href="{{ url('/') }}" class="flex flex-col">
                            <span class="text-2xl font-black text-white drop-shadow-md leading-none tracking-tight font-headline">AL-KHAIR</span>
                            <span class="text-[10px] text-[#F5A623] font-bold tracking-widest uppercase">Certifié 2026</span>
                        </a>
                    </div>
                    
                    <div class="hidden md:flex items-center gap-8">
                        <a class="text-white/90 font-medium hover:text-secondary-container transition-colors" href="{{ url('/') }}">Accueil</a>
                        <a class="text-secondary-container font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-secondary-container" href="{{ route('impact.index') }}">Impact</a>
                        <a class="text-white/90 font-medium hover:text-secondary-container transition-colors" href="{{ route('projects.index') }}">Projets</a>
                        
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-white/90 font-medium hover:text-secondary-container transition">Dashboard</a>
                            @elseif(Auth::user()->isAssociation())
                                <a href="{{ route('association.dashboard') }}" class="text-white/90 font-medium hover:text-secondary-container transition">Mon Espace</a>
                            @elseif(Auth::user()->isDonator())
                                <a href="{{ route('donator.dashboard') }}" class="text-white/90 font-medium hover:text-secondary-container transition">Mon Espace</a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="bg-white/10 hover:bg-error/20 border border-white/20 text-white text-sm font-bold px-5 py-2 rounded-xl transition-all shadow-sm">Quitter</button>
                            </form>
                        @else
                            <a class="text-white/90 font-medium hover:text-secondary-container transition" href="{{ route('login') }}">Connexion</a>
                            <a class="bg-gradient-to-r from-secondary-container to-yellow-300 hover:scale-105 text-primary-container font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg shadow-secondary-container/20 flex items-center gap-2" href="{{ route('register') }}">
                                S'inscrire <span class="text-lg leading-none">→</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="relative pt-32 pb-24 md:pt-48 md:pb-32 overflow-hidden bg-primary-container">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 left-1/4 w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-container/10 border border-secondary-container/20 text-secondary-container rounded-full text-xs font-bold mb-6 uppercase tracking-widest reveal">
                    <span class="material-symbols-outlined text-[16px]">verified_user</span>
                    L'Archive Éthique
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white font-headline leading-tight tracking-tight mb-6 reveal" style="transition-delay: 100ms;">
                    La finalité de <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary-container to-yellow-200">chaque dirham</span> donné.
                </h1>
                
                <p class="text-lg md:text-xl text-blue-100/80 max-w-3xl mx-auto font-medium leading-relaxed mb-10 reveal" style="transition-delay: 200ms;">
                    Explorez la bibliothèque immuable des projets réalisés. Une transparence totale, soutenue par des preuves visuelles et des rapports certifiés.
                </p>

                <div class="max-w-2xl mx-auto relative reveal" style="transition-delay: 300ms;">
                    <form action="{{ route('impact.index') }}" method="GET">
                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-4 text-slate-400 text-xl">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une association, un projet, une ville..." 
                                   class="w-full bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-blue-100/50 rounded-2xl py-4 pl-12 pr-32 focus:ring-2 focus:ring-secondary-container focus:border-transparent transition-all shadow-2xl">
                            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-secondary-container text-primary-container px-6 rounded-xl font-bold text-sm hover:bg-yellow-400 transition-colors shadow-md">
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 -mt-12 relative z-20 reveal">
            <div class="bg-surface-container-lowest rounded-3xl shadow-xl shadow-primary-container/5 border border-outline-variant/10 p-8 grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-outline-variant/20">
                <div class="text-center md:px-4">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Rapports Publiés</p>
                    <p class="text-4xl font-headline font-black text-primary-container">{{ $impactReports->total() ?? '142' }}</p>
                </div>
                <div class="text-center md:px-4 pt-8 md:pt-0">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-green-500">task_alt</span>
                        Taux de Réussite
                    </p>
                    <p class="text-4xl font-headline font-black text-primary-container">100<span class="text-2xl text-secondary">%</span></p>
                </div>
                <div class="text-center md:px-4 pt-8 md:pt-0">
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2">Vies Impactées (Est.)</p>
                    <p class="text-4xl font-headline font-black text-primary-container">+{{ number_format(($impactReports->total() ?? 142) * 150, 0, ',', ' ') }}</p>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 py-24">
            
            @if(isset($impactReports) && $impactReports->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($impactReports as $report)
                        @php $project = $report->project; @endphp
                        
                        <div class="group bg-surface-container-lowest rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-outline-variant/10 flex flex-col reveal">
                            <div class="relative h-64 overflow-hidden bg-primary-container">
                                @if($report->image)
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90"/>
                                @elseif($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center"><span class="text-secondary-container text-5xl font-black">AK</span></div>
                                @endif
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/20 to-transparent"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="bg-green-500 text-white text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest flex items-center gap-1 shadow-md">
                                        <span class="material-symbols-outlined text-[14px]">verified</span> Impact Confirmé
                                    </span>
                                </div>
                                
                                <div class="absolute bottom-4 left-4 right-4">
                                    <p class="text-[10px] text-secondary-container font-bold uppercase tracking-widest mb-1">{{ $project->association->name ?? 'Association' }}</p>
                                    <h3 class="text-white font-headline font-bold text-xl leading-tight line-clamp-2">{{ $project->title }}</h3>
                                </div>
                            </div>
                            
                            <div class="p-6 flex-1 flex flex-col">
                                <p class="text-sm text-on-surface-variant line-clamp-3 mb-6 flex-grow">
                                    {{ $report->description ?? 'Rapport d\'impact détaillé attestant de la finalisation et du succès de ce projet solidaire.' }}
                                </p>
                                
                                <div class="bg-surface p-4 rounded-2xl border border-outline-variant/10 mb-6">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="text-xs font-bold text-on-surface-variant uppercase">Fonds Déployés</span>
                                        <span class="text-primary-container font-black">{{ number_format($project->currentAmount ?? 0, 0, ',', ' ') }} DH</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs font-bold text-on-surface-variant uppercase">Date clôture</span>
                                        <span class="text-primary-container font-bold text-xs">{{ \Carbon\Carbon::parse($report->completionDate)->format('d M Y') }}</span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('impact.show', $report->id) }}" class="w-full py-3.5 bg-surface-container-highest text-primary-container font-headline font-bold text-sm text-center rounded-xl hover:bg-secondary-container transition-colors flex items-center justify-center gap-2">
                                    Lire le rapport complet <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16 flex justify-center reveal">
                    {{ $impactReports->links() }}
                </div>
            @else
                <div class="bg-surface-container-lowest p-16 rounded-3xl text-center border-2 border-dashed border-outline-variant/30 shadow-sm max-w-2xl mx-auto reveal">
                    <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">history_edu</span>
                    <h3 class="text-2xl font-headline font-bold text-primary-container mb-2">Aucun rapport trouvé</h3>
                    <p class="text-on-surface-variant mb-8">Les rapports d'impact publiés par les associations apparaîtront ici.</p>
                    <a href="{{ route('impact.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-container text-white font-bold rounded-xl hover:bg-slate-800 transition-colors">
                        Voir tous les rapports
                    </a>
                </div>
            @endif

        </section>

        <section class="py-24 bg-gradient-to-br from-primary-container via-[#042646] to-primary-container text-white relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl"></div>
            
            <div class="max-w-4xl mx-auto text-center relative z-10 px-6">
                <span class="material-symbols-outlined text-secondary-container text-5xl mb-6" style="font-variation-settings: 'FILL' 1;">public</span>
                <h2 class="text-4xl md:text-5xl font-headline font-extrabold mb-6">Devenez acteur du changement.</h2>
                <p class="text-lg text-blue-100/70 mb-10 max-w-2xl mx-auto">
                    Vous avez vu la preuve de notre engagement. Rejoignez des milliers de donateurs qui construisent un Maroc plus solidaire, en toute transparence.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('projects.index') }}" class="w-full sm:w-auto px-8 py-4 bg-secondary-container text-primary-container font-headline font-bold rounded-2xl hover:scale-105 transition-transform shadow-xl shadow-secondary-container/20 flex items-center justify-center gap-2">
                        Soutenir un projet <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-surface py-12 px-6 border-t border-outline-variant/20">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <span class="text-2xl font-black tracking-tighter text-primary-container uppercase font-headline">AL-KHAIR</span>
            <p class="text-xs text-on-surface-variant font-label uppercase tracking-widest font-bold text-center">
                © {{ date('Y') }} Al-Khair Foundation. L'Archive Éthique.
            </p>
        </div>
    </footer>

    <script>
        // Reveal animation on scroll
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            reveals.forEach(reveal => revealObserver.observe(reveal));
        });
    </script>
</body>
</html>