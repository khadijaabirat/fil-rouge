<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $project->title }} | AL-KHAIR</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;600;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "#370e00",
                        "error": "#ba1a1a",
                        "surface-dim": "#d8dadc",
                        "primary-container": "#021c36",
                        "on-tertiary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#eceef0",
                        "secondary-container": "#feb700",
                        "tertiary": "#000000",
                        "primary-fixed-dim": "#b1c8e9",
                        "on-tertiary-fixed": "#370e00",
                        "on-error-container": "#93000a",
                        "inverse-on-surface": "#eff1f3",
                        "surface": "#f8f9fb",
                        "on-background": "#191c1e",
                        "on-surface": "#191c1e",
                        "on-secondary-fixed-variant": "#5e4200",
                        "surface-variant": "#e0e3e5",
                        "surface-bright": "#f8f9fb",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#7f2b00",
                        "surface-tint": "#4a607c",
                        "secondary-fixed-dim": "#ffba20",
                        "surface-container-high": "#e6e8ea",
                        "primary": "#000000",
                        "surface-container-low": "#f2f4f6",
                        "on-surface-variant": "#43474d",
                        "on-secondary-fixed": "#271900",
                        "background": "#f8f9fb",
                        "on-error": "#ffffff",
                        "on-primary-fixed-variant": "#324863",
                        "secondary-fixed": "#ffdea8",
                        "on-primary-container": "#6f85a3",
                        "inverse-surface": "#2d3133",
                        "primary-fixed": "#d2e4ff",
                        "inverse-primary": "#b1c8e9",
                        "outline": "#74777e",
                        "tertiary-fixed": "#ffdbce",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#e05814",
                        "on-secondary": "#ffffff",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#ffb599",
                        "secondary": "#7c5800",
                        "outline-variant": "#c4c6ce",
                        "on-primary-fixed": "#021c36",
                        "on-secondary-container": "#6b4b00"
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-header { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        #map { height: 400px; width: 100%; border-radius: 1rem; z-index: 1; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">

    <header class="fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="glass-header w-full">
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
                                <button type="submit" class="bg-white/10 hover:bg-red-500/20 border border-white/20 text-white text-sm font-bold px-5 py-2 rounded-xl transition-all shadow-sm">Quitter</button>
                            </form>
                        @else
                            <a class="text-white/90 font-medium hover:text-[#F5A623] transition" href="{{ route('login') }}">Connexion</a>
                            <a class="bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg flex items-center gap-2" href="{{ route('register') }}">
                                S'inscrire <span class="text-lg leading-none">→</span>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="relative h-[650px] min-h-[500px] w-full overflow-hidden">
            @if($project->image)
                <img alt="{{ $project->title }}" class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/' . $project->image) }}"/>
            @else
                <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-primary-container to-surface-tint"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-primary-container via-primary-container/40 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12 max-w-7xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-8 z-10">
                <div class="max-w-3xl">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest font-label shadow-sm">
                            {{ $project->category->name ?? 'Solidaire' }}
                        </span>
                        <span class="text-white/80 font-label text-sm flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ $project->ville ?? 'Maroc' }}
                        </span>
                        @if($project->status === 'COMPLETED')
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-sm">Objectif Atteint</span>
                        @endif
                    </div>
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white font-headline leading-[1.1] tracking-tighter mb-4">
                        {{ $project->title }}
                    </h1>
                </div>
                
                <div class="flex items-center gap-4 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20 shadow-lg">
                    <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center p-1 shadow-inner overflow-hidden">
                        @if($project->association && $project->association->profilePhoto)
                            <img alt="{{ $project->association->name }}" class="w-full h-full object-cover rounded-md" src="{{ asset('storage/' . $project->association->profilePhoto) }}"/>
                        @else
                            <span class="text-primary-container font-black text-xl">{{ substr($project->association->name ?? 'A', 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm leading-tight">{{ $project->association->name ?? 'Association' }}</p>
                        <p class="text-secondary-container text-xs mt-1 font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">verified</span>
                            Partenaire Certifié
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 relative">
            
            <div class="lg:col-span-8 space-y-16">
                
                <section>
                    <h2 class="text-3xl font-black font-headline mb-6 text-primary-container flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-4xl">subject</span>
                        Mission du Projet
                    </h2>
                    <div class="prose prose-lg max-w-none text-on-surface-variant leading-relaxed bg-white p-8 rounded-3xl shadow-sm border border-outline-variant/10">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </section>

                @if($project->impactReport)
                    <section class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 md:p-10 rounded-3xl border border-green-200 shadow-sm relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 text-green-500 opacity-10">
                            <span class="material-symbols-outlined text-[150px]">verified</span>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black font-headline mb-4 flex items-center gap-2 text-green-800">
                                <span class="material-symbols-outlined">task_alt</span>
                                Impact Réalisé
                            </h3>
                            <p class="text-green-700 font-medium mb-4">Ce projet a été complété le {{ \Carbon\Carbon::parse($project->impactReport->completionDate)->format('d M Y') }}.</p>
                            <div class="bg-white/60 p-6 rounded-2xl text-green-900 leading-relaxed mb-6">
                                {!! nl2br(e($project->impactReport->description)) !!}
                            </div>
                            
                            @if($project->impactReport->image)
                                <div class="mt-6 rounded-xl overflow-hidden shadow-md h-64">
                                    <img src="{{ asset('storage/' . $project->impactReport->image) }}" class="w-full h-full object-cover" alt="Preuve d'impact">
                                </div>
                            @endif
                        </div>
                    </section>
                @endif

                <section>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black font-headline flex items-center gap-3 text-primary-container">
                            <span class="material-symbols-outlined text-secondary-container text-4xl">volunteer_activism</span>
                            Donateurs Récents
                        </h2>
                        <span class="text-sm font-bold text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">{{ $project->donations->count() }} dons au total</span>
                    </div>

                    @if($project->donations->count() > 0)
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-outline-variant/10">
                            <div class="space-y-3">
                                @foreach($project->donations as $donation)
                                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-surface-container-lowest hover:bg-surface-container-low transition-colors border border-outline-variant/5">
                                        <div class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center flex-shrink-0">
                                            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-primary-container text-sm">
                                                {{ $donation->isAnonymous ? 'Donateur Anonyme' : ($donation->donator->name ?? 'Donateur') }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <p class="text-xs text-on-surface-variant">{{ $donation->created_at->diffForHumans() }}</p>
                                                <span class="text-[10px] font-bold uppercase text-green-600 bg-green-50 px-2 rounded">Validé</span>
                                            </div>
                                            @if($donation->message)
                                                <p class="text-xs text-on-surface-variant/80 mt-2 italic bg-surface p-2 rounded-lg border-l-2 border-secondary-container">
                                                    "{{ $donation->message }}"
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <p class="font-black text-secondary text-lg">{{ number_format($donation->amount, 0, ',', ' ') }} DH</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="bg-surface-container-low rounded-3xl p-12 text-center border border-dashed border-outline-variant/50">
                            <span class="material-symbols-outlined text-5xl text-on-surface-variant/30 mb-4">volunteer_activism</span>
                            <p class="text-primary-container font-bold text-lg">Soyez le premier à soutenir ce projet !</p>
                            <p class="text-sm text-on-surface-variant mt-2">Votre don peut faire la différence dès aujourd'hui.</p>
                        </div>
                    @endif
                </section>

                <section>
                    <h2 class="text-2xl font-black font-headline mb-6 text-primary-container flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary-container text-4xl">map</span>
                        Localisation du projet
                    </h2>
                    <div class="bg-white rounded-3xl p-4 shadow-sm border border-outline-variant/10">
                        <div id="map" class="z-0 border border-outline-variant/20"></div>
                        <div class="mt-4 p-4 bg-primary-container/5 rounded-xl border border-primary-container/10 flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-container">security</span>
                            <p class="text-xs font-medium text-primary-container leading-relaxed">
                                Les coordonnées exactes sont affichées à des fins de transparence. L'association partenaire est responsable de la mise en œuvre sur ce site.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-8">
                    
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-primary-container/5 border border-outline-variant/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-secondary-container/10 rounded-bl-full -mr-10 -mt-10"></div>
                        
                        <div class="relative z-10 mb-8">
                            <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Fonds Collectés</p>
                            <div class="flex items-end gap-2 mb-4">
                                <span class="text-4xl font-black text-primary-container font-headline">{{ number_format($project->currentAmount, 0, ',', ' ') }}</span>
                                <span class="text-xl font-bold text-secondary mb-1">DH</span>
                            </div>
                            
                            @php
                                $percentage = $project->goalAmount > 0 ? min(($project->currentAmount / $project->goalAmount) * 100, 100) : 0;
                            @endphp
                            <div class="h-2.5 w-full bg-surface-container-high rounded-full overflow-hidden mb-3">
                                <div class="h-full bg-gradient-to-r from-secondary to-secondary-container rounded-full transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm font-bold">
                                <span class="text-secondary">{{ number_format($percentage, 0) }}% financé</span>
                                <span class="text-on-surface-variant">Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @if($project->status === 'OPEN')
                                <a href="{{ route('donations.create', $project->id) }}" class="block w-full bg-primary-container text-white py-5 rounded-xl font-headline font-black text-lg hover:bg-slate-800 transition-all duration-300 shadow-lg shadow-primary-container/20 active:scale-95 text-center">
                                    Faire un don
                                </a>
                                <p class="text-center text-[10px] text-on-surface-variant font-bold uppercase tracking-widest flex items-center justify-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">lock</span>
                                    Paiement Sécurisé
                                </p>
                            @else
                                <button disabled class="w-full bg-surface-container-highest text-on-surface-variant py-5 rounded-xl font-headline font-black text-lg cursor-not-allowed">
                                    Projet {{ $project->status === 'COMPLETED' ? 'Complété' : 'Fermé' }}
                                </button>
                                @if($project->status === 'COMPLETED')
                                    <p class="text-center text-sm text-green-600 font-bold mt-2">Merci à tous les donateurs !</p>
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="bg-primary-container p-8 rounded-3xl text-white shadow-lg relative overflow-hidden">
                        <div class="absolute -bottom-10 -right-10 opacity-10">
                            <span class="material-symbols-outlined text-[150px]">pie_chart</span>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-sm font-bold uppercase tracking-widest font-label text-secondary-container mb-6 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">donut_small</span>
                                Garantie Al-Khair
                            </h4>
                            <p class="text-sm text-blue-100 leading-relaxed">
                                Notre plateforme assure que <strong>100%</strong> de votre don (hors frais bancaires) est reversé directement à l'association pour ce projet spécifique. Aucun frais de plateforme n'est prélevé.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-primary-container text-white py-12 border-t-4 border-secondary-container mt-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-2xl font-black mb-2 tracking-widest text-secondary-container font-headline">AL-KHAIR</h2>
            <p class="text-blue-200/60 text-sm mb-6">L'archive éthique de l'impact humanitaire au Maroc.</p>
            <p class="text-xs text-blue-200/40">© 2026 Al-Khair Foundation. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hasCoordinates = {{ ($project->latitude && $project->longitude) ? 'true' : 'false' }};
            const latitude = {{ $project->latitude ?? 31.7917 }};
            const longitude = {{ $project->longitude ?? -7.0926 }};
            
            const map = L.map('map').setView([latitude, longitude], hasCoordinates ? 13 : 5);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);
            
            if (hasCoordinates) {
                const customIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background-color: #021c36; width: 40px; height: 40px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.3); border: 2px solid white;"><span style="color: #feb700; font-size: 16px; transform: rotate(45deg);">📍</span></div>',
                    iconSize: [40, 40],
                    iconAnchor: [20, 40],
                });
                
                const marker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map);
                
                marker.bindPopup(`
                    <div style="text-align: center; padding: 4px;">
                        <strong style="font-size: 13px; color: #021c36; font-family: Manrope;">{{ addslashes($project->title) }}</strong><br>
                        <span style="font-size: 11px; color: #666;">{{ addslashes($project->ville ?? 'Maroc') }}</span>
                    </div>
                `).openPopup();
            }
            
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });
        });
    </script>
</body>
</html>