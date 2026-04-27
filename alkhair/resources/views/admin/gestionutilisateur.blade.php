<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Gestion des Utilisateurs | AL-KHAIR Admin</title>
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

        .filter-btn { transition: all 0.2s; }
        .filter-btn:hover { background: #0A1128; color: white; border-color: #0A1128; }
        .filter-btn.active { background: #F5A623; color: #0A1128; border-color: #F5A623; }
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
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">category</span>
            <span class="text-sm font-semibold">Catégories</span>
        </a>
        <a href="{{ route('admin.validations') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">fact_check</span>
            <span class="text-sm font-semibold">Validations KYC</span>
        </a>
        <a href="{{ route('admin.users') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">group</span>
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
        <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Gestion des Utilisateurs</h2>
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
                <h2 class="text-4xl font-black tracking-tight text-[#0A1128] mb-2">Utilisateurs</h2>
                <p class="text-slate-500 text-sm leading-relaxed">Supervisez et modérez la communauté Al-Khair.</p>
            </div>
            <div class="flex gap-2">
                <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex items-center justify-center border border-emerald-100">
                        <span class="material-symbols-outlined text-xl">group</span>
                    </div>
                    <div>
                        <p class="text-xl font-black text-[#0A1128] leading-none">{{ \App\Models\User::count() }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white p-3 rounded-2xl flex flex-wrap items-center gap-2 shadow-sm border border-slate-200 reveal" style="animation-delay: 0.1s">
            <span class="material-symbols-outlined text-slate-400 px-2">filter_list</span>
            <a href="{{ route('admin.users') }}" class="filter-btn px-6 py-2.5 rounded-xl border border-slate-200 {{ !request('role') && !request('status') ? 'active' : 'text-slate-600 bg-white' }} text-xs font-black uppercase tracking-widest">Tous</a>
            <a href="{{ route('admin.users', ['role' => 'donator']) }}" class="filter-btn px-6 py-2.5 rounded-xl border border-slate-200 {{ request('role') == 'donator' ? 'active' : 'text-slate-600 bg-white' }} text-xs font-black uppercase tracking-widest">Donateurs</a>
            <a href="{{ route('admin.users', ['role' => 'association']) }}" class="filter-btn px-6 py-2.5 rounded-xl border border-slate-200 {{ request('role') == 'association' ? 'active' : 'text-slate-600 bg-white' }} text-xs font-black uppercase tracking-widest">Associations</a>
            <a href="{{ route('admin.users', ['status' => 'PENDING']) }}" class="filter-btn px-6 py-2.5 rounded-xl border border-slate-200 {{ request('status') == 'PENDING' ? 'active' : 'text-slate-600 bg-white' }} text-xs font-black uppercase tracking-widest flex items-center gap-2">
                En attente
            </a>
            <a href="{{ route('admin.users', ['status' => 'BANNED']) }}" class="filter-btn px-6 py-2.5 rounded-xl border border-slate-200 {{ request('status') == 'BANNED' ? 'active' : 'text-slate-600 bg-white' }} text-xs font-black uppercase tracking-widest flex items-center gap-2">
                Bannis
            </a>
        </div>

        <!-- Users Table -->
        <div class="neu-card-static overflow-hidden reveal" style="animation-delay: 0.2s">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Utilisateur</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Email</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Rôle</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Statut</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Inscription</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 bg-white">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center text-[#0A1128] font-black text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-[#0A1128]">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-black px-3 py-1.5 bg-slate-100 text-slate-500 rounded-lg uppercase tracking-widest border border-slate-200">{{ $user->role }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->status === 'ACTIVE' || $user->status === 'APPROVED')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Actif
                                        </span>
                                    @elseif($user->status === 'PENDING')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> En attente
                                        </span>
                                    @elseif($user->status === 'BANNED' || $user->status === 'SUSPENDED')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest border border-red-100 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Banni
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-widest border border-slate-200 shadow-sm">
                                            {{ $user->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        @if($user->role === 'association')
                                            @if($user->status === 'BANNED')
                                                <form action="{{ route('admin.unbanAssociation', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="p-2.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-xl transition-all shadow-sm" title="Réactiver">
                                                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                                    </button>
                                                </form>
                                            @elseif($user->status === 'ACTIVE' || $user->status === 'APPROVED')
                                                <form action="{{ route('admin.banAssociation', $user->id) }}" method="POST" onsubmit="return confirm('Bannir cette association ? Tous ses projets seront suspendus.');">
                                                    @csrf
                                                    <button type="submit" class="p-2.5 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm" title="Bannir">
                                                        <span class="material-symbols-outlined text-[18px]">block</span>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-300">Aucune action</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-2xl mx-auto flex items-center justify-center mb-4 border border-slate-100">
                                        <span class="material-symbols-outlined text-3xl text-slate-300">group_off</span>
                                    </div>
                                    <p class="text-[#0A1128] font-black">Aucun utilisateur trouvé.</p>
                                    <p class="text-sm text-slate-500 mt-1">Essayez de modifier vos filtres.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
                    {{ $users->links() }}
                </div>
            @endif
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