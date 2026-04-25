<!DOCTYPE html>
<html class="light scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $project->title ?? 'Rapport d\'Impact' }} | AL-KHAIR</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
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
              "on-tertiary-container": "#e05814",
              "tertiary-container": "#370e00",
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .glass-header {
            background: rgba(2, 28, 54, 0.95);
            backdrop-filter: blur(12px);
        }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fb; }
        h1, h2, h3, h4, h5, h6, .font-headline { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased selection:bg-secondary-container selection:text-primary-container">

    <nav class="fixed top-0 w-full z-50 glass-header border-none shadow-xl shadow-blue-900/20 h-20 px-8 flex justify-between items-center max-w-none">
        <div class="flex items-center gap-12">
            <span class="text-2xl font-bold tracking-tighter text-white uppercase font-headline">AL-KHAIR</span>
            <div class="hidden md:flex gap-8 items-center font-headline antialiased text-sm font-medium tracking-tight">
                <a class="text-slate-300 hover:text-white transition-colors hover:scale-105 transition-transform duration-200" href="{{ url('/') }}">Accueil</a>
                <a class="text-secondary-container border-b-2 border-secondary-container pb-1 hover:scale-105 transition-transform duration-200" href="{{ route('impact.index') }}">Impact</a>
                <a class="text-slate-300 hover:text-white transition-colors hover:scale-105 transition-transform duration-200" href="{{ route('projects.index') }}">Projets</a>
            </div>
        </div>
        <div class="flex items-center gap-6">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-sm hover:text-secondary-container transition-colors">Mon Espace</a>
                @elseif(Auth::user()->isAssociation())
                    <a href="{{ route('association.dashboard') }}" class="text-white font-bold text-sm hover:text-secondary-container transition-colors">Mon Espace</a>
                @elseif(Auth::user()->isDonator())
                    <a href="{{ route('donator.dashboard') }}" class="text-white font-bold text-sm hover:text-secondary-container transition-colors">Mon Espace</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-white font-bold text-sm hover:text-secondary-container transition-colors">Connexion</a>
            @endauth
        </div>
    </nav>

    <main class="pt-20">
        
        <section class="relative min-h-[614px] flex items-center px-8 lg:px-20 py-24 overflow-hidden bg-primary-container">
            <div class="absolute inset-0 z-0 opacity-40">
                @if($impactReport->image)
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $impactReport->image) }}" alt="{{ $project->title }}"/>
                @elseif($project->image)
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"/>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-primary-container to-slate-900"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-primary-container via-primary-container/80 to-transparent"></div>
            </div>
            
            <div class="relative z-10 max-w-4xl">
                <div class="inline-flex items-center gap-2 bg-secondary/20 border border-secondary/30 text-secondary-container px-4 py-1.5 rounded-full mb-8 backdrop-blur-md">
                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <span class="font-label text-xs font-bold uppercase tracking-widest">Rapport Validé</span>
                </div>
                
                <h1 class="font-headline text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6">
                    Rapport d'Impact : <br/>
                    <span class="text-secondary-container underline decoration-amber-500/30 decoration-8 underline-offset-8">{{ $project->title }}</span>
                </h1>
                
                <p class="text-slate-300 text-xl max-w-2xl font-body leading-relaxed mb-10 line-clamp-3">
                    {{ $impactReport->description ?? $project->description }}
                </p>
                
                <div class="flex flex-wrap gap-8">
                    <div class="flex flex-col">
                        <span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-1">Date de Clôture</span>
                        <span class="text-white font-headline text-lg font-bold">{{ \Carbon\Carbon::parse($impactReport->completionDate)->format('d M Y') }}</span>
                    </div>
                    <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                    <div class="flex flex-col">
                        <span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-1">Localisation</span>
                        <span class="text-white font-headline text-lg font-bold">{{ $project->ville ?? 'Maroc' }}</span>
                    </div>
                    <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                    <div class="flex flex-col">
                        <span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-1">Association Partenaire</span>
                        <span class="text-white font-headline text-lg font-bold">{{ $project->association->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-8 lg:px-20 -mt-16 relative z-20 pb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="md:col-span-2 lg:col-span-2 bg-surface-container-lowest p-8 rounded-xl shadow-2xl shadow-blue-900/5 flex flex-col justify-between border border-outline-variant/10">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="font-headline text-sm font-bold uppercase tracking-widest text-primary-container">Total des Fonds Utilisés</h3>
                            <span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-5xl font-extrabold text-primary-container font-headline">{{ number_format($project->currentAmount, 0, ',', ' ') }}</span>
                            <span class="text-2xl font-bold text-slate-400 uppercase">DH</span>
                        </div>
                    </div>
                    <div class="mt-8 space-y-3">
                        @php
                            $percentage = ($project->goalAmount > 0) ? min(($project->currentAmount / $project->goalAmount) * 100, 100) : 100;
                        @endphp
                        <div class="flex justify-between font-label text-[10px] uppercase font-bold tracking-wider">
                            <span class="text-slate-500">Taux de financement de l'objectif</span>
                            <span class="text-secondary">{{ number_format($percentage, 0) }}%</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container-high rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-secondary to-secondary-container rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-primary-container p-8 rounded-xl shadow-xl flex flex-col justify-center text-center">
                    <span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-4">Individus Soutenus</span>
                    <span class="text-6xl font-extrabold text-white font-headline mb-2">{{ $impactReport->peopleImpacted ?? '100+' }}</span>
                    <span class="text-secondary-container text-xs font-bold">Impact direct mesuré</span>
                </div>

                <div class="bg-surface-container-low p-8 rounded-xl shadow-sm flex flex-col justify-center border border-outline-variant/20">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center text-primary-container shadow-sm">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                        </div>
                        <span class="font-headline text-sm font-bold uppercase tracking-tight text-primary-container leading-tight">Donateurs<br/>Uniques</span>
                    </div>
                    <span class="text-4xl font-extrabold text-primary-container font-headline">{{ $project->donations->unique('donator_id')->count() }}</span>
                    <p class="text-slate-500 text-xs mt-2 font-medium">Contributeurs vérifiés</p>
                </div>
            </div>
        </section>

        <section class="px-8 lg:px-20 pb-24 grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-7">
                <h2 class="font-headline text-3xl font-extrabold text-primary-container mb-8">La Voix de la Communauté</h2>
                <div class="space-y-6 text-on-surface-variant font-body leading-relaxed text-lg">
                    {!! nl2br(e($impactReport->description)) !!}
                    
                    <div class="bg-surface-container-low p-8 rounded-xl border-l-4 border-secondary mt-10 shadow-sm relative">
                        <span class="material-symbols-outlined absolute top-4 right-4 text-4xl text-outline-variant/20">format_quote</span>
                        <p class="italic text-primary-container font-medium mb-6 relative z-10">
                            "Nous n'avons pas seulement apporté de l'aide matérielle, nous avons apporté la preuve que ces familles ne sont pas oubliées. Vos dons ont changé leur quotidien de manière durable."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-surface-container-high border-2 border-white shadow-sm flex items-center justify-center text-primary-container font-bold">
                                @if($project->association->profilePhoto)
                                    <img src="{{ asset('storage/' . $project->association->profilePhoto) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($project->association->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-primary-container">{{ $project->association->name }}</p>
                                <p class="text-sm text-on-surface-variant">Association porteuse du projet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-xl shadow-blue-900/5 sticky top-28 border border-outline-variant/10">
                    <h3 class="font-headline text-xl font-bold text-primary-container mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary-container">pie_chart</span>
                        Transparence Financière
                    </h3>
                    
                    <p class="text-sm text-on-surface-variant mb-8">
                        Coût total financé par la plateforme : <strong class="text-primary-container">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</strong>
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-12 bg-secondary rounded-full"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-bold text-primary-container">Matériel & Équipements</span>
                                    <span class="text-sm font-bold text-slate-500">60%</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary w-[60%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-12 bg-secondary-container rounded-full"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-bold text-primary-container">Exécution & Main d'œuvre</span>
                                    <span class="text-sm font-bold text-slate-500">25%</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-secondary-container w-[25%]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-2 h-12 bg-on-tertiary-container rounded-full"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-bold text-primary-container">Logistique & Transport</span>
                                    <span class="text-sm font-bold text-slate-500">15%</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                    <div class="h-full bg-on-tertiary-container w-[15%]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-surface-container-low px-8 lg:px-20 py-24 border-y border-outline-variant/10">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
                    <div>
                        <span class="font-label text-xs font-bold uppercase tracking-[0.2em] text-secondary mb-2 block">100% Vérifiable</span>
                        <h2 class="font-headline text-3xl font-extrabold text-primary-container">Preuves Visuelles du Terrain</h2>
                    </div>
                </div>

                @if($project->videoUrl)
                    <div class="mb-10 rounded-2xl overflow-hidden shadow-2xl aspect-video relative border-4 border-white">
                        <iframe 
                            class="absolute top-0 left-0 w-full h-full" 
                            src="{{ str_replace('watch?v=', 'embed/', $project->videoUrl) }}" 
                            title="YouTube video player" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-auto md:h-[600px]">
                    
                    <div class="md:col-span-2 md:row-span-2 relative rounded-xl overflow-hidden group min-h-[300px]">
                        @if($impactReport->image)
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('storage/' . $impactReport->image) }}" alt="Preuve Terrain Principale"/>
                        @else
                            <div class="w-full h-full bg-primary-container flex items-center justify-center text-secondary-container font-black text-4xl">AK</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                            <p class="text-white font-bold text-lg">Achèvement Confirmé</p>
                            <p class="text-secondary-container text-xs font-bold uppercase tracking-widest mt-1">Archive Officielle</p>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative rounded-xl overflow-hidden group min-h-[200px]">
                        @if($project->image)
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ asset('storage/' . $project->image) }}" alt="État Initial"/>
                        @else
                            <div class="w-full h-full bg-surface-container-high flex items-center justify-center text-outline-variant font-black text-2xl">AK</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                            <p class="text-white font-bold text-sm">État Initial du Projet</p>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative rounded-xl overflow-hidden group min-h-[200px]">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop" alt="Solidarité"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                            <p class="text-white font-bold text-sm">Impact Communautaire</p>
                        </div>
                    </div>

                    <div class="md:col-span-2 md:row-span-1 relative rounded-xl overflow-hidden group min-h-[200px]">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=2070&auto=format&fit=crop" alt="Solidarité 2"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
                            <p class="text-white font-bold text-sm">Organisation Logistique</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-primary-container text-white py-24 px-8 lg:px-20 overflow-hidden relative">
            <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 -top-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
            
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="font-label text-xs font-bold uppercase tracking-[0.3em] text-secondary-container mb-4 block">Unité & Générosité</span>
                <h2 class="font-headline text-4xl md:text-5xl font-extrabold mb-12">Merci aux {{ $project->donations->unique('donator_id')->count() }} Héros</h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-8 text-left border-y border-white/10 py-16">
                    <div class="col-span-2 md:col-span-4">
                        <p class="text-slate-400 font-label text-[10px] uppercase tracking-widest mb-6 text-center">Les Donateurs de ce Projet (Aperçu)</p>
                        <div class="flex flex-wrap justify-center gap-4 font-headline text-sm font-medium">
                            @foreach($project->donations->unique('donator_id')->take(12) as $donation)
                                <span class="bg-white/10 px-4 py-2 rounded-full border border-white/5">
                                    {{ $donation->isAnonymous ? 'Donateur Anonyme' : ($donation->donator->name ?? 'Anonyme') }}
                                </span>
                            @endforeach
                            @if($project->donations->unique('donator_id')->count() > 12)
                                <span class="bg-secondary-container text-primary-container px-4 py-2 rounded-full font-bold">
                                    + {{ $project->donations->unique('donator_id')->count() - 12 }} autres
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-16 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('impact.pdf', $impactReport->id) }}" class="inline-flex items-center gap-3 bg-white/10 border border-white/20 text-white font-headline font-bold px-8 py-4 rounded-xl hover:bg-white/20 transition-colors">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">picture_as_pdf</span>
                        Télécharger le Rapport PDF
                    </a>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-3 bg-secondary-container text-primary-container font-headline font-extrabold px-8 py-4 rounded-xl hover:bg-yellow-400 transition-colors shadow-lg shadow-secondary-container/20">
                        Soutenir un autre projet <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

        <footer class="bg-surface py-12 px-8 lg:px-20 border-t border-surface-container">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <span class="text-xl font-bold tracking-tighter text-primary-container uppercase font-headline">AL-KHAIR</span>
                <p class="text-[10px] text-on-surface-variant font-label uppercase tracking-widest text-center font-bold">
                    © {{ date('Y') }} Al-Khair Foundation. L'Archive Éthique de l'Humanitaire.
                </p>
            </div>
        </footer>

    </main>
</body>
</html>