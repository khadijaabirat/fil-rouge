<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Publier Rapport d'Impact | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
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
        h1, h2, h3, .font-manrope { font-family: 'Manrope', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        /* Style pour l'input file caché */
        .file-upload-wrapper { position: relative; overflow: hidden; cursor: pointer; }
        .file-upload-wrapper input[type=file] { position: absolute; font-size: 100px; opacity: 0; right: 0; top: 0; cursor: pointer; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen selection:bg-secondary-container selection:text-primary-container">

<header class="fixed top-0 w-full z-40 bg-white/90 backdrop-blur-md shadow-sm flex justify-between items-center px-8 h-16 border-b border-outline-variant/10">
    <div class="text-xl font-extrabold tracking-tighter text-primary-container font-manrope">AL-KHAIR</div>
    <div class="hidden md:flex items-center gap-8 font-manrope tracking-tight font-semibold text-sm">
        <a class="text-on-surface-variant hover:text-primary-container transition-colors" href="{{ route('association.dashboard') }}">Dashboard</a>
        <a class="text-primary-container border-b-2 border-secondary-container pb-1" href="#">Preuves d'Impact</a>
    </div>
    <div class="flex items-center gap-4">
        <div class="w-8 h-8 rounded-full bg-secondary-container text-primary-container flex items-center justify-center font-bold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
    </div>
</header>

<aside class="fixed left-0 h-full w-64 z-50 bg-primary-container flex flex-col py-6 shadow-2xl shadow-blue-900/20 hidden lg:flex">
    <div class="px-6 mb-10 mt-12">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center">
                <span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">account_balance</span>
            </div>
            <div>
                <h2 class="text-white font-manrope font-bold leading-tight line-clamp-1">{{ auth()->user()->name }}</h2>
                <p class="text-slate-400 text-[10px] uppercase tracking-widest">Partenaire Vérifié</p>
            </div>
        </div>
    </div>
    <nav class="flex-grow flex flex-col gap-1 font-body text-sm font-medium uppercase tracking-wider">
        <a class="flex items-center gap-3 text-slate-400 hover:text-white px-4 py-3 mx-2 hover:bg-[#021c36] hover:translate-x-1 transition-all rounded-lg" href="{{ route('association.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span> Vue d'ensemble
        </a>
        <a class="flex items-center gap-3 text-slate-400 hover:text-white px-4 py-3 mx-2 hover:bg-[#021c36] hover:translate-x-1 transition-all rounded-lg" href="{{ route('association.dashboard') }}#projets">
            <span class="material-symbols-outlined">account_tree</span> Mes Projets
        </a>
        <a class="flex items-center gap-3 bg-slate-800/50 text-secondary-container rounded-lg px-4 py-3 mx-2 border-l-4 border-secondary-container" href="#">
            <span class="material-symbols-outlined">history_edu</span> Rapport d'Impact
        </a>
    </nav>
    <div class="mt-auto px-6 space-y-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 text-error hover:bg-error-container/10 px-4 py-3 rounded-lg transition-colors font-bold text-xs uppercase tracking-widest">
                <span class="material-symbols-outlined text-[18px]">logout</span> Déconnexion
            </button>
        </form>
    </div>
</aside>

<main class="lg:pl-64 pt-16 min-h-screen">
    
    <form action="{{ route('impact.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="max-w-7xl mx-auto px-6 md:px-8 py-10" id="impactForm" onsubmit="disableSubmit()">
        @csrf

        @if ($errors->any())
            <div class="mb-8 p-4 rounded-xl bg-error-container text-error text-sm font-medium border border-error/20 flex items-start gap-3 shadow-sm">
                <span class="material-symbols-outlined">error</span>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-outline-variant/20 pb-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="px-3 py-1 bg-secondary-container/10 text-secondary-container text-[10px] font-bold rounded-full uppercase tracking-wider border border-secondary-container/20">
                        Publication Requise
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-manrope font-extrabold tracking-tight text-primary-container">
                    {{ $project->title }}
                </h1>
                <p class="mt-4 text-on-surface-variant font-medium max-w-2xl">
                    Finalisation du rapport d'impact institutionnel. Veuillez fournir les preuves visuelles et descriptives pour débloquer les archives éthiques.
                </p>
            </div>
            <div class="bg-surface-container-lowest border border-outline-variant/10 px-8 py-6 rounded-2xl text-left md:text-right shadow-sm w-full md:w-auto">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">Fonds à justifier</p>
                <p class="text-3xl font-manrope font-extrabold text-primary-container">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</p>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-10">
            
            <div class="xl:col-span-8 space-y-8">
                
                <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/10">
                    <div class="flex items-center gap-3 mb-6 border-b border-outline-variant/10 pb-4">
                        <span class="material-symbols-outlined text-secondary-container bg-secondary-container/10 p-2 rounded-xl">photo_camera</span>
                        <h3 class="text-xl font-manrope font-bold text-primary-container">Preuve Visuelle *</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="file-upload-wrapper border-2 border-dashed border-outline-variant/60 hover:border-secondary-container rounded-2xl h-56 flex flex-col items-center justify-center bg-surface-container-low hover:bg-secondary-container/5 transition-all group">
                            <span class="material-symbols-outlined text-4xl text-outline-variant group-hover:text-secondary-container mb-3 transition-colors">cloud_upload</span>
                            <p class="text-sm font-bold text-primary-container">Ajouter une photo</p>
                            <p class="text-[10px] text-on-surface-variant mt-2 uppercase tracking-widest font-bold">JPG, PNG (MAX. 5MB)</p>
                            <input type="file" name="image" id="imageInput" accept="image/*" required>
                        </div>
                        
                        <div id="previewContainer" class="relative rounded-2xl overflow-hidden h-56 bg-surface-container-high border border-outline-variant/20 hidden">
                            <img id="imagePreview" class="w-full h-full object-cover" src="" alt="Aperçu">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-white text-xs font-bold uppercase tracking-widest">Image Sélectionnée</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="bg-surface-container-lowest rounded-3xl p-8 shadow-sm border border-outline-variant/10">
                    <div class="flex items-center gap-3 mb-6 border-b border-outline-variant/10 pb-4">
                        <span class="material-symbols-outlined text-primary-container bg-primary-container/10 p-2 rounded-xl">history_edu</span>
                        <h3 class="text-xl font-manrope font-bold text-primary-container">Narration de l'Impact *</h3>
                    </div>
                    <div class="space-y-4">
                        <label class="block">
                            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-2 block flex justify-between">
                                Récit des réalisations 
                                <span class="bg-surface-container-highest px-2 py-0.5 rounded">Requis</span>
                            </span>
                            <textarea name="description" required class="w-full rounded-2xl border-outline-variant/30 bg-surface focus:ring-2 focus:ring-secondary-container focus:border-transparent p-5 text-on-surface transition-all resize-y" placeholder="Expliquez en détail comment les fonds ont été utilisés et l'impact direct sur les bénéficiaires..." rows="6">{{ old('description') }}</textarea>
                        </label>
                        <div class="flex gap-2 opacity-70 pointer-events-none">
                            <span class="px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-bold text-on-surface-variant border border-outline-variant/20">#Transparence</span>
                            <span class="px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-bold text-on-surface-variant border border-outline-variant/20">#AlKhairImpact</span>
                        </div>
                    </div>
                </section>
                
                <input type="hidden" name="completionDate" value="{{ date('Y-m-d') }}">

            </div>

            <aside class="xl:col-span-4 space-y-6">
                
                <div class="bg-primary-container rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-primary-container/20">
                    <div class="relative z-10">
                        <span class="material-symbols-outlined text-secondary-container text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                        <h4 class="text-xl font-manrope font-bold mb-3 text-secondary-container">Engagement Éthique</h4>
                        <p class="text-sm text-blue-100 leading-relaxed mb-6 font-medium">
                            Ce rapport sera archivé de manière immuable et affiché publiquement sur la page du projet. Il garantit la transparence totale envers vos donateurs.
                        </p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
                </div>

                <div class="bg-surface-container-lowest rounded-3xl p-8 border border-outline-variant/10 shadow-sm sticky top-24">
                    <h4 class="text-sm font-manrope font-extrabold uppercase tracking-widest mb-6 text-primary-container">Finalisation</h4>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant font-bold">
                            <span class="material-symbols-outlined text-green-500 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Fonds collectés
                        </li>
                        <li class="flex items-center gap-3 text-sm text-on-surface-variant font-bold">
                            <span class="material-symbols-outlined text-green-500 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            Projet clôturé
                        </li>
                        <li class="flex items-center gap-3 text-sm text-primary-container font-bold">
                            <span class="material-symbols-outlined text-secondary-container text-xl animate-pulse" style="font-variation-settings: 'FILL' 1;">pending</span>
                            Preuve en attente
                        </li>
                    </ul>

                    <div class="space-y-4 pt-6 border-t border-outline-variant/20">
                        <button type="submit" id="submitBtn" class="w-full bg-primary-container text-white py-4 rounded-xl font-manrope font-bold text-sm uppercase tracking-widest shadow-lg shadow-primary-container/20 hover:scale-[1.02] transition-transform active:scale-95 flex items-center justify-center gap-2">
                            <span id="btnText">Publier le rapport final</span>
                            <span id="btnIcon" class="material-symbols-outlined">send</span>
                        </button>
                        
                        <a href="{{ route('association.dashboard') }}" class="block text-center w-full bg-surface-container-low text-primary-container py-4 rounded-xl font-manrope font-bold text-xs uppercase tracking-widest hover:bg-surface-container-high transition-colors">
                            Annuler et revenir
                        </a>
                    </div>
                </div>
            </aside>

        </div>
    </form>
</main>

<script>
    // Preview de l'image sélectionnée
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Prévenir le double clic sur le bouton de soumission
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Publication en cours...';
        document.getElementById('btnIcon').innerText = 'hourglass_top';
    }
</script>

</body>
</html>