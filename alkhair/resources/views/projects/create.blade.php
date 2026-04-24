<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nouveau Projet | AL-KHAIR</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary-container": "#021c36",
                        "secondary-container": "#feb700",
                        "secondary": "#7c5800",
                        "surface": "#f8f9fb",
                        "on-surface": "#191c1e",
                        "on-surface-variant": "#43474d",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "surface-container-high": "#e6e8ea",
                        "outline-variant": "#c4c6ce",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                        "on-error-container": "#93000a",
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
        .bento-grid { display: grid; grid-template-columns: repeat(12, 1fr); gap: 1.5rem; }
        /* Style pour l'input file */
        input[type="file"]::file-selector-button {
            border: 2px solid #7c5800;
            background: transparent;
            color: #7c5800;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }
        input[type="file"]::file-selector-button:hover { background: #7c580010; }
    </style>
</head>
<body class="bg-surface text-on-surface font-body antialiased">

<aside class="hidden lg:flex h-screen w-64 fixed left-0 top-0 z-40 bg-surface-container-lowest flex-col border-r border-outline-variant/20 shadow-sm">
    <div class="px-8 py-10">
        <h1 class="font-headline font-black text-2xl text-primary-container tracking-tight">AL-KHAIR</h1>
        <p class="text-xs font-label uppercase tracking-[0.1em] text-on-surface-variant opacity-60 mt-1">Espace Association</p>
    </div>
    <nav class="flex-grow">
        <div class="flex flex-col space-y-1">
            <a href="{{ route('association.dashboard') }}" class="flex items-center space-x-3 text-on-surface-variant px-6 py-3 hover:bg-surface-container-low transition-all">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-body text-sm font-medium">Tableau de bord</span>
            </a>
            <a href="#" class="flex items-center space-x-3 bg-secondary-container/10 text-secondary border-r-4 border-secondary px-6 py-3 transition-all">
                <span class="material-symbols-outlined">add_circle</span>
                <span class="font-body text-sm font-bold">Nouveau Projet</span>
            </a>
            <a href="{{ route('impact.create', 0) }}" class="flex items-center space-x-3 text-on-surface-variant px-6 py-3 hover:bg-surface-container-low transition-all">
                <span class="material-symbols-outlined">verified</span>
                <span class="font-body text-sm font-medium">Preuves d'impact</span>
            </a>
        </div>
    </nav>
    <div class="px-6 py-8 border-t border-surface-container-high space-y-2">
        <a href="{{ route('association.profile') }}" class="flex items-center space-x-3 text-on-surface-variant px-2 py-2 hover:bg-surface-container-low rounded-lg transition-all">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-body text-sm font-medium">Paramètres</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 text-error px-2 py-2 hover:bg-error-container/30 rounded-lg transition-all">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-body text-sm font-medium">Déconnexion</span>
            </button>
        </form>
    </div>
</aside>

<header class="fixed top-0 right-0 lg:left-64 z-50 bg-surface/80 text-on-surface font-headline font-bold tracking-tight flex justify-between items-center px-8 py-4 h-16 backdrop-blur-md border-b border-outline-variant/10">
    <div class="flex items-center">
        <span class="text-on-surface-variant/60 mr-2 hidden md:inline">Mes Projets</span>
        <span class="material-symbols-outlined text-sm hidden md:inline">chevron_right</span>
        <span class="ml-2 text-primary-container">Lancer une campagne</span>
    </div>
    <div class="flex items-center space-x-4">
        <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-primary-container font-bold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
    </div>
</header>

<main class="lg:ml-64 pt-24 pb-20 px-6 md:px-12 max-w-7xl mx-auto">
    <header class="mb-10">
        <h2 class="font-headline font-extrabold text-4xl text-primary-container tracking-tight mb-2">Nouveau Projet</h2>
        <p class="text-on-surface-variant max-w-2xl leading-relaxed">Initiez une nouvelle campagne d'impact. Assurez-vous que les informations sont précises pour garantir la transparence envers vos donateurs.</p>
    </header>

    @if ($errors->any())
        <div class="mb-8 p-4 rounded-xl bg-error-container text-on-error-container border border-error/20 shadow-sm">
            <div class="flex items-center gap-2 mb-2 font-bold">
                <span class="material-symbols-outlined text-error">warning</span>
                Veuillez corriger les erreurs suivantes :
            </div>
            <ul class="list-disc list-inside text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="bento-grid flex flex-col lg:grid" onsubmit="disableSubmit()">
        @csrf

        <section class="col-span-8 bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 space-y-6">
            <div class="flex items-center space-x-3 mb-2">
                <span class="material-symbols-outlined text-secondary">identity_platform</span>
                <h3 class="font-headline font-bold text-xl text-primary-container">Identité & Localisation</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant mb-2">Titre du projet *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="ex: Construction d'un puits à Al-Haouz" 
                           class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all"/>
                </div>

                <div>
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant mb-2">Catégorie *</label>
                    <div class="relative">
                        <select name="category_id" required class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all appearance-none cursor-pointer">
                            <option value="">Sélectionnez...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-4 text-outline pointer-events-none">expand_more</span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant mb-2">Lien Vidéo YouTube (Optionnel)</label>
                    <input type="url" name="videoUrl" value="{{ old('videoUrl') }}" placeholder="https://youtube.com/..." 
                           class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all"/>
                </div>

                <div class="col-span-1 md:col-span-2 mt-2">
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant mb-2 flex items-center justify-between">
                        <span>Emplacement sur la carte *</span>
                        <span class="text-[10px] normal-case font-normal text-secondary bg-secondary-container/20 px-2 py-1 rounded">Cliquez sur la carte</span>
                    </label>
                    
                    <div id="map" class="w-full h-64 rounded-xl border-2 border-outline-variant/30 z-0"></div>
                    
                    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                    
                    @error('latitude') <p class="text-error text-xs mt-1 font-medium">L'emplacement sur la carte est obligatoire.</p> @enderror
                </div>
            </div>
        </section>

        <section class="col-span-4 bg-primary-container p-8 rounded-2xl text-white space-y-6 shadow-xl relative overflow-hidden">
            <div class="relative z-10 space-y-6">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-secondary-container">payments</span>
                    <h3 class="font-headline font-bold text-xl">Objectifs</h3>
                </div>

                <div>
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-gray-300 mb-2">Objectif financier (DH) *</label>
                    <div class="relative">
                        <span class="absolute right-4 top-4 font-bold text-gray-400">DH</span>
                        <input type="number" name="goalAmount" value="{{ old('goalAmount') }}" required min="100" placeholder="0" 
                               class="w-full bg-white/10 border border-white/20 focus:ring-2 focus:ring-secondary-container focus:border-transparent rounded-xl p-4 pr-12 text-white text-2xl font-bold transition-all"/>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-gray-300 mb-2">Date de début *</label>
                    <input type="date" name="startDate" value="{{ old('startDate', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required 
                           class="w-full bg-white/10 border border-white/20 focus:ring-2 focus:ring-secondary-container rounded-xl p-4 text-white transition-all cursor-pointer [color-scheme:dark]"/>
                </div>

                <div>
                    <label class="block text-xs font-label font-bold uppercase tracking-wider text-gray-300 mb-2">Date de fin prévue *</label>
                    <input type="date" name="endDate" value="{{ old('endDate') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required 
                           class="w-full bg-white/10 border border-white/20 focus:ring-2 focus:ring-secondary-container rounded-xl p-4 text-white transition-all cursor-pointer [color-scheme:dark]"/>
                </div>

                <div class="p-4 rounded-xl bg-white/10 backdrop-blur-sm border border-white/10 flex items-start gap-2">
                    <span class="material-symbols-outlined text-secondary-container text-sm">info</span>
                    <p class="text-xs italic text-gray-300 leading-snug">Ces données définissent la jauge de progression publique.</p>
                </div>
            </div>
            <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-secondary-container/20 rounded-full blur-3xl pointer-events-none"></div>
        </section>

        <section class="col-span-7 bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 space-y-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <span class="material-symbols-outlined text-secondary">description</span>
                    <h3 class="font-headline font-bold text-xl text-primary-container">Description détaillée</h3>
                </div>
                <span class="text-xs font-label font-bold text-on-surface-variant/60 bg-surface-container-high px-2 py-1 rounded">Requis *</span>
            </div>
            <textarea name="description" required rows="9" placeholder="Décrivez la mission, les bénéficiaires et l'impact attendu de votre projet..." 
                      class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all resize-none">{{ old('description') }}</textarea>
        </section>

        <section class="col-span-5 bg-surface-container-low p-8 rounded-2xl shadow-sm border-2 border-dashed border-outline-variant/60 flex flex-col justify-center items-center text-center space-y-4 relative group hover:border-secondary transition-colors">
            
            <div id="imagePreviewContainer" class="hidden absolute inset-0 w-full h-full rounded-2xl overflow-hidden bg-black/5 p-2">
                <img id="preview" class="w-full h-full object-cover rounded-xl shadow-sm" alt="Aperçu">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                    <span class="text-white font-bold bg-primary-container/80 px-4 py-2 rounded-full backdrop-blur-sm">Changer l'image</span>
                </div>
            </div>

            <div id="uploadPlaceholder" class="flex flex-col items-center pointer-events-none z-10">
                <div class="bg-surface-container-lowest p-4 rounded-full shadow-sm mb-4 text-secondary">
                    <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                </div>
                <h3 class="font-headline font-bold text-lg text-primary-container">Image principale *</h3>
                <p class="text-sm text-on-surface-variant max-w-[240px] mt-1 mb-4">Une belle image attire 3x plus de donateurs.</p>
                <p class="text-[10px] uppercase font-bold tracking-widest text-on-surface-variant/60">JPG, PNG ou WEBP • Max 5MB</p>
            </div>

            <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
        </section>

        <div class="col-span-12 mt-4 space-y-6">
            <div class="flex items-center bg-secondary-container/10 p-6 rounded-xl border border-secondary/20">
                <div class="bg-secondary-container p-3 rounded-lg mr-4 flex-shrink-0">
                    <span class="material-symbols-outlined text-on-secondary-container" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <div>
                    <h4 class="font-headline font-bold text-secondary-container">Engagement Archive Éthique</h4>
                    <p class="text-sm text-on-surface-variant max-w-4xl mt-1">En publiant ce projet, votre association s'engage à collecter les fonds de manière éthique et à fournir un <strong>rapport d'impact</strong> une fois l'objectif atteint ou le projet terminé.</p>
                </div>
            </div>

            <div class="flex justify-end items-center gap-4 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('association.dashboard') }}" class="px-8 py-4 text-on-surface-variant font-headline font-bold rounded-xl hover:bg-surface-container-high transition-all">
                    Annuler
                </a>
                <button type="submit" id="submitBtn" class="px-10 py-4 bg-primary-container text-white font-headline font-bold rounded-xl shadow-lg hover:bg-slate-800 active:scale-95 transition-all flex items-center space-x-2">
                    <span id="btnText">Publier le projet</span>
                    <span id="btnIcon" class="material-symbols-outlined">rocket_launch</span>
                </button>
            </div>
        </div>

    </form>
</main>

<script>
    // 1. Logique de prévisualisation de l'image
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadPlaceholder.classList.add('opacity-0'); // Cacher le texte en gardant la zone cliquable
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            uploadPlaceholder.classList.remove('opacity-0');
        }
    });

    // 2. Logique de la carte Leaflet
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser la carte sur le Maroc
        var map = L.map('map').setView([31.7917, -7.0926], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        // Créer une icône personnalisée AL-KHAIR
        var customIcon = L.divIcon({
            className: 'custom-pin',
            html: '<div style="background-color: #021c36; width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);"><div style="width: 10px; height: 10px; background: #feb700; border-radius: 50%;"></div></div>',
            iconSize: [30, 30],
            iconAnchor: [15, 30]
        });

        var marker;
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');

        // Récupérer les anciennes coordonnées si la validation échoue
        if (latInput.value && lngInput.value) {
            marker = L.marker([latInput.value, lngInput.value], {icon: customIcon}).addTo(map);
            map.setView([latInput.value, lngInput.value], 12);
        }

        // Événement clic sur la carte
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng], {icon: customIcon}).addTo(map);
            
            // Remplir les champs cachés
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
        });

        // Régler le problème de rendu de la carte dans un layout grid/flex
        setTimeout(function(){ map.invalidateSize(); }, 100);
    });

    // 3. Sécurité contre le double clic
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Création en cours...';
        document.getElementById('btnIcon').innerText = 'hourglass_top';
    }
</script>

</body>
</html>