<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Publier un Rapport d'Impact | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
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
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">

<header class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <nav class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-4">
            <a href="{{ route('association.dashboard') }}" class="material-symbols-outlined text-on-surface-variant hover:text-primary-container transition-colors" title="Retour au tableau de bord">arrow_back</a>
            <div class="text-2xl font-black tracking-tighter text-primary-container font-headline">AL-KHAIR</div>
        </div>
        <div class="flex items-center gap-3 bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/20">
            <span class="material-symbols-outlined text-outline-variant">foundation</span>
            <span class="font-semibold text-sm">{{ auth()->user()->name ?? 'Association' }}</span>
        </div>
    </nav>
</header>

<main class="max-w-7xl mx-auto px-6 py-24 md:py-28 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <div class="lg:col-span-5 space-y-8 sticky top-32">
            <div>
                <span class="font-label text-xs uppercase tracking-widest text-secondary-container bg-secondary-container/10 px-3 py-1 rounded-full mb-4 inline-block">Étape Finale</span>
                <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight leading-tight text-primary-container mb-4">
                    Prouvez votre impact.
                </h1>
                <p class="text-on-surface-variant text-base leading-relaxed mb-6">
                    Vous êtes sur le point de clôturer le projet <strong class="text-primary-container">"{{ $project->title }}"</strong>. Partagez les résultats concrets de cette campagne avec vos donateurs.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="bg-surface-container-lowest p-6 rounded-xl flex items-start gap-4 shadow-sm border border-outline-variant/10">
                    <div class="bg-green-100 p-3 rounded-lg text-green-700">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">notifications_active</span>
                    </div>
                    <div>
                        <h3 class="font-headline font-bold text-lg">Notifications Automatiques</h3>
                        <p class="text-sm text-on-surface-variant">Dès la publication, tous les donateurs de ce projet recevront un email avec votre rapport.</p>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-6 rounded-xl flex items-start gap-4 shadow-sm border border-outline-variant/10">
                    <div class="bg-primary-container/10 p-3 rounded-lg text-primary-container">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    </div>
                    <div>
                        <h3 class="font-headline font-bold text-lg">Indice de Confiance</h3>
                        <p class="text-sm text-on-surface-variant">Des rapports détaillés et visuels augmentent la confiance des donateurs pour vos futurs projets.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 bg-surface-container-lowest rounded-[2rem] shadow-xl p-8 md:p-12 border border-outline-variant/10">
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 text-error text-sm font-medium border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('impact.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8" onsubmit="disableSubmit()">
                @csrf

                <section class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-headline text-2xl font-bold tracking-tight text-primary-container">Détails de réalisation</h2>
                    </div>

                    <div class="space-y-1.5">
                        <label for="completionDate" class="font-label text-[10px] uppercase font-bold tracking-widest text-on-surface-variant">Date de réalisation *</label>
                        <input type="date" id="completionDate" name="completionDate" value="{{ old('completionDate') }}" required 
                               max="{{ date('Y-m-d') }}"
                               class="w-full bg-surface-container-low border-0 rounded-xl py-4 px-4 focus:ring-2 focus:ring-secondary-container transition-all text-on-surface"/>
                    </div>
                    
                    <div class="space-y-1.5">
                        <label for="description" class="font-label text-[10px] uppercase font-bold tracking-widest text-on-surface-variant">Description de l'impact *</label>
                        <textarea id="description" name="description" rows="6" required placeholder="Expliquez concrètement comment les fonds ont été utilisés et quel a été l'impact sur les bénéficiaires (Min. 50 caractères)..."
                                  class="w-full bg-surface-container-low border-0 rounded-xl p-4 focus:ring-2 focus:ring-secondary-container text-sm transition-all resize-y">{{ old('description') }}</textarea>
                    </div>
                </section>

                <hr class="border-outline-variant/20">

                <section class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-headline text-2xl font-bold tracking-tight text-primary-container">Preuves Visuelles</h2>
                        <p class="text-on-surface-variant text-sm">Une image vaut mille mots. Montrez le résultat de vos actions.</p>
                    </div>

                    <div class="p-6 border-2 border-dashed border-outline-variant/50 rounded-xl bg-surface-container-low hover:bg-surface-container-high transition-colors group">
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-secondary-container text-3xl group-hover:scale-110 transition-transform">add_photo_alternate</span>
                            <div class="flex-grow">
                                <label for="image" class="block text-primary-container font-bold mb-1 cursor-pointer">Photo principale de la réalisation *</label>
                                <p class="text-xs text-on-surface-variant mb-4">Format: JPG, PNG, WEBP (Max 5Mo).</p>
                                <input type="file" id="image" name="image" accept="image/*" required
                                       class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary-container file:text-white hover:file:bg-slate-800 transition-colors cursor-pointer"/>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="videoLink" class="font-label text-[10px] uppercase font-bold tracking-widest text-on-surface-variant">Lien vidéo YouTube (Optionnel)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline-variant">play_circle</span>
                            </div>
                            <input type="url" id="videoLink" name="videoLink" value="{{ old('videoLink') }}" 
                                   class="w-full bg-surface-container-low border-0 rounded-xl py-4 pl-12 pr-4 focus:ring-2 focus:ring-secondary-container transition-all" 
                                   placeholder="https://youtube.com/watch?v=..."/>
                        </div>
                    </div>
                </section>

                <div class="pt-6">
                    <button type="submit" id="submitBtn" class="w-full bg-primary-container text-white font-headline font-extrabold text-lg py-5 rounded-xl shadow-lg hover:bg-slate-800 active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        <span id="btnText">Publier le Rapport</span>
                        <span class="material-symbols-outlined" id="btnIcon">publish</span>
                    </button>
                    <p class="text-center text-[10px] text-on-surface-variant/60 mt-4 uppercase tracking-widest font-bold">Cette action clôturera définitivement le projet</p>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    // Empêcher le double clic lors de la soumission
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Publication en cours...';
        document.getElementById('btnIcon').innerText = 'sync';
        document.getElementById('btnIcon').classList.add('animate-spin');
    }
</script>

</body>
</html>