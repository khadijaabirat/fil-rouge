<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modifier le Projet | AL-KHAIR</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

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
                <span class="material-symbols-outlined">edit_document</span>
                <span class="font-body text-sm font-bold">Modifier Projet</span>
            </a>
        </div>
    </nav>
    <div class="px-6 py-8 border-t border-surface-container-high">
        <a href="{{ route('association.dashboard') }}" class="flex items-center space-x-3 text-on-surface-variant px-2 py-2 hover:bg-surface-container-low rounded-lg transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            <span class="font-body text-sm font-medium">Retour</span>
        </a>
    </div>
</aside>

<header class="fixed top-0 right-0 lg:left-64 z-50 bg-surface/80 text-on-surface font-headline font-bold tracking-tight flex justify-between items-center px-8 py-4 h-16 backdrop-blur-md border-b border-outline-variant/10">
    <div class="flex items-center">
        <span class="text-on-surface-variant/60 mr-2 hidden md:inline">Mes Projets</span>
        <span class="material-symbols-outlined text-sm hidden md:inline">chevron_right</span>
        <span class="ml-2 text-primary-container">Modifier la campagne</span>
    </div>
    <div class="flex items-center space-x-4">
        <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-primary-container font-bold">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
    </div>
</header>

<main class="lg:ml-64 pt-24 pb-20 px-6 md:px-12 max-w-5xl mx-auto">
    <header class="mb-10">
        <h2 class="font-headline font-extrabold text-4xl text-primary-container tracking-tight mb-2">Mise à jour du Projet</h2>
        <p class="text-on-surface-variant max-w-2xl leading-relaxed">Modifiez les détails de votre campagne pour tenir vos donateurs informés.</p>
    </header>

    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-xl mb-10 shadow-sm flex items-start gap-4">
        <span class="material-symbols-outlined text-blue-500 text-2xl">policy</span>
        <div>
            <h3 class="text-blue-800 font-bold font-headline mb-1">Politique de transparence AL-KHAIR</h3>
            <p class="text-sm text-blue-700 leading-relaxed">
                Pour des raisons de sécurité et de confiance envers vos donateurs, l'objectif financier <strong class="bg-blue-100 px-2 py-0.5 rounded">{{ number_format($project->goalAmount, 0, ',', ' ') }} DH</strong> et la catégorie ne peuvent plus être modifiés après la publication. Vous pouvez uniquement mettre à jour le contenu narratif et visuel de la campagne.
            </p>
        </div>
    </div>

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

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-surface-container-lowest p-8 md:p-10 rounded-3xl shadow-sm border border-outline-variant/10">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label for="title" class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant px-1">Titre du projet *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required
                   class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all font-headline font-bold text-lg"/>
        </div>

        <div class="space-y-2">
            <label for="ville" class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant px-1">Ville/Région *</label>
            <input type="text" id="ville" name="ville" value="{{ old('ville', $project->ville) }}" required placeholder="ex: Casablanca, Marrakech..."
                   class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all"/>
            @error('ville') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-2">
            <label class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant px-1">Image du Projet (Optionnel)</label>
            <div class="flex flex-col md:flex-row items-start gap-8 bg-surface-container-low p-6 rounded-2xl border border-outline-variant/30">
                
                @if($project->image)
                    <div class="w-full md:w-1/3 flex-shrink-0 relative rounded-xl overflow-hidden shadow-sm group">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Image actuelle" class="w-full h-40 object-cover">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                            <span class="text-white text-xs font-bold uppercase tracking-widest">Image Actuelle</span>
                        </div>
                    </div>
                @endif

                <div class="w-full flex-1 space-y-4">
                    <p class="text-sm font-bold text-primary-container">Remplacer l'image</p>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/jpg" 
                           class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-white hover:file:bg-slate-800 transition-colors cursor-pointer"/>
                    <p class="text-[10px] uppercase font-bold tracking-widest text-on-surface-variant/60">JPG, PNG, WEBP • Max 5MB</p>
                    <div class="mt-2 px-3 py-1 bg-secondary-container/10 border border-secondary-container/20 rounded-full inline-block">
                        <p class="text-[9px] font-bold text-secondary-container tracking-widest">⚠️ MAXIMUM 5 MB</p>
                    </div>
                    
                    <div id="imagePreview" class="hidden mt-4">
                        <p class="text-xs font-bold text-secondary mb-2">Nouvel Aperçu :</p>
                        <img id="preview" class="w-full max-w-sm h-32 object-cover rounded-lg shadow-sm border-2 border-secondary" alt="Aperçu">
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-2">
            <label for="videoUrl" class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant px-1">Lien Vidéo YouTube (Optionnel)</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-outline-variant">smart_display</span>
                </div>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl', $project->videoUrl) }}" placeholder="https://youtube.com/..." 
                       class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 pl-12 text-on-surface transition-all"/>
            </div>
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-xs font-label font-bold uppercase tracking-wider text-on-surface-variant px-1 flex justify-between">
                <span>Description détaillée *</span>
                <span class="bg-surface-container-high px-2 py-0.5 rounded text-[10px]">Requis</span>
            </label>
            <textarea id="description" name="description" rows="8" required 
                      class="w-full bg-surface border border-outline-variant/30 focus:ring-2 focus:ring-secondary focus:border-transparent rounded-xl p-4 text-on-surface transition-all resize-y">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="pt-8 mt-8 border-t border-outline-variant/20 flex flex-col sm:flex-row items-center justify-end gap-4">
            <a href="{{ route('association.dashboard') }}" class="w-full sm:w-auto px-8 py-4 text-center text-on-surface-variant font-headline font-bold rounded-xl hover:bg-surface-container-low transition-all">
                Annuler
            </a>
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-primary-container text-white font-headline font-bold rounded-xl shadow-lg hover:bg-slate-800 active:scale-95 transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">save</span>
                Mettre à jour
            </button>
        </div>
    </form>
</main>

<script>
    // Logic for Image Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').classList.add('hidden');
        }
    });
</script>

</body>
</html>