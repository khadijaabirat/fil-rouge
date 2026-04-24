<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Créer un nouveau projet</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-gray-700 underline">Retour au tableau de bord</a>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Titre du projet *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium mb-2">Catégorie *</label>
                <select id="category_id" name="category_id" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description détaillée *</label>
                <textarea id="description" name="description" rows="5" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="goalAmount" class="block text-gray-700 font-medium mb-2">Objectif financier (en DH) *</label>
                <input type="number" id="goalAmount" name="goalAmount" min="1" step="0.01" value="{{ old('goalAmount') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('goalAmount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="startDate" class="block text-gray-700 font-medium mb-2">Date de début *</label>
                    <input type="date" id="startDate" name="startDate"  min="{{ date('Y-m-d') }}" value="{{ old('startDate') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="endDate" class="block text-gray-700 font-medium mb-2">Date de fin *</label>
                    <input type="date" id="endDate" name="endDate" value="{{ old('endDate') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('endDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

       <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Localisation du projet sur la carte *</label>
                <p class="text-sm text-gray-500 mb-2">Cliquez sur la carte pour sélectionner l'emplacement exact du projet.</p>
                
                <div id="map" class="w-full h-64 rounded-md border border-gray-300 shadow-sm z-0 relative mb-2"></div>
                
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                
                @error('latitude') <span class="text-red-500 text-sm">Veuillez sélectionner un emplacement sur la carte.</span> @enderror
            </div>

            <div class="mb-6">
                <label for="videoUrl" class="block text-gray-700 font-medium mb-2">Lien Vidéo (Optionnel)</label>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl') }}" placeholder="https://youtube.com/..." class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('videoUrl') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image du Projet (Optionnel)</label>
                <div class="flex items-center gap-4">
                    <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                </div>
                <p class="text-xs text-gray-500 mt-1">Formats acceptés: JPG, PNG, WEBP (Max: 5 Mo)</p>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div id="imagePreview" class="mt-3 hidden">
                    <img id="preview" class="w-full h-48 object-cover rounded-lg border border-gray-200" alt="Aperçu">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium transition duration-200">
                    Publier le Projet
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
 
         
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
 
        var map = L.map('map').setView([31.7917, -7.0926], 6);

        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

         var oldLat = document.getElementById('latitude').value;
        var oldLng = document.getElementById('longitude').value;
        
        if(oldLat && oldLng) {
            marker = L.marker([oldLat, oldLng]).addTo(map);
            map.setView([oldLat, oldLng], 10); 
        }

         map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

             if (marker) {
                map.removeLayer(marker);
            }

             marker = L.marker([lat, lng]).addTo(map);

                 document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
        });
    </script>
</body>
</html>
<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "surface-variant": "#e0e3e5",
              "surface-container-highest": "#e0e3e5",
              "tertiary": "#000000",
              "on-secondary-fixed-variant": "#5e4200",
              "inverse-on-surface": "#eff1f3",
              "primary-fixed": "#d2e4ff",
              "surface-bright": "#f8f9fb",
              "tertiary-fixed": "#ffdbce",
              "on-primary-fixed": "#021c36",
              "secondary-fixed": "#ffdea8",
              "outline": "#74777e",
              "error": "#ba1a1a",
              "primary-container": "#021c36",
              "inverse-primary": "#b1c8e9",
              "surface-tint": "#4a607c",
              "background": "#f8f9fb",
              "secondary-fixed-dim": "#ffba20",
              "on-primary-container": "#6f85a3",
              "primary": "#000000",
              "on-background": "#191c1e",
              "on-error": "#ffffff",
              "on-primary": "#ffffff",
              "on-tertiary-fixed-variant": "#7f2b00",
              "on-error-container": "#93000a",
              "on-secondary": "#ffffff",
              "error-container": "#ffdad6",
              "primary-fixed-dim": "#b1c8e9",
              "tertiary-fixed-dim": "#ffb599",
              "surface": "#f8f9fb",
              "inverse-surface": "#2d3133",
              "on-surface-variant": "#43474d",
              "surface-dim": "#d8dadc",
              "surface-container-lowest": "#ffffff",
              "on-surface": "#191c1e",
              "on-secondary-fixed": "#271900",
              "on-tertiary-container": "#e05814",
              "outline-variant": "#c4c6ce",
              "secondary": "#7c5800",
              "on-secondary-container": "#6b4b00",
              "on-tertiary": "#ffffff",
              "on-primary-fixed-variant": "#324863",
              "on-tertiary-fixed": "#370e00",
              "tertiary-container": "#370e00",
              "surface-container-high": "#e6e8ea",
              "surface-container-low": "#f2f4f6",
              "surface-container": "#eceef0",
              "secondary-container": "#feb700"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- Side Navigation Bar -->
