<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Publier Rapport d'Impact | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e8ecf3 0%, #f5f7fb 50%, #ffffff 100%); }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }

        .neu-card { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04), 0 12px 32px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.02); border: 1px solid rgba(255,255,255,0.8); transition: all 0.4s cubic-bezier(.4,0,.2,1); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
        .neu-card-static { background: rgba(255,255,255,0.95); border-radius: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04), 0 12px 32px rgba(0,0,0,0.08), 0 0 1px rgba(0,0,0,0.02); border: 1px solid rgba(255,255,255,0.8); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }

        .glass-sidebar { background: rgba(255,255,255,0.9); backdrop-filter: blur(32px); -webkit-backdrop-filter: blur(32px); border-right: 1px solid rgba(0,0,0,0.05); box-shadow: 2px 0 16px rgba(0,0,0,0.04); }
        .reveal { opacity: 0; transform: translateY(25px); transition: all 0.6s cubic-bezier(.34, 1.56, .64, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        .sidebar-link { transition: all 0.25s ease; border-radius: 14px; }
        .sidebar-link:hover { background: rgba(10,17,40,0.05); }
        .sidebar-link.active { background: linear-gradient(135deg, #0A1128, #1a2744); color: #fff; box-shadow: 0 4px 16px rgba(10,17,40,0.2); }

        .modern-input { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 1rem; transition: all 0.3s; font-size: 0.875rem; color: #334155; }
        .modern-input:focus { background: #ffffff; border-color: #F5A623; box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.12), inset 0 0 0 1px rgba(245,166,35,0.2); outline: none; }

        .file-upload-wrapper { position: relative; overflow: hidden; cursor: pointer; }
        .file-upload-wrapper input[type=file] { position: absolute; font-size: 100px; opacity: 0; right: 0; top: 0; cursor: pointer; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 overflow-x-hidden selection:bg-[#F5A623] selection:text-white min-h-screen flex">

<!-- Sidebar -->
<aside class="h-screen w-72 fixed left-0 top-0 z-50 glass-sidebar flex flex-col p-6">
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="bg-gradient-to-br from-[#F5A623] to-[#e8950a] p-2.5 rounded-xl font-black text-[#0A1128] text-lg shadow-lg shadow-[#F5A623]/20">AK</div>
            <div>
                <h1 class="text-xl font-black text-[#0A1128] leading-none">AL-KHAIR</h1>
                <p class="text-[10px] font-bold text-[#F5A623] tracking-[0.2em] uppercase mt-0.5">Espace Association</p>
            </div>
        </div>
    </div>

    <nav class="flex-grow space-y-2">
        <a href="{{ route('association.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="text-sm font-semibold">Vue d'ensemble</span>
        </a>
        <a href="{{ route('association.dashboard') }}#projets" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">folder_open</span>
            <span class="text-sm font-semibold">Mes Projets</span>
        </a>
        <a href="{{ route('impact.create', 0) }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">verified</span>
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
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Preuves d'Impact</h2>
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

    <div class="pt-24 pb-20 px-8 max-w-7xl mx-auto space-y-8">
        
        <form action="{{ route('impact.store', $project->id) }}" method="POST" enctype="multipart/form-data" id="impactForm" onsubmit="disableSubmit()">
            @csrf

            @if ($errors->any())
                <div class="neu-card-static p-6 border-l-4 border-red-500 flex items-start gap-4 reveal active bg-red-50/40 mb-8 backdrop-blur-sm">
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

            <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 pb-6 border-b border-slate-200/40 reveal active">
                <div class="max-w-2xl">
                    <span class="inline-block px-3 py-1.5 mb-3 bg-[#F5A623]/15 text-[#F5A623] text-[10px] font-black rounded-lg uppercase tracking-wider border border-[#F5A623]/30 shadow-sm">
                        Publication Requise
                    </span>
                    <h1 class="text-4xl font-black tracking-tight text-[#0A1128] mb-2">{{ $project->title }}</h1>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Finalisation du rapport d'impact institutionnel. Veuillez fournir les preuves visuelles et descriptives pour débloquer les archives éthiques.
                    </p>
                </div>
                <div class="neu-card-static px-6 py-5 text-left md:text-right shadow-lg w-full md:w-auto border border-slate-200/50 backdrop-blur-sm">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Fonds à justifier</p>
                    <p class="text-3xl font-black text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                
                <div class="xl:col-span-8 space-y-8">
                    
                    <!-- Visual Proof Section -->
                    <section class="neu-card-static p-8 reveal" style="animation-delay: 0.1s">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5A623]/20 to-[#FFD085]/10 flex items-center justify-center border border-[#F5A623]/30 shadow-lg shadow-[#F5A623]/5">
                                <span class="material-symbols-outlined text-[#F5A623]">photo_camera</span>
                            </div>
                            <h3 class="text-xl font-black text-[#0A1128]">Preuve Visuelle *</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="file-upload-wrapper border-2 border-dashed border-slate-200/60 hover:border-[#F5A623]/40 rounded-2xl h-56 flex flex-col items-center justify-center bg-gradient-to-br from-slate-50/80 to-slate-100/50 hover:from-[#F5A623]/5 hover:to-[#FFD085]/5 transition-all group backdrop-blur-sm">
                                <span class="material-symbols-outlined text-5xl text-slate-300 group-hover:text-[#F5A623] mb-3 transition-colors">cloud_upload</span>
                                <p class="text-sm font-black text-[#0A1128]">Ajouter une photo</p>
                                <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-widest font-bold">JPG, PNG (MAX. 5MB)</p>
                                <input type="file" name="image" id="imageInput" accept="image/*" required>
                            </div>

                            <div id="previewContainer" class="relative rounded-2xl overflow-hidden h-56 bg-slate-100 border border-slate-200/60 hidden group shadow-lg">
                                <img id="imagePreview" class="w-full h-full object-cover" src="" alt="Aperçu">
                                <div class="absolute inset-0 bg-[#0A1128]/70 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity backdrop-blur-sm pointer-events-none">
                                    <span class="text-white text-[10px] font-black uppercase tracking-widest bg-[#F5A623] px-4 py-2.5 rounded-full">Image Sélectionnée</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Narration Section -->
                    <section class="neu-card-static p-8 reveal" style="animation-delay: 0.2s">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#F5A623]/20 to-[#FFD085]/10 flex items-center justify-center border border-[#F5A623]/30 shadow-lg shadow-[#F5A623]/5">
                                <span class="material-symbols-outlined text-[#F5A623]">history_edu</span>
                            </div>
                            <h3 class="text-xl font-black text-[#0A1128]">Narration de l'Impact *</h3>
                        </div>
                        <div class="space-y-4">
                            <label class="block">
                                <span class="flex justify-between items-center text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2 block">
                                    Récit des réalisations
                                    <span class="bg-slate-100/60 px-3 py-1.5 rounded-lg text-slate-600 border border-slate-200/50">Requis</span>
                                </span>
                                <textarea name="description" required class="w-full modern-input px-4 py-4 resize-y" placeholder="Expliquez en détail comment les fonds ont été utilisés et l'impact direct sur les bénéficiaires..." rows="6">{{ old('description') }}</textarea>
                            </label>
                            <div class="flex gap-2 opacity-60 pointer-events-none">
                                <span class="px-3 py-1.5 bg-slate-50/80 rounded-lg text-[10px] font-bold text-slate-500 border border-slate-200/50">#Transparence</span>
                                <span class="px-3 py-1.5 bg-slate-50/80 rounded-lg text-[10px] font-bold text-slate-500 border border-slate-200/50">#AlKhairImpact</span>
                            </div>
                        </div>
                    </section>

                    <input type="hidden" name="completionDate" value="{{ date('Y-m-d') }}">
                </div>

                <aside class="xl:col-span-4 space-y-6">
                    
                    <!-- Ethical Commitment -->
                    <div class="bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0d1c30] rounded-3xl p-8 text-white relative overflow-hidden shadow-xl reveal border border-[#F5A623]/10 group" style="animation-delay: 0.3s">
                        <div class="absolute -right-24 -bottom-24 w-72 h-72 bg-[#F5A623]/12 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-[#FFD085] text-4xl mb-4" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                            <h4 class="text-xl font-black mb-2 text-white">Engagement Éthique</h4>
                            <p class="text-xs text-white/75 leading-relaxed font-medium">
                                Ce rapport sera archivé de manière immuable et affiché publiquement sur la page du projet. Il garantit la transparence totale envers vos donateurs.
                            </p>
                        </div>
                    </div>

                    <!-- Submission Panel -->
                    <div class="neu-card-static p-8 sticky top-24 reveal border border-slate-200/50 shadow-lg" style="animation-delay: 0.4s">
                        <h4 class="text-[10px] font-black uppercase tracking-widest mb-6 text-slate-400">Finalisation</h4>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3 text-sm text-slate-600 font-bold">
                                <span class="material-symbols-outlined text-emerald-500 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                Fonds collectés
                            </li>
                            <li class="flex items-center gap-3 text-sm text-slate-600 font-bold">
                                <span class="material-symbols-outlined text-emerald-500 text-xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                Projet clôturé
                            </li>
                            <li class="flex items-center gap-3 text-sm text-[#0A1128] font-black">
                                <span class="material-symbols-outlined text-[#F5A623] text-xl animate-pulse" style="font-variation-settings: 'FILL' 1;">pending</span>
                                Preuve en attente
                            </li>
                        </ul>

                        <div class="space-y-3 pt-6 border-t border-slate-100/50">
                            <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-[#0A1128] via-[#162040] to-[#0d1c30] text-white py-4 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg hover:shadow-xl hover:from-[#F5A623] hover:via-[#FFD085] hover:to-[#F5A623] hover:text-[#0A1128] transition-all flex items-center justify-center gap-2 active:scale-95 border border-[#F5A623]/10 hover:border-[#F5A623]/40">
                                <span id="btnText">Publier le rapport</span>
                                <span id="btnIcon" class="material-symbols-outlined text-[18px]">send</span>
                            </button>

                            <a href="{{ route('association.dashboard') }}" class="block text-center w-full bg-slate-50/80 text-slate-500 py-3.5 rounded-xl font-bold text-[10px] uppercase tracking-wider hover:bg-slate-100 transition-colors border border-slate-200/50 backdrop-blur-sm">
                                Annuler
                            </a>
                        </div>
                    </div>
                </aside>

            </div>
        </form>
    </div>
</main>

<script>
    // Preview Image Logic
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

    // Disable Submit
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Publication...';
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