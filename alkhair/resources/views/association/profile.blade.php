<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mon Profil | AL-KHAIR Association</title>
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

        input[type=file]::file-selector-button {
            background-color: #0A1128; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.75rem;
            font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s;
        }
        input[type=file]::file-selector-button:hover { background-color: #F5A623; color: #0A1128; }
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
        <a href="{{ route('association.dashboard') }}#projets" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">folder_open</span>
            <span class="text-sm font-semibold">Mes Projets</span>
        </a>
        <a href="{{ route('association.projects.expired') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">hourglass_empty</span>
            <span class="text-sm font-semibold">Projets Expirés</span>
        </a>
        <a href="{{ route('impact.create', 0) }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">verified</span>
            <span class="text-sm font-semibold">Preuves d'impact</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50 space-y-2">
        <a href="{{ route('association.profile') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
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
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">AL-KHAIR</h2>
            <div class="hidden md:flex items-center gap-2 ml-4">
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-[#F5A623]">Profil Association</span>
            </div>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name ?? 'Association' }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Partenaire</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-white text-sm shadow-lg border border-slate-700 overflow-hidden">
                    @if($association->profilePhoto)
                        <img src="{{ asset('storage/' . $association->profilePhoto) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($association->name, 0, 1) }}
                    @endif
                </div>
            </div>
        </div>
    </header>

    <div class="pt-24 pb-20 px-8 max-w-4xl mx-auto space-y-8">
        
        @if(session('success'))
            <div class="px-4 py-3 bg-emerald-50/60 border border-emerald-200/50 rounded-xl text-emerald-700 text-sm font-bold shadow-sm flex items-center gap-3 reveal active backdrop-blur-sm">
                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded-xl bg-red-50/60 text-red-700 text-sm font-bold border border-red-200/50 shadow-sm flex items-start gap-3 reveal active backdrop-blur-sm">
                <span class="material-symbols-outlined flex-shrink-0">error</span>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="mb-8 reveal active">
            <div class="relative h-48 rounded-[2rem] overflow-hidden mb-[-4rem] bg-gradient-to-r from-[#0A1128] via-[#162040] to-[#0d1c30] shadow-xl border border-[#F5A623]/10">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                <div class="absolute right-0 bottom-0 w-80 h-80 bg-[#F5A623]/12 rounded-full blur-3xl"></div>
            </div>

            <div class="flex flex-col md:flex-row items-end gap-6 px-8 relative z-10">
                <div class="w-32 h-32 rounded-[2rem] bg-white p-2 shadow-xl shadow-[#0A1128]/15 flex-shrink-0 relative group border border-slate-100/80 backdrop-blur-sm">
                    @if($association->profilePhoto)
                        <img class="w-full h-full object-cover rounded-[1.5rem]" src="{{ asset('storage/' . $association->profilePhoto) }}" alt="Logo Association">
                    @else
                        <div class="w-full h-full rounded-[1.5rem] bg-gradient-to-br from-slate-100 to-slate-50 flex items-center justify-center text-[#0A1128] font-black text-4xl">
                            {{ strtoupper(substr($association->name, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <div class="flex-1 pb-2 w-full md:w-auto text-center md:text-left mt-12 md:mt-0">
                    <div class="flex items-center justify-center md:justify-start gap-3 mb-1">
                        <h1 class="text-3xl font-black text-[#0A1128] tracking-tight">{{ $association->name }}</h1>
                        @if($association->status === 'ACTIVE')
                            <span class="bg-emerald-50/80 text-emerald-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5 border border-emerald-200/40 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                                Vérifié
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-500 font-bold text-sm flex items-center justify-center md:justify-start gap-2">
                        <span class="material-symbols-outlined text-[16px] text-[#F5A623]">mail</span>
                        {{ $association->email }}
                    </p>
                </div>
            </div>
        </section>

        <div class="neu-card-static overflow-hidden reveal active" style="animation-delay: 0.1s">

            <div class="bg-gradient-to-r from-slate-50/80 to-slate-100/50 px-8 py-6 border-b border-slate-200/40 flex items-center gap-3 backdrop-blur-sm">
                <span class="material-symbols-outlined text-[#F5A623] text-2xl">edit_document</span>
                <h2 class="text-xl font-black text-[#0A1128]">Modifier les informations</h2>
            </div>

            <form action="{{ route('association.updateProfile') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-6 bg-gradient-to-br from-slate-50/80 to-slate-100/50 rounded-2xl border border-slate-200/40 backdrop-blur-sm">
                        <div class="flex-1">
                            <label class="block text-[10px] font-black uppercase tracking-widest text-[#0A1128] mb-2">Logo / Photo de profil</label>
                            <input type="file" name="profilePhoto" accept="image/jpeg, image/png, image/jpg" class="block w-full text-sm text-slate-500">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">Formats acceptés : JPG, PNG. Taille max : 2MB.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Nom de l'association <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400">foundation</span>
                                </div>
                                <input type="text" id="name" name="name" value="{{ old('name', $association->name) }}" required
                                       class="w-full modern-input py-3.5 pl-12 pr-4 font-bold text-[#0A1128]">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="ville" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Ville</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400">location_city</span>
                                </div>
                                <input type="text" id="ville" name="ville" value="{{ old('ville', $association->ville) }}"
                                       class="w-full modern-input py-3.5 pl-12 pr-4 font-bold text-[#0A1128]">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="phone" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Téléphone</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400">call</span>
                                </div>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $association->phone) }}"
                                       class="w-full modern-input py-3.5 pl-12 pr-4 font-bold text-[#0A1128]">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="rib" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">RIB Bancaire (24 chiffres)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-slate-400">account_balance</span>
                                </div>
                                <input type="text" id="rib" name="rib" value="{{ old('rib', $association->rib) }}" placeholder="Ex: 011810000000000000000000"
                                       class="w-full modern-input py-3.5 pl-12 pr-4 font-mono font-bold text-[#0A1128] tracking-widest text-sm">
                            </div>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 px-1">Nécessaire pour recevoir les virements des dons.</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="address" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Adresse complète</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-slate-400">location_on</span>
                            </div>
                            <input type="text" id="address" name="address" value="{{ old('address', $association->address) }}"
                                   class="w-full modern-input py-3.5 pl-12 pr-4 font-bold text-[#0A1128]">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Présentation de l'association</label>
                        <div class="relative">
                            <textarea id="description" name="description" rows="4" placeholder="Parlez-nous de vos objectifs et de vos actions sur le terrain..."
                                      class="w-full modern-input py-3.5 px-4 font-medium text-slate-600 resize-y">{{ old('description', $association->description) }}</textarea>
                        </div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[#F5A623]/80 px-1">Cette description sera visible publiquement par les donateurs.</p>
                    </div>

                </div>

                <div class="mt-10 pt-6 border-t border-slate-100/50 flex justify-end">
                    <button type="submit" class="w-full md:w-auto px-8 py-4 bg-gradient-to-r from-[#0A1128] to-[#162040] text-white rounded-xl font-black text-xs uppercase tracking-widest hover:shadow-lg hover:from-[#F5A623] hover:to-[#FFD085] hover:text-[#0A1128] shadow-lg transition-all flex items-center justify-center gap-2 active:scale-95 border border-[#F5A623]/10 hover:border-[#F5A623]/40">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Mettre à jour le profil
                    </button>
                </div>
            </form>

        </div>
    </div>
</main>

<script>
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