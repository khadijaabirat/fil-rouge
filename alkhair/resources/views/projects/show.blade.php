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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .glass-nav { background: rgba(10,17,40,0.9); backdrop-filter: blur(32px); -webkit-backdrop-filter: blur(32px); border-bottom: 1px solid rgba(245,166,35,0.2); box-shadow: 0 8px 32px rgba(0,0,0,0.08); }
        .glass-card { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04), 0 12px 32px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.02); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
        .glass-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 16px 40px rgba(245,166,35,0.12), 0 0 1px rgba(0,0,0,0.04); border-color: rgba(245,166,35,0.3); }
        .progress-bar { background: linear-gradient(90deg, #F5A623 0%, #FFD085 50%, #F5A623 100%); background-size: 200% 100%; animation: shimmer 3s cubic-bezier(0.4, 0, 0.2, 1) infinite; }
        @keyframes shimmer { 0%{background-position:-200% 0} 50%{background-position:0% 0} 100%{background-position:200% 0} }
        @keyframes slideInUp { from { opacity:0; transform:translateY(30px); filter: blur(4px); } to { opacity:1; transform:translateY(0); filter: blur(0); } }
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        .animate-in { animation: slideInUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) backwards; }
        .animate-in:nth-child(2) { animation-delay: 0.15s; }
        .animate-in:nth-child(3) { animation-delay: 0.3s; }
        .reveal { opacity: 0; transform: translateY(25px); transition: all 0.7s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        #map { height: 400px; width: 100%; border-radius: 1.5rem; z-index: 1; box-shadow: 0 4px 16px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05); }
        .neumorphic-lg { background: linear-gradient(135deg, rgba(255,255,255,1) 0%, rgba(248,250,252,0.8) 100%); }
        .neumorphic { background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.7) 100%); }
    </style>
