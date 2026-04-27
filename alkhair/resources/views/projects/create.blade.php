<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nouveau Projet | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e8ecf3 0%, #f5f7fb 50%, #ffffff 100%); }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }

        .neu-card { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04), 0 12px 32px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.02); border: 1px solid rgba(255,255,255,0.8); transition: all 0.4s cubic-bezier(.4,0,.2,1); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
        .neu-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 20px 48px rgba(0,0,0,0.1), 0 0 1px rgba(245,166,35,0.2); transform: translateY(-4px); border-color: rgba(245,166,35,0.2); }
        .neu-card-static { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04), 0 12px 32px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.02); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }

        .glass-sidebar { background: rgba(255,255,255,0.9); backdrop-filter: blur(32px); -webkit-backdrop-filter: blur(32px); border-right: 1px solid rgba(0,0,0,0.05); box-shadow: 2px 0 16px rgba(0,0,0,0.04); }
        .reveal { opacity: 0; transform: translateY(25px); transition: all 0.6s cubic-bezier(.34, 1.56, .64, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        .sidebar-link { transition: all 0.25s ease; border-radius: 14px; }
        .sidebar-link:hover { background: rgba(10,17,40,0.05); }
        .sidebar-link.active { background: linear-gradient(135deg, #0A1128, #1a2744); color: #fff; box-shadow: 0 4px 16px rgba(10,17,40,0.2); }

        /* Modern Form Inputs */
        .modern-input { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 1rem; transition: all 0.3s; font-size: 0.875rem; color: #334155; }
        .modern-input:focus { background: #ffffff; border-color: #F5A623; box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.12), inset 0 0 0 1px rgba(245,166,35,0.2); outline: none; }

        input[type="file"]::file-selector-button {
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #0A1128;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            margin-right: 1rem;
        }
        input[type="file"]::file-selector-button:hover { background: #f0f2f5; border-color: #F5A623; color: #F5A623; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white min-h-screen flex">

<!-- Sidebar -->
<aside class="h-screen w-72 fixed left-0 top-0 z-50 glass-sidebar flex flex-col p-6">
    <div class="mb-10">
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4 group">
            <div class="w-12 h-12">
                <x-application-logo class="w-12 h-12 group-hover:scale-105 transition-transform" />
            </div>
        </a>
    </div>

    <nav class="flex-grow space-y-2">
        <a href="{{ route('association.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="text-sm font-semibold">Vue d'ensemble</span>
        </a>
        <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">add_circle</span>
            <span class="text-sm font-semibold">Nouveau Projet</span>
        </a>
        <a href="{{ route('impact.create', 0) }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">verified</span>
            <span class="text-sm font-semibold">Preuves d'impact</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50">
        <a href="{{ route('association.profile') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 mb-2 text-slate-600">
            <span class="material-symbols-outlined text-xl">manage_accounts</span>
            <span class="text-sm font-semibold">Mon Profil</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-500/10 font-bold text-sm transition-all rounded-xl group">
                <span class="material-symbols-outlined text-xl">logout</span>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<main class="ml-72 flex-grow min-h-screen relative">
    <!-- Header -->
    <header class="fixed right-0 top-0 z-40 bg-white/70 backdrop-blur-2xl border-b border-black/[0.04] flex justify-between items-center px-8 py-4" style="width: calc(100% - 18rem);">
        <div class="flex items-center gap-4">
            <a href="{{ route('association.dashboard') }}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-[#0A1128]">arrow_back</span>
            </a>
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Lancer une campagne</h2>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Association</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20">
                    <span class="material-symbols-outlined text-[20px]">building</span>
                </div>
            </div>
        </div>
    </header>

    <div class="pt-24 pb-20 px-8 max-w-5xl mx-auto space-y-8">
        
        <div class="reveal active">
            <h2 class="text-4xl font-black text-[#0A1128] tracking-tight mb-2">Nouveau Projet</h2>
            <p class="text-slate-500 text-sm max-w-2xl leading-relaxed">Initiez une nouvelle campagne d'impact. Assurez-vous que les informations sont précises pour garantir la transparence envers vos donateurs.</p>
        </div>

        @if ($errors->any())
            <div class="neu-card-static p-6 border-l-4 border-red-500 flex items-start gap-4 reveal active bg-red-50/40 backdrop-blur-sm">
                <span class="material-symbols-outlined text-red-500 text-2xl flex-shrink-0">error</span>
                <div>
                    <strong class="block text-sm font-black text-[#0A1128] mb-2">Veuillez corriger les erreurs suivantes :</strong>
                    <ul class="list-disc list-inside text-xs text-red-600 font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8" onsubmit="disableSubmit()">
            @csrf

            <!-- Left Column -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Identity Section -->
                <div class="neu-card-static p-8 reveal">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5A623]/20 to-[#FFD085]/10 flex items-center justify-center border border-[#F5A623]/30 shadow-lg shadow-[#F5A623]/5">
                            <span class="material-symbols-outlined text-[#F5A623]">identity_platform</span>
                        </div>
                        <h3 class="font-black text-xl text-[#0A1128]">Identité & Localisation</h3>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Titre du projet <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" required placeholder="ex: Construction d'un puits à Al-Haouz" class="w-full modern-input px-4 py-3.5 font-medium"/>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Catégorie <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="category_id" required class="w-full modern-input px-4 py-3.5 appearance-none cursor-pointer">
                                        <option value="">Sélectionnez...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-4 top-3.5 text-slate-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Ville/Région <span class="text-red-500">*</span></label>
                                <input type="text" name="ville" value="{{ old('ville') }}" required placeholder="ex: Casablanca, Marrakech..." class="w-full modern-input px-4 py-3.5"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Lien Vidéo YouTube (Optionnel)</label>
                            <input type="url" name="videoUrl" value="{{ old('videoUrl') }}" placeholder="https://youtube.com/..." class="w-full modern-input px-4 py-3.5"/>
                        </div>

                        <div>
                            <label class="flex items-center justify-between text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">
                                <span>Emplacement sur la carte <span class="text-red-500">*</span></span>
                                <span class="normal-case bg-[#F5A623]/15 text-[#F5A623] px-3 py-1.5 rounded-lg font-semibold text-xs border border-[#F5A623]/30">Cliquez sur la carte</span>
                            </label>
                            <div id="map" class="w-full h-64 rounded-2xl border border-slate-200/50 z-0 shadow-lg shadow-slate-200/30"></div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div class="neu-card-static p-8 reveal" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5A623]/20 to-[#FFD085]/10 flex items-center justify-center border border-[#F5A623]/30 shadow-lg shadow-[#F5A623]/5">
                                <span class="material-symbols-outlined text-[#F5A623]">description</span>
                            </div>
                            <h3 class="font-black text-xl text-[#0A1128]">Description détaillée</h3>
                        </div>
                        <span class="text-[10px] font-bold text-slate-500 bg-slate-100/60 px-3 py-1.5 rounded-lg border border-slate-200/50">Requis *</span>
                    </div>
                    <textarea name="description" required rows="6" placeholder="Décrivez la mission, les bénéficiaires et l'impact attendu de votre projet..." class="w-full modern-input px-4 py-3.5 resize-none">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Objectives Section -->
                <div class="bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0d1c30] rounded-3xl p-8 text-white shadow-xl relative overflow-hidden reveal border border-[#F5A623]/10" style="animation-delay: 0.2s">
                    <div class="absolute -right-24 -bottom-24 w-72 h-72 bg-[#F5A623]/15 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="relative z-10 space-y-6">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[#FFD085] text-3xl" style="font-variation-settings: 'FILL' 1;">track_changes</span>
                            <h3 class="font-black text-2xl">Objectifs</h3>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-white/60 mb-2">Objectif financier <span class="text-[#FFD085]">*</span></label>
                            <div class="relative">
                                <span class="absolute right-4 top-3.5 font-black text-white/50">DH</span>
                                <input type="number" name="goalAmount" value="{{ old('goalAmount') }}" required min="100" placeholder="0" class="w-full bg-white/12 border border-white/25 focus:ring-2 focus:ring-[#F5A623] focus:border-[#F5A623] focus:bg-white/15 rounded-xl px-4 py-3.5 pr-12 text-white font-bold transition-all outline-none placeholder:text-white/40"/>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-white/60 mb-2">Date de début <span class="text-[#FFD085]">*</span></label>
                            <input type="date" name="startDate" value="{{ old('startDate', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required class="w-full bg-white/12 border border-white/25 focus:ring-2 focus:ring-[#F5A623] focus:border-[#F5A623] focus:bg-white/15 rounded-xl px-4 py-3 text-white transition-all outline-none [color-scheme:dark]"/>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-white/60 mb-2">Date de fin prévue <span class="text-[#FFD085]">*</span></label>
                            <input type="date" name="endDate" value="{{ old('endDate') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full bg-white/12 border border-white/25 focus:ring-2 focus:ring-[#F5A623] focus:border-[#F5A623] focus:bg-white/15 rounded-xl px-4 py-3 text-white transition-all outline-none [color-scheme:dark]"/>
                        </div>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="neu-card-static p-8 text-center relative group reveal border-2 border-dashed border-slate-200/60 hover:border-[#F5A623]/40 transition-all" style="animation-delay: 0.3s">
                    <div id="imagePreviewContainer" class="hidden absolute inset-0 w-full h-full rounded-3xl overflow-hidden bg-slate-100 p-2 z-10">
                        <img id="preview" class="w-full h-full object-cover rounded-2xl" alt="Aperçu">
                        <div class="absolute inset-0 bg-[#0A1128]/70 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-3xl backdrop-blur-sm pointer-events-none">
                            <span class="text-white font-black bg-[#F5A623] px-4 py-2.5 rounded-full text-xs uppercase tracking-wider">Changer l'image</span>
                        </div>
                    </div>

                    <div id="uploadPlaceholder" class="flex flex-col items-center pointer-events-none">
                        <div class="w-16 h-16 bg-gradient-to-br from-[#F5A623]/20 to-[#FFD085]/10 rounded-2xl flex items-center justify-center border border-[#F5A623]/30 mb-4 text-[#F5A623] shadow-lg shadow-[#F5A623]/10">
                            <span class="material-symbols-outlined text-4xl">add_photo_alternate</span>
                        </div>
                        <h3 class="font-black text-lg text-[#0A1128]">Image principale *</h3>
                        <p class="text-[10px] text-slate-500 mt-2 mb-4 leading-relaxed font-medium">Une belle image attire 3x plus de donateurs.</p>
                        <div class="px-4 py-2 bg-slate-100/60 rounded-lg border border-slate-200/50">
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">JPG, PNG • Max 5 MB</p>
                        </div>
                    </div>

                    <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg,image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 pt-4 reveal" style="animation-delay: 0.4s">
                    <button type="submit" id="submitBtn" class="w-full py-4 bg-gradient-to-r from-[#0A1128] via-[#162040] to-[#0d1c30] text-white font-black rounded-xl shadow-lg hover:shadow-xl hover:from-[#F5A623] hover:via-[#FFD085] hover:to-[#F5A623] hover:text-[#0A1128] active:scale-[0.98] transition-all flex items-center justify-center gap-2 uppercase tracking-wider text-sm border border-[#F5A623]/10 hover:border-[#F5A623]/40">
                        <span id="btnText">Publier le projet</span>
                        <span id="btnIcon" class="material-symbols-outlined">rocket_launch</span>
                    </button>
                    <a href="{{ route('association.dashboard') }}" class="w-full py-4 block text-center text-slate-500 font-bold rounded-xl hover:bg-slate-100 transition-colors uppercase tracking-wider text-xs border border-slate-200/50">
                        Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    // Preview Image Logic
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
                uploadPlaceholder.classList.add('opacity-0');
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
            uploadPlaceholder.classList.remove('opacity-0');
        }
    });

    // Leaflet Map Logic
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([31.7917, -7.0926], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(map);

        var customIcon = L.divIcon({
            className: 'custom-pin',
            html: '<div style="background-color: #0A1128; width: 24px; height: 24px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.3);"><div style="width: 8px; height: 8px; background: #F5A623; border-radius: 50%;"></div></div>',
            iconSize: [24, 24],
            iconAnchor: [12, 24]
        });

        var marker;
        var latInput = document.getElementById('latitude');
        var lngInput = document.getElementById('longitude');

        if (latInput.value && lngInput.value) {
            marker = L.marker([latInput.value, lngInput.value], {icon: customIcon}).addTo(map);
            map.setView([latInput.value, lngInput.value], 12);
        }

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng], {icon: customIcon}).addTo(map);
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
        });

        setTimeout(function(){ map.invalidateSize(); }, 100);
    });

    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Création en cours...';
        document.getElementById('btnIcon').innerText = 'hourglass_top';
        document.getElementById('btnIcon').classList.add('animate-spin');
    }

    // Scroll reveal animation
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>