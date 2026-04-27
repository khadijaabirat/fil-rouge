<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modifier le Projet | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

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
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">edit_document</span>
            <span class="text-sm font-semibold">Modifier Projet</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50">
        <a href="{{ route('association.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 mb-2 text-slate-600">
            <span class="material-symbols-outlined text-xl">arrow_back</span>
            <span class="text-sm font-semibold">Retour</span>
        </a>
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
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Modifier la campagne</h2>
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

    <div class="pt-24 pb-20 px-8 max-w-4xl mx-auto space-y-8">
        
        <div class="reveal active">
            <h2 class="text-4xl font-black text-[#0A1128] tracking-tight mb-2">Mise à jour du Projet</h2>
            <p class="text-slate-500 text-sm max-w-2xl leading-relaxed">Modifiez les détails de votre campagne pour tenir vos donateurs informés.</p>
        </div>

        <div class="bg-blue-50/60 border-l-4 border-blue-500 p-6 rounded-2xl mb-10 shadow-sm flex items-start gap-4 reveal active backdrop-blur-sm">
            <span class="material-symbols-outlined text-blue-600 text-2xl flex-shrink-0 mt-0.5">policy</span>
            <div>
                <h3 class="text-blue-900 font-black font-headline mb-1">Politique de transparence AL-KHAIR</h3>
                <p class="text-xs text-blue-800 leading-relaxed">
                    Pour des raisons de sécurité et de confiance envers vos donateurs, l'objectif financier <strong class="bg-white/60 px-1.5 py-0.5 rounded border border-blue-200">{{ number_format($project->goalAmount, 0, ',', ' ') }} DH</strong> et la catégorie ne peuvent plus être modifiés après la publication. Vous pouvez uniquement mettre à jour le contenu narratif et visuel de la campagne.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="neu-card-static p-6 border-l-4 border-red-500 flex items-start gap-4 reveal active bg-red-50/40 backdrop-blur-sm mb-8">
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

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="neu-card-static p-8 space-y-8 reveal active">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Titre du projet <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="w-full modern-input px-4 py-3.5 font-medium text-slate-800"/>
                </div>

                <div>
                    <label for="ville" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Ville/Région <span class="text-red-500">*</span></label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville', $project->ville) }}" required placeholder="ex: Casablanca, Marrakech..." class="w-full modern-input px-4 py-3.5"/>
                    @error('ville') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Image du Projet (Optionnel)</label>
                    <div class="flex flex-col md:flex-row items-start gap-6 bg-gradient-to-br from-slate-50/80 to-slate-100/50 p-6 rounded-2xl border border-slate-200/40 backdrop-blur-sm">

                        @if($project->image)
                            <div class="w-full md:w-1/3 flex-shrink-0 relative rounded-xl overflow-hidden shadow-lg group border border-slate-200/50 hover:border-[#F5A623]/30 transition-all">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="Image actuelle" class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-[#0A1128]/70 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity backdrop-blur-sm">
                                    <span class="text-white text-[10px] font-black uppercase tracking-widest bg-[#F5A623] px-3 py-1.5 rounded-full">Image Actuelle</span>
                                </div>
                            </div>
                        @endif

                        <div class="w-full flex-1 space-y-3">
                            <p class="text-xs font-black text-[#0A1128] uppercase tracking-wider">Remplacer l'image</p>
                            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/jpg" class="w-full text-sm text-slate-500 cursor-pointer"/>
                            <p class="text-[9px] uppercase font-bold tracking-widest text-slate-400">JPG, PNG, WEBP • Max 5MB</p>

                            <div id="imagePreview" class="hidden mt-4 pt-4 border-t border-slate-200/50">
                                <p class="text-[10px] font-bold text-[#F5A623] uppercase tracking-wider mb-2">Nouvel Aperçu</p>
                                <img id="preview" class="w-full max-w-xs h-28 object-cover rounded-xl shadow-md border border-slate-200" alt="Aperçu">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="videoUrl" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Lien Vidéo YouTube (Optionnel)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-slate-400">smart_display</span>
                        </div>
                        <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl', $project->videoUrl) }}" placeholder="https://youtube.com/..." class="w-full modern-input px-4 py-3.5 pl-12"/>
                    </div>
                </div>

                <div>
                    <label for="description" class="flex justify-between items-center text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">
                        <span>Description détaillée <span class="text-red-500">*</span></span>
                        <span class="bg-slate-100/60 text-slate-500 px-3 py-1.5 rounded-lg border border-slate-200/50">Requis</span>
                    </label>
                    <textarea id="description" name="description" rows="8" required class="w-full modern-input px-4 py-3.5 resize-y">{{ old('description', $project->description) }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100/50 flex flex-col sm:flex-row items-center justify-end gap-3">
                <a href="{{ route('association.dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 text-center text-slate-500 font-bold rounded-xl hover:bg-slate-100 transition-colors text-sm uppercase tracking-wider border border-slate-200/50">
                    Annuler
                </a>
                <button type="submit" class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-[#0A1128] to-[#162040] text-white font-black rounded-xl shadow-lg hover:shadow-xl hover:from-[#F5A623] hover:to-[#FFD085] hover:text-[#0A1128] active:scale-[0.98] transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-wider border border-[#F5A623]/10 hover:border-[#F5A623]/40">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
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