</head>
<body class="bg-[#f0f2f5] text-[#191c1e] font-body selection:bg-[#F5A623]/20">

    @include('partials.navbar')

    <main>
        <section class="relative h-[550px] min-h-[450px] w-full overflow-hidden">
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
                
                <section class="reveal">
                    <h2 class="text-3xl font-black font-headline mb-6 text-[#0A1128] flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#F5A623] text-4xl p-2 bg-gradient-to-br from-[#F5A623]/15 to-[#FFD085]/10 rounded-xl border border-[#F5A623]/20 shadow-lg shadow-[#F5A623]/5">subject</span>
                        Mission du Projet
                    </h2>
                    <div class="glass-card backdrop-blur-xl max-w-none text-[#191c1e] leading-relaxed p-8 rounded-2xl neumorphic-lg transition-all duration-300 group hover:shadow-xl hover:shadow-[#F5A623]/10">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </section>

                @if($project->videoUrl)
                    <section class="reveal">
                        <h2 class="text-3xl font-black font-headline mb-6 text-[#0A1128] flex items-center gap-3">
                            <span class="material-symbols-outlined text-[#F5A623] text-4xl p-2 bg-gradient-to-br from-[#F5A623]/15 to-[#FFD085]/10 rounded-xl border border-[#F5A623]/20 shadow-lg shadow-[#F5A623]/5">play_circle</span>
                            Vidéo du Projet
                        </h2>
                        <div class="glass-card backdrop-blur-xl rounded-2xl overflow-hidden neumorphic-lg transition-all duration-300 group hover:shadow-xl hover:shadow-[#F5A623]/10">
                            <div class="relative" style="padding-bottom: 56.25%; height: 0;">
                                @php
                                    $embedUrl = $project->videoUrl;
                                    // Convert YouTube watch URL to embed URL
                                    if (strpos($embedUrl, 'youtube.com/watch') !== false) {
                                        preg_match('/[?&]v=([^&]+)/', $embedUrl, $matches);
                                        if (isset($matches[1])) {
                                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                                        }
                                    } elseif (strpos($embedUrl, 'youtu.be/') !== false) {
                                        $videoId = substr(parse_url($embedUrl, PHP_URL_PATH), 1);
                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                    }
                                @endphp
                                <iframe 
                                    src="{{ $embedUrl }}" 
                                    class="absolute top-0 left-0 w-full h-full" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </section>
                @endif

                @if($project->impactReport)
                    <section class="bg-gradient-to-br from-emerald-50 to-green-50 p-8 md:p-10 rounded-2xl border border-emerald-200 neumorphic-lg relative overflow-hidden group hover:shadow-xl hover:shadow-green-200/40 transition-all duration-300 reveal">
                        <div class="absolute -right-16 -top-16 text-green-500/10 group-hover:scale-110 transition-transform duration-500">
                            <span class="material-symbols-outlined text-[150px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black font-headline mb-4 flex items-center gap-2 text-green-800">
                                <span class="material-symbols-outlined bg-green-200/60 p-2 rounded-lg text-green-600">task_alt</span>
                                Impact Réalisé
                            </h3>
                            <p class="text-green-700 font-medium mb-4">Ce projet a été complété le {{ \Carbon\Carbon::parse($project->impactReport->completionDate)->format('d M Y') }}.</p>
                            <div class="glass-card bg-white/80 p-6 rounded-xl text-green-900 leading-relaxed mb-6 neumorphic border border-green-100/50">
                                {!! nl2br(e($project->impactReport->description)) !!}
                            </div>

                            @if($project->impactReport->image)
                                <div class="mt-6 rounded-xl overflow-hidden neumorphic-lg h-64 group-hover:shadow-lg group-hover:shadow-green-200/40 transition-all duration-300 border border-green-100/30">
                                    <img src="{{ asset('storage/' . $project->impactReport->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="Preuve d'impact">
                                </div>
                            @endif
                        </div>
                    </section>
                @endif

                <section>
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black font-headline flex items-center gap-3 text-[#0A1128] reveal">
                            <span class="material-symbols-outlined text-[#F5A623] text-4xl p-2 bg-gradient-to-br from-[#F5A623]/15 to-[#FFD085]/10 rounded-xl border border-[#F5A623]/20 shadow-lg shadow-[#F5A623]/5">volunteer_activism</span>
                            Donateurs Récents
                        </h2>
                        <span class="text-sm font-bold text-gray-700 bg-gray-100 px-3 py-1 rounded-full neumorphic shadow-sm">{{ $project->donations->count() }} dons au total</span>
                    </div>

                    @if($project->donations->count() > 0)
                        <div class="glass-card backdrop-blur-xl rounded-2xl p-6 neumorphic-lg transition-all duration-300 reveal">
                            <div class="space-y-3">
                                @foreach($project->donations->take(10) as $donation)
                                    <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-r from-white/60 to-white/40 hover:from-[#F5A623]/8 hover:to-[#FFD085]/8 transition-all border border-gray-200/40 hover:border-[#F5A623]/40 group">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#F5A623]/25 to-[#FFD085]/25 flex items-center justify-center flex-shrink-0 group-hover:shadow-lg group-hover:shadow-[#F5A623]/25 transition-all">
                                            <span class="material-symbols-outlined text-[#F5A623]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-[#0A1128] text-sm">
                                                {{ $donation->isAnonymous ? 'Donateur Anonyme' : ($donation->donator->name ?? 'Donateur') }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <p class="text-xs text-gray-600">{{ $donation->created_at->diffForHumans() }}</p>
                                                <span class="text-[10px] font-bold uppercase text-green-700 bg-green-50/80 px-2 py-0.5 rounded-full neumorphic border border-green-200/30">Validé</span>
                                            </div>
                                            @if($donation->message)
                                                <p class="text-xs text-gray-700/80 mt-2 italic bg-gray-50 p-2 rounded-lg border-l-4 border-[#F5A623]">
                                                    "{{ $donation->message }}"
                                                </p>
                                            @endif
                                        </div>
                                        <div class="text-right flex-shrink-0">
                                            <p class="font-black text-[#F5A623] text-lg">{{ number_format($donation->amount, 0, ',', ' ') }} DH</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($project->donations->count() > 10)
                                <div class="mt-6 pt-6 border-t border-gray-200/40 text-center">
                                    <p class="text-sm font-medium text-gray-600">et {{ $project->donations->count() - 10 }} autres donateurs</p>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="glass-card backdrop-blur-xl rounded-2xl p-12 text-center border-2 border-dashed border-gray-300/40 neumorphic hover:border-[#F5A623]/50 hover:bg-[#F5A623]/2 transition-all duration-300 reveal">
                            <span class="material-symbols-outlined text-5xl text-gray-400/60 mb-4 block">volunteer_activism</span>
                            <p class="text-[#0A1128] font-bold text-lg">Soyez le premier à soutenir ce projet !</p>
                            <p class="text-sm text-gray-600 mt-2 mb-6">Votre don peut faire la différence dès aujourd'hui.</p>
                            <a href="{{ route('donations.create', $project->id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-[#0A1128] to-[#1a2a4a] text-white px-6 py-3 rounded-lg font-bold hover:shadow-lg hover:shadow-[#0A1128]/40 transition-all active:scale-95 neumorphic border border-[#0A1128]/20">
                                <span class="material-symbols-outlined">favorite</span>
                                Être le premier donateur
                            </a>
                        </div>
                    @endif
                </section>

                <section>
                    <h2 class="text-2xl font-black font-headline mb-6 text-[#0A1128] flex items-center gap-3 reveal">
                        <span class="material-symbols-outlined text-[#F5A623] text-4xl p-2 bg-gradient-to-br from-[#F5A623]/15 to-[#FFD085]/10 rounded-xl border border-[#F5A623]/20 shadow-lg shadow-[#F5A623]/5">map</span>
                        Localisation du projet
                    </h2>
                    <div class="glass-card backdrop-blur-xl rounded-2xl p-4 neumorphic-lg transition-all duration-300 reveal">
                        <div id="map" class="z-0 border border-gray-200/40 rounded-xl overflow-hidden shadow-inner"></div>
                        <div class="mt-4 p-4 bg-gradient-to-r from-[#0A1128]/5 to-[#F5A623]/5 rounded-lg border border-[#0A1128]/10 flex items-start gap-3 hover:bg-[#F5A623]/8 transition-all">
                            <span class="material-symbols-outlined text-[#0A1128] flex-shrink-0 mt-0.5">security</span>
                            <p class="text-xs font-medium text-[#0A1128] leading-relaxed">
                                Les coordonnées exactes sont affichées à des fins de transparence. L'association partenaire est responsable de la mise en œuvre sur ce site.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-8">

                        <div class="glass-card p-6 rounded-2xl reveal">
                            <div class="relative z-10 mb-6">
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Fonds Collectés</p>
                                <div class="flex items-end gap-2 mb-3">
                                    <span class="text-3xl font-black text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }}</span>
                                    <span class="text-lg font-bold text-[#F5A623] mb-0.5">DH</span>
                                </div>

                                @php
                                    $percentage = $project->goalAmount > 0 ? min(($project->currentAmount / $project->goalAmount) * 100, 100) : 0;
                                @endphp
                                <div class="h-2.5 w-full bg-slate-100 rounded-full overflow-hidden mb-2 shadow-inner">
                                    <div class="h-full progress-bar rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="font-bold text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                                    <span class="text-slate-400">Objectif: {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @if($project->status === 'OPEN')
                                    <a href="{{ route('donations.create', $project->id) }}" class="block w-full bg-gradient-to-r from-[#0A1128] to-[#162040] hover:from-[#F5A623] hover:to-[#FFD085] text-white hover:text-[#0A1128] py-4 rounded-lg font-bold text-center transition-all duration-300 shadow-lg hover:shadow-xl hover:shadow-[#F5A623]/30">
                                        Faire un don
                                    </a>
                                    <p class="text-center text-[10px] text-slate-400 font-medium flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">lock</span>
                                        Paiement Sécurisé
                                    </p>
                                @else
                                    <button disabled class="w-full bg-slate-100 text-slate-400 py-4 rounded-lg font-bold cursor-not-allowed transition-all">
                                        Projet {{ $project->status === 'COMPLETED' ? 'Complété' : 'Fermé' }}
                                    </button>
                                    @if($project->status === 'COMPLETED')
                                        <p class="text-center text-xs text-emerald-500 font-bold">Merci à tous les donateurs !</p>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0d1c30] p-6 rounded-2xl text-white relative overflow-hidden reveal group shadow-xl shadow-[#0A1128]/20 border border-[#F5A623]/10">
                            <div class="absolute -right-20 -bottom-20 w-56 h-56 bg-[#F5A623]/15 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                            <div class="relative z-10">
                                <h4 class="text-xs font-bold uppercase tracking-widest text-[#F5A623] mb-4 flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    Garantie Al-Khair
                                </h4>
                                <p class="text-xs text-blue-100/80 leading-relaxed font-medium">
                                    <strong class="text-[#FFD085]">100%</strong> de votre don est reversé à l'association. Aucun frais de plateforme.
                                </p>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <script>
        // Map initialization
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

            // Scroll reveal animation
            const observerOptions = { threshold: 0.08, rootMargin: '0px 0px -60px 0px' };
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>