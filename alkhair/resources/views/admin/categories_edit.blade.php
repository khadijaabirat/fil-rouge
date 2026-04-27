<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modifier une Catégorie | AL-KHAIR Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        
        .neu-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(.4,0,.2,1); }
        .neu-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06), 0 20px 48px rgba(0,0,0,0.1); transform: translateY(-4px); }
        .neu-card-static { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
        
        .glass-sidebar { background: rgba(255,255,255,0.85); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border-right: 1px solid rgba(0,0,0,0.06); }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
        
        .sidebar-link { transition: all 0.25s ease; border-radius: 14px; }
        .sidebar-link:hover { background: rgba(10,17,40,0.04); }
        .sidebar-link.active { background: linear-gradient(135deg, #0A1128, #1a2744); color: #fff; box-shadow: 0 4px 16px rgba(10,17,40,0.3); }

        .modern-input { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 1rem; transition: all 0.3s; font-size: 0.875rem; color: #334155; }
        .modern-input:focus { background: #ffffff; border-color: #F5A623; box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.1); outline: none; }
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
                <p class="text-[10px] font-bold text-[#F5A623] tracking-[0.2em] uppercase mt-0.5">Administration</p>
            </div>
        </div>
    </div>

    <nav class="flex-grow space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="text-sm font-semibold">Tableau de Bord</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">category</span>
            <span class="text-sm font-semibold">Catégories</span>
        </a>
        <a href="{{ route('admin.validations') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">fact_check</span>
            <span class="text-sm font-semibold">Validations KYC</span>
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">group</span>
            <span class="text-sm font-semibold">Utilisateurs</span>
        </a>
    </nav>

    <div class="pt-6 border-t border-slate-200/50">
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
            <a href="{{ route('admin.categories.index') }}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-[#0A1128]">arrow_back</span>
            </a>
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Catégories</h2>
            <div class="hidden md:flex items-center gap-2 ml-4">
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-[#F5A623]">Édition</span>
            </div>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">Administrateur</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20">
                    <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                </div>
            </div>
        </div>
    </header>

    <div class="pt-32 pb-20 px-8 max-w-7xl mx-auto flex justify-center reveal active">
        <div class="w-full max-w-xl neu-card-static p-10 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#F5A623] to-[#0A1128]"></div>
            
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-[#F5A623]">
                    <span class="material-symbols-outlined text-3xl">edit_note</span>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-[#0A1128] tracking-tight">Modifier la Catégorie</h1>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Mise à jour des informations</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nom de la Catégorie</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="w-full modern-input px-4 py-4 text-lg font-bold text-[#0A1128]">
                    @error('name') 
                        <span class="text-red-500 text-[10px] font-bold mt-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">error</span> {{ $message }}
                        </span> 
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-slate-100 mt-8">
                    <a href="{{ route('admin.categories.index') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 text-slate-500 hover:text-[#0A1128] font-bold text-xs uppercase tracking-widest transition-colors py-3">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                        Annuler
                    </a>
                    <button type="submit" class="w-full sm:w-auto bg-[#0A1128] text-white px-8 py-4 rounded-xl font-black text-xs uppercase tracking-widest shadow-lg hover:bg-[#F5A623] hover:text-[#0A1128] transition-all flex items-center justify-center gap-2 active:scale-95">
                        <span class="material-symbols-outlined text-lg">save</span>
                        Enregistrer
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
