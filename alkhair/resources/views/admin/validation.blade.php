<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Validations | AL-KHAIR Admin</title>
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
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">category</span>
            <span class="text-sm font-semibold">Catégories</span>
        </a>
        <a href="{{ route('admin.validations') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">fact_check</span>
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
        <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Hub de Validation</h2>
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

    <div class="pt-24 pb-20 px-8 max-w-7xl mx-auto space-y-12">
        <section class="flex flex-col md:flex-row justify-between items-end gap-6 reveal active">
            <div>
                <span class="text-[10px] font-black text-[#F5A623] uppercase tracking-[0.2em] mb-2 block">Requêtes en attente</span>
                <h3 class="text-4xl font-black text-[#0A1128] tracking-tight">Modération Système</h3>
            </div>
        </section>

        <!-- New Associations Submission -->
        <section class="space-y-6 reveal active">
            <div class="flex items-center justify-between">
                <h4 class="text-xl font-black text-[#0A1128] flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#0A1128]/5 flex items-center justify-center border border-[#0A1128]/10">
                        <span class="material-symbols-outlined text-[#F5A623]">domain_verification</span>
                    </div>
                    Nouvelles Associations
                </h4>
                @if($pendingAssociations->count() > 0)
                    <span class="text-[10px] font-black px-4 py-1.5 bg-[#F5A623]/10 text-[#F5A623] rounded-full uppercase tracking-widest border border-[#F5A623]/20">{{ $pendingAssociations->count() }} EN ATTENTE</span>
                @endif
            </div>

            <div class="grid grid-cols-1 gap-6">
                @forelse($pendingAssociations as $assoc)
                    <div class="neu-card p-8 group">
                        <div class="flex flex-col lg:flex-row gap-8">
                            <div class="flex-1 space-y-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h5 class="text-2xl font-black text-[#0A1128] mb-1 group-hover:text-[#F5A623] transition-colors">{{ $assoc->name }}</h5>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mb-1">Inscrite le : {{ $assoc->created_at->format('d M Y') }} • {{ $assoc->ville }}</p>
                                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Licence : <strong class="text-[#0A1128]">{{ $assoc->licenseNumber }}</strong></p>
                                    </div>
                                    <div class="flex gap-2">
                                        @if($assoc->documentKYC)
                                            <a href="{{ asset('storage/' . $assoc->documentKYC) }}" target="_blank" class="flex items-center gap-2 px-4 py-2 bg-slate-50 hover:bg-slate-100 rounded-xl border border-slate-200 transition-colors shadow-sm">
                                                <span class="material-symbols-outlined text-[#0A1128] text-lg">picture_as_pdf</span>
                                                <span class="text-xs font-bold text-slate-600">Document KYC</span>
                                            </a>
                                        @else
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-red-500 bg-red-50 px-3 py-1.5 rounded-lg border border-red-100">Aucun document</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-slate-600 leading-relaxed text-sm bg-slate-50 p-4 rounded-xl border border-slate-100">
                                    {{ $assoc->description ?? 'Aucune description fournie.' }}
                                </p>
                            </div>
                            <div class="lg:w-72 flex flex-col justify-center gap-3 border-l border-slate-100 pl-8">
                                <form action="{{ route('admin.validateAssociation', $assoc->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-4 bg-[#0A1128] text-white rounded-xl font-black text-xs uppercase tracking-widest flex items-center justify-center gap-2 hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-lg active:scale-95">
                                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                        Approuver l'Association
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="neu-card-static p-12 text-center border-2 border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl mx-auto flex items-center justify-center mb-4 border border-slate-100">
                            <span class="material-symbols-outlined text-3xl text-slate-400">check_circle</span>
                        </div>
                        <p class="text-[#0A1128] font-black">Aucune association en attente d'approbation.</p>
                        <p class="text-slate-500 text-sm mt-1">Toutes les demandes ont été traitées.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Manual Donations Moderation -->
        <section class="space-y-6 pt-6 reveal" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <h4 class="text-xl font-black text-[#0A1128] flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                        <span class="material-symbols-outlined text-[#F5A623]">receipt_long</span>
                    </div>
                    Validation des Dons Manuels
                </h4>
                @if($pendingDonations->count() > 0)
                    <span class="text-[10px] font-black px-4 py-1.5 bg-[#F5A623]/10 text-[#F5A623] rounded-full uppercase tracking-widest border border-[#F5A623]/20">{{ $pendingDonations->count() }} EN ATTENTE</span>
                @endif
            </div>

            <div class="neu-card-static overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Donateur</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Projet</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Montant</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Reçu (Justificatif)</th>
                                <th class="p-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 bg-white">
                            @forelse($pendingDonations as $donation)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-5 font-bold text-[#0A1128]">{{ $donation->isAnonymous ? 'Anonyme' : ($donation->donator->name ?? 'Inconnu') }}</td>
                                    <td class="p-5 text-slate-500 font-medium">{{ Str::limit($donation->project->title ?? 'Projet supprimé', 30) }}</td>
                                    <td class="p-5 font-black text-[#0A1128]">{{ number_format($donation->amount, 0, ',', ' ') }} DH</td>
                                    <td class="p-5">
                                        @if($donation->payment && $donation->payment->paymentReceipt)
                                            <a href="{{ asset('storage/' . $donation->payment->paymentReceipt) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-[#0A1128] hover:text-[#F5A623] bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg border border-slate-200 transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                                Voir le reçu
                                            </a>
                                        @else
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="p-5">
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('admin.validateDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Confirmer la validation de ce don ?');">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-xl transition-all shadow-sm" title="Valider">
                                                    <span class="material-symbols-outlined text-[20px]">check</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.rejectDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Refuser ce don ?');">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm" title="Refuser">
                                                    <span class="material-symbols-outlined text-[20px]">close</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 mb-2">receipt_long</span>
                                        <p class="text-[#0A1128] font-black">Aucun don manuel en attente.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Project Moderation Section -->
        <section class="space-y-6 pt-6 reveal" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <h4 class="text-xl font-black text-[#0A1128] flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#0A1128]/5 flex items-center justify-center border border-[#0A1128]/10">
                        <span class="material-symbols-outlined text-[#F5A623]">article</span>
                    </div>
                    Modération des Projets
                </h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($managedProjects as $project)
                    <div class="neu-card overflow-hidden border {{ $project->status === 'SUSPENDED' ? 'border-red-500 shadow-red-500/10' : 'border-transparent' }}">
                        <div class="h-48 relative overflow-hidden group bg-slate-100">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Project image"/>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-[#0A1128]/40 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5">
                                @if($project->status === 'SUSPENDED')
                                    <span class="text-[10px] font-black text-white bg-red-500 px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-sm">SUSPENDU</span>
                                @else
                                    <span class="text-[10px] font-black text-emerald-700 bg-emerald-100 px-3 py-1.5 rounded-lg uppercase tracking-widest shadow-sm">{{ $project->status }}</span>
                                @endif
                                <h6 class="text-white font-black mt-3 truncate text-lg">{{ $project->title }}</h6>
                            </div>
                        </div>
                        <div class="p-6 space-y-4 bg-white flex flex-col h-[200px]">
                            <p class="text-[10px] uppercase tracking-widest font-black text-slate-400">Assoc: <strong class="text-[#0A1128]">{{ $project->association->name ?? 'N/A' }}</strong></p>
                            <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 flex-grow">
                                {{ $project->description }}
                            </p>
                            <div class="flex gap-2 pt-4 border-t border-slate-100 mt-auto">
                                @if($project->status === 'SUSPENDED')
                                    <form action="{{ route('admin.restoreProject', $project->id) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full py-3 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-600 transition-all shadow-md active:scale-95">
                                            Restaurer le Projet
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.suspendProject', $project->id) }}" method="POST" class="w-full" onsubmit="return confirm('Voulez-vous vraiment suspendre ce projet ?');">
                                        @csrf
                                        <button type="submit" class="w-full py-3 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all border border-red-100 shadow-sm active:scale-95">
                                            Suspendre
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 neu-card-static p-12 flex flex-col items-center justify-center text-center border-2 border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl mx-auto flex items-center justify-center mb-4 border border-slate-100">
                            <span class="material-symbols-outlined text-3xl text-slate-300">article</span>
                        </div>
                        <p class="text-[#0A1128] font-black">Aucun projet à modérer.</p>
                    </div>
                @endforelse
            </div>
        </section>

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