<aside class="fixed left-0 top-0 h-full w-64 z-40 bg-[#ffffff] dark:bg-[#021c36] border-r border-[#191c1e]/5 flex flex-col pt-20 pb-6 justify-between shadow-[32px_0_64px_rgba(0,0,0,0.02)]">
<div>
<!-- Brand Identity Anchor -->
<div class="px-6 mb-10">
<h1 class="font-['Manrope'] font-black text-xl text-[#000000] dark:text-white">Al-Khair</h1>
<p class="text-xs opacity-50 font-label tracking-widest uppercase mt-1">Ethical Archive</p>
</div>
<nav class="space-y-1">
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2 group" href="#">
<span class="material-symbols-outlined opacity-70 group-hover:opacity-100">dashboard</span>
<span class="font-['Inter'] text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all bg-[#feb700] text-[#000000] rounded-lg mx-2 font-semibold shadow-sm" href="#">
<span class="material-symbols-outlined">account_tree</span>
<span class="font-['Inter'] text-sm font-medium">Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2 group" href="#">
<span class="material-symbols-outlined opacity-70 group-hover:opacity-100">volunteer_activism</span>
<span class="font-['Inter'] text-sm font-medium">Donations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2 group" href="#">
<span class="material-symbols-outlined opacity-70 group-hover:opacity-100">analytics</span>
<span class="font-['Inter'] text-sm font-medium">Impact Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2 group" href="#">
<span class="material-symbols-outlined opacity-70 group-hover:opacity-100">group</span>
<span class="font-['Inter'] text-sm font-medium">Volunteers</span>
</a>
</nav>
</div>
<div>
<nav class="space-y-1">
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-['Inter'] text-sm font-medium">Support</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 m-1 transition-all text-[#191c1e] dark:text-[#f2f4f6] hover:bg-[#f2f4f6] dark:hover:bg-[#021c36] rounded-lg mx-2" href="#">
<span class="material-symbols-outlined">logout</span>
<span class="font-['Inter'] text-sm font-medium">Logout</span>
</a>
</nav>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="ml-64 min-h-screen pb-32">
<!-- Top App Bar (Shell Component) -->
<header class="h-16 px-8 flex justify-between items-center sticky top-0 bg-surface/80 backdrop-blur-xl z-30">
<div class="flex items-center gap-2 text-on-surface-variant font-label text-xs uppercase tracking-widest">
<span>Al-Khair</span>
<span class="material-symbols-outlined text-[10px]">chevron_right</span>
<span>Projects</span>
<span class="material-symbols-outlined text-[10px]">chevron_right</span>
<span class="text-on-surface font-semibold">New Initiative</span>
</div>
<div class="flex items-center gap-4">
<button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<div class="w-10 h-10 rounded-full bg-surface-container-highest overflow-hidden">
<img alt="Profile" class="w-full h-full object-cover" data-alt="User avatar for humanitarian officer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOl9AMZj_NQpSFngEK34r5waYnUFe_PBGMT0miZ6ppM2Zq3vg99xv-FB9xddIfP5sQeCAD_TEnY4U_3sOryp0xmIy_77Wan5bB-RGAwH3J898ui9RFvqUV2_e709U45yaWK6haDBqim1j6F0mOnWhWPiKcaRLdhqY1-VDGNXs8vTvInJjCE3IKWSMZ4RMR2an912_KqzIswgKfwtWm1L-IrVa13jyW9XIntxVqHsM7b8HKuKFJYsBPte9lw_5OCasfzm7mdsgCsWo"/>
</div>
</div>
</header>
<div class="max-w-5xl mx-auto px-12 pt-12">
<!-- Page Title -->
<div class="mb-12">
<h2 class="font-headline font-extrabold text-4xl text-primary tracking-tight mb-2">Lancer une nouvelle initiative</h2>
<p class="text-on-surface-variant max-w-xl">Configurez les détails de votre prochain projet humanitaire. Assurez-vous que l'impact est clairement défini pour nos donateurs.</p>
</div>
<!-- Form Content -->
<form class="space-y-12">
<!-- Section 1: Identité & Visuels (Bento Style Grid) -->
<div class="grid grid-cols-12 gap-8">
<!-- Text Data -->
<div class="col-span-7 space-y-8">
<div class="space-y-2">
<label class="font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Titre du Projet</label>
<input class="w-full bg-surface-container-lowest border-none rounded-xl px-6 py-4 text-lg font-headline font-semibold shadow-[0_4px_20px_rgba(0,0,0,0.02)] focus:ring-2 focus:ring-secondary/20 placeholder:text-on-surface-variant/40" placeholder="Ex: Eau potable pour le village de Tifrit" type="text"/>
</div>
<div class="space-y-2">
<label class="font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Description détaillée</label>
<textarea class="w-full bg-surface-container-lowest border-none rounded-xl px-6 py-4 shadow-[0_4px_20px_rgba(0,0,0,0.02)] focus:ring-2 focus:ring-secondary/20 placeholder:text-on-surface-variant/40 leading-relaxed" placeholder="Décrivez les objectifs, le contexte et les bénéficiaires..." rows="6"></textarea>
</div>
<div class="space-y-3">
<label class="font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Catégorie d'intervention</label>
<div class="flex flex-wrap gap-2">
<button class="px-5 py-2.5 rounded-full border border-outline-variant text-sm font-medium hover:bg-surface-container-high transition-colors" type="button">Santé</button>
<button class="px-5 py-2.5 rounded-full bg-secondary-container text-on-secondary-container font-semibold text-sm shadow-sm ring-2 ring-secondary/10" type="button">Éducation</button>
<button class="px-5 py-2.5 rounded-full border border-outline-variant text-sm font-medium hover:bg-surface-container-high transition-colors" type="button">Eau</button>
<button class="px-5 py-2.5 rounded-full border border-outline-variant text-sm font-medium hover:bg-surface-container-high transition-colors" type="button">Environnement</button>
<button class="px-5 py-2.5 rounded-full border border-outline-variant text-sm font-medium hover:bg-surface-container-high transition-colors" type="button">Urgences</button>
</div>
</div>
</div>
<!-- Visual Upload Area -->
<div class="col-span-5 flex flex-col h-full">
<label class="font-label text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1 mb-2">Image de couverture</label>
<div class="flex-grow group relative cursor-pointer overflow-hidden rounded-2xl bg-surface-container-low border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center text-center p-8 hover:bg-surface-container-high transition-all">
<div class="w-16 h-16 rounded-full bg-surface-container-lowest flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-secondary text-3xl">add_photo_alternate</span>
</div>
<p class="font-semibold text-primary mb-1">Télécharger un média</p>
<p class="text-xs text-on-surface-variant">PNG, JPG ou WEBP (Max. 10MB)<br/>Format recommandé : 16:9</p>
<!-- Visual Preview Placeholder Overlay -->
<div class="absolute inset-0 opacity-0 group-hover:opacity-10 bg-on-surface transition-opacity pointer-events-none"></div>
</div>
</div>
</div>
<!-- Section 2: Objectifs & Calendrier (Tonal Layering) -->
<div class="bg-surface-container-low rounded-[2rem] p-10 grid grid-cols-2 gap-12">
<div class="space-y-6">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-secondary">monetization_on</span>
<h3 class="font-headline font-bold text-xl">Objectifs Financiers</h3>
</div>
<div class="space-y-4">
<div class="relative">
<span class="absolute right-6 top-1/2 -translate-y-1/2 font-bold text-on-surface-variant">MAD</span>
<input class="w-full bg-surface-container-lowest border-none rounded-xl px-6 py-4 text-2xl font-headline font-extrabold shadow-sm focus:ring-2 focus:ring-secondary/20" placeholder="0.00" type="number"/>
</div>
<div class="p-4 rounded-xl bg-surface-container-lowest/50 border border-outline-variant/10">
<p class="text-xs font-label uppercase text-on-surface-variant font-bold mb-1">Impact Estimé</p>
<p class="text-sm text-on-surface leading-relaxed">En atteignant cet objectif, nous pourrons impacter directement <span class="font-bold text-secondary">~250 bénéficiaires</span> locaux.</p>
</div>
</div>
</div>
<div class="space-y-6">
<div class="flex items-center gap-3 mb-2">
<span class="material-symbols-outlined text-secondary">event</span>
<h3 class="font-headline font-bold text-xl">Planification</h3>
</div>
<div class="space-y-4">
<div class="space-y-2">
<label class="text-xs font-label font-bold text-on-surface-variant uppercase tracking-tight">Date de clôture de la campagne</label>
<div class="relative">
<span class="absolute left-6 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">calendar_today</span>
<input class="w-full bg-surface-container-lowest border-none rounded-xl pl-14 pr-6 py-4 shadow-sm focus:ring-2 focus:ring-secondary/20" type="date"/>
</div>
</div>
<p class="text-xs text-on-surface-variant/70 italic px-2">Les campagnes durent en moyenne 45 jours pour une efficacité optimale.</p>
</div>
</div>
</div>
<!-- Section 3: Impact Ledger Visualizer -->
<div class="relative overflow-hidden rounded-[2rem] h-48 bg-primary-container group">
<img alt="Impact background" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-overlay group-hover:scale-105 transition-transform duration-[2s]" data-alt="Abstract silhouette of children running in sunlight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqHLIQ_l8Gv164BLqd15MSPEIQTZ8ZtwIT6w29qqdE4JPZ_g0ei1dgmZLTAb5i2alpXL_yV95XuMddei2_fR0dXcChkRt81_9fFtjHAD4IPnUXUNqQUikbGSkBBl5pd7oSKGbDlzWR1pcCCa4CS3uf5YoS1ZsAqtlBVqkBdaxox9MSQb26fI813ZEz48C9ubr7qXG47K0KPvtXiXR6CBwq0Y1PLTOaVEscQq51H7OCsp4cqDnTk9q0zUOwlqLymNJifo1YDw7OSbQ"/>
<div class="relative h-full flex flex-col justify-center px-12 text-on-primary">
<p class="font-label text-xs uppercase tracking-[0.3em] opacity-60 mb-2">Transparence Totale</p>
<h4 class="font-headline text-2xl font-bold max-w-md">Chaque Dirham collecté est tracé dans notre Archive Éthique.</h4>
</div>
<!-- Glassmorphism decorative element -->
<div class="absolute right-12 top-1/2 -translate-y-1/2 w-32 h-32 rounded-full bg-secondary-container/20 blur-3xl"></div>
</div>
</form>
</div>
</main>
<!-- Sticky Bottom Action Bar -->
<footer class="fixed bottom-0 right-0 left-64 bg-surface/80 backdrop-blur-2xl py-6 px-12 flex justify-end items-center gap-4 z-40 border-t border-outline-variant/5">
<button class="px-8 py-3.5 rounded-xl border border-outline-variant text-on-surface font-semibold hover:bg-surface-container-high transition-all active:scale-95">
            Enregistrer comme brouillon
        </button>
<button class="px-10 py-3.5 rounded-xl bg-primary-container text-white font-headline font-bold shadow-lg shadow-primary-container/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center gap-3">
<span>Publier le projet</span>
<span class="material-symbols-outlined text-secondary-container">send</span>
</button>
</footer>
</body></html>