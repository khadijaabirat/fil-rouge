<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestion des Catégories | AL-KHAIR Admin</title>
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
        <a href="{{ route('home') }}" class="flex items-center gap-3 mb-4 group">
            <div class="w-12 h-12">
                <x-application-logo class="w-12 h-12 group-hover:scale-105 transition-transform" />
            </div>
        </a>
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
        <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Catégories</h2>
        <div class="flex items-center gap-5">
            @if(session('success'))
                <div class="px-4 py-1.5 bg-emerald-50 border border-emerald-100 rounded-lg text-emerald-600 text-xs font-bold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="px-4 py-1.5 bg-red-50 border border-red-100 rounded-lg text-red-600 text-xs font-bold shadow-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">error</span>
                    {{ session('error') }}
                </div>
            @endif
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

    <div class="pt-24 pb-20 px-8 max-w-7xl mx-auto space-y-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 reveal active">
            <div class="max-w-xl">
                <h2 class="text-4xl font-black tracking-tight text-[#0A1128] mb-2">Gestion des Catégories</h2>
                <p class="text-slate-500 text-sm leading-relaxed">Organisez les projets de la plateforme en différentes thématiques d'impact.</p>
            </div>
            <div class="flex gap-2">
                <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 bg-amber-50 text-[#F5A623] rounded-xl flex items-center justify-center border border-amber-100">
                        <span class="material-symbols-outlined text-xl">inventory_2</span>
                    </div>
                    <div>
                        <p class="text-xl font-black text-[#0A1128] leading-none">{{ $categories->count() }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Catégories</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Add Category -->
            <section class="lg:col-span-4 reveal" style="animation-delay: 0.1s">
                <div class="neu-card-static p-8 sticky top-28">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-[#F5A623] mb-6">
                        <span class="material-symbols-outlined text-2xl">add_box</span>
                    </div>
                    <h3 class="font-black text-xl text-[#0A1128] mb-2">Nouvelle catégorie</h3>
                    <p class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mb-8">Ajoutez une thématique pour classer les futurs projets associatifs.</p>
                    
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Nom de la Catégorie</label>
                            <input type="text" name="name" required placeholder="Ex: Santé, Éducation..." class="w-full modern-input px-4 py-3.5 text-[#0A1128] font-bold">
                            @error('name') 
                                <span class="text-red-500 text-[10px] font-bold mt-1.5 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px]">warning</span> {{ $message }}
                                </span> 
                            @enderror
                        </div>
                        <button type="submit" class="w-full bg-[#0A1128] text-white font-black text-xs uppercase tracking-widest py-3.5 px-4 rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] shadow-md transition-all flex items-center justify-center gap-2 mt-4 active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Ajouter
                        </button>
                    </form>
                </div>
            </section>

            <!-- Right Column: Categories List -->
            <section class="lg:col-span-8 reveal" style="animation-delay: 0.2s">
                <div class="neu-card-static overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50 flex items-center gap-3">
                        <span class="material-symbols-outlined text-[#F5A623]">format_list_bulleted</span>
                        <h3 class="font-black text-[#0A1128]">Liste des catégories</h3>
                    </div>
                    
                    @if($categories->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 bg-white">
                                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 w-24">ID</th>
                                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Nom de la Catégorie</th>
                                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($categories as $category)
                                        <tr class="hover:bg-slate-50/50 transition-colors group bg-white">
                                            <td class="px-6 py-4">
                                                <span class="text-[10px] font-black tracking-widest text-slate-400">#{{ str_pad($category->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-[#0A1128] font-black text-sm border border-slate-200">
                                                        {{ substr($category->name, 0, 1) }}
                                                    </div>
                                                    <span class="font-bold text-[#0A1128]">{{ $category->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex justify-end gap-2 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2.5 bg-slate-100 text-slate-500 hover:bg-[#F5A623] hover:text-[#0A1128] rounded-xl transition-colors" title="Modifier">
                                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                                    </a>

                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2.5 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-colors" title="Supprimer">
                                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="p-16 text-center flex flex-col items-center justify-center bg-white">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl border border-slate-100 flex items-center justify-center mb-6">
                                <span class="material-symbols-outlined text-4xl text-slate-300">category</span>
                            </div>
                            <p class="text-[#0A1128] font-black text-lg mb-2">Aucune catégorie</p>
                            <p class="text-sm text-slate-500 max-w-sm mx-auto">Utilisez le formulaire pour créer la première catégorie de votre plateforme.</p>
                        </div>
                    @endif
                </div>
            </section>

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
