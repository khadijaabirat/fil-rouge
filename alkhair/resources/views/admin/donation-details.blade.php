<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Détails du Don #{{ $donation->id }} | AL-KHAIR Admin</title>
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
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">category</span>
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-[#0A1128]">arrow_back</span>
            </a>
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">AL-KHAIR</h2>
            <div class="hidden md:flex items-center gap-2 ml-4">
                <span class="text-slate-300">/</span>
                <span class="text-sm font-bold text-[#F5A623]">Détails Don</span>
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

    <div class="pt-32 pb-20 px-8 max-w-7xl mx-auto">
        
        @if(session('success'))
            <div class="mb-8 px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-600 text-xs font-bold flex items-center gap-2 shadow-sm reveal active">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6 reveal active">
            <div>
                <span class="text-[10px] text-[#F5A623] font-black uppercase tracking-[0.2em] mb-2 block">Dossier Financier</span>
                <h1 class="text-4xl font-black tracking-tight text-[#0A1128] leading-none mb-2">
                    Don #{{ str_pad($donation->id, 6, '0', STR_PAD_LEFT) }}
                </h1>
                <p class="text-slate-500 font-bold text-sm">Reçu le {{ $donation->created_at->format('d M Y à H:i') }}</p>
            </div>
            <div class="flex gap-3">
                @if($donation->payment && $donation->payment->paymentReceipt)
                    <a href="{{ asset('storage/' . $donation->payment->paymentReceipt) }}" target="_blank" class="flex items-center gap-2 px-6 py-3.5 bg-slate-100 text-[#0A1128] hover:bg-slate-200 transition-all rounded-xl font-black text-[10px] uppercase tracking-widest shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">download</span>
                        Télécharger Reçu
                    </a>
                @endif
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-6 py-3.5 bg-white border border-slate-200 hover:bg-slate-50 transition-all rounded-xl font-black text-[10px] uppercase tracking-widest text-slate-500 shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Retour
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="neu-card-static p-8 flex flex-col md:flex-row items-center gap-8 reveal active" style="animation-delay: 0.1s">
                    <div class="text-center md:text-left">
                        <p class="text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-2">Montant Total</p>
                        <p class="text-5xl font-black text-[#0A1128] tracking-tighter">
                            {{ number_format($donation->amount, 2, ',', ' ') }} <span class="text-2xl font-black text-slate-300 ml-1">DH</span>
                        </p>
                    </div>
                    <div class="h-px md:h-20 w-full md:w-px bg-slate-100"></div>
                    <div class="flex-1 w-full text-center md:text-left">
                        <p class="text-[10px] uppercase tracking-[0.2em] font-black text-slate-400 mb-2">Statut actuel</p>
                        @if($donation->status === 'PENDING')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-600 border border-amber-100 rounded-lg font-black text-[10px] uppercase tracking-widest shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">pending</span> En attente
                            </span>
                        @elseif($donation->status === 'VALIDATED')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-lg font-black text-[10px] uppercase tracking-widest shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span> Validé
                            </span>
                        @elseif($donation->status === 'PROCESSING')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg font-black text-[10px] uppercase tracking-widest shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">sync</span> En traitement
                            </span>
                        @elseif($donation->status === 'RECEIVED')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-50 text-purple-600 border border-purple-100 rounded-lg font-black text-[10px] uppercase tracking-widest shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">done_all</span> Reçu
                            </span>
                        @elseif($donation->status === 'IMPACT')
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#0A1128] text-[#F5A623] rounded-lg font-black text-[10px] uppercase tracking-widest shadow-md">
                                <span class="material-symbols-outlined text-[16px]">verified</span> Impact publié
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 border border-red-100 rounded-lg font-black text-[10px] uppercase tracking-widest shadow-sm">
                                <span class="material-symbols-outlined text-[16px]">cancel</span> {{ $donation->status }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 reveal active" style="animation-delay: 0.2s">
                    <div class="neu-card-static p-8 space-y-6">
                        <h3 class="text-sm font-black text-[#0A1128] uppercase tracking-widest border-b border-slate-100 pb-4">Profil Donateur</h3>
                        <div class="flex items-start gap-5">
                            <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 text-[#0A1128] flex items-center justify-center font-black text-2xl">
                                @if($donation->isAnonymous)
                                    <span class="material-symbols-outlined text-4xl text-slate-300">person_off</span>
                                @else
                                    {{ substr($donation->donator->name ?? 'I', 0, 1) }}
                                @endif
                            </div>
                            <div class="space-y-1">
                                <p class="font-black text-lg text-[#0A1128] leading-tight">
                                    {{ $donation->isAnonymous ? 'Anonyme' : ($donation->donator->name ?? 'Inconnu') }}
                                </p>
                                @if(!$donation->isAnonymous && $donation->donator)
                                    <p class="text-sm font-bold text-slate-500">{{ $donation->donator->email }}</p>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 flex items-center gap-1 mt-1">
                                        <span class="material-symbols-outlined text-[14px]">call</span>
                                        {{ $donation->donator->phone ?? 'N/A' }}
                                    </p>
                                @else
                                    <p class="text-[10px] font-black uppercase tracking-widest text-[#F5A623] mt-2">Le donateur a choisi de rester anonyme.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="neu-card-static p-8 space-y-6">
                        <h3 class="text-sm font-black text-[#0A1128] uppercase tracking-widest border-b border-slate-100 pb-4">Projet & Association</h3>
                        <div class="flex items-start gap-5">
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-[#F5A623]">
                                <span class="material-symbols-outlined text-4xl">foundation</span>
                            </div>
                            <div class="space-y-1">
                                <p class="font-black text-[#0A1128] line-clamp-2 leading-tight">
                                    <a href="{{ route('projects.show', $donation->project->id) }}" target="_blank" class="hover:text-[#F5A623] transition-colors">
                                        {{ $donation->project->title }}
                                    </a>
                                </p>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mt-2">Bénéficiaire: <strong class="text-[#0A1128]">{{ $donation->project->association->name ?? 'N/A' }}</strong></p>
                                <p class="text-[10px] font-black text-emerald-600 flex items-center gap-1 mt-1 bg-emerald-50 w-max px-2 py-1 rounded">
                                    <span class="material-symbols-outlined text-[14px]">verified</span> Association Vérifiée
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($donation->message)
                <div class="neu-card-static p-8 reveal active" style="animation-delay: 0.3s">
                    <h3 class="text-sm font-black text-[#0A1128] uppercase tracking-widest mb-6">Message du donateur</h3>
                    <div class="bg-slate-50 p-6 rounded-2xl border-l-4 border-[#F5A623] relative">
                        <span class="material-symbols-outlined absolute top-4 right-4 text-slate-200 text-4xl">format_quote</span>
                        <p class="text-[#0A1128] font-bold leading-relaxed italic relative z-10">
                            "{{ $donation->message }}"
                        </p>
                    </div>
                </div>
                @endif

                <div class="neu-card-static p-8 reveal active" style="animation-delay: 0.4s">
                    <h3 class="text-lg font-black text-[#0A1128] mb-8">Historique & Audit</h3>
                    
                    <div class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                        
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-slate-200 border-4 border-white shadow-sm z-10"></div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                <div>
                                    <p class="font-black text-[#0A1128]">Don Initié</p>
                                    <p class="text-sm font-medium text-slate-500">Le donateur a validé le formulaire sur la plateforme.</p>
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-[#0A1128]">Système</p>
                                    <p class="text-xs font-bold text-slate-400">{{ $donation->created_at->format('d M Y • H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        @if($donation->payment)
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full {{ $donation->payment->status === 'SUCCESS' ? 'bg-emerald-500' : 'bg-[#F5A623]' }} border-4 border-white shadow-sm z-10"></div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                <div>
                                    <p class="font-black text-[#0A1128]">Statut du Paiement</p>
                                    <p class="text-sm font-medium text-slate-500">Méthode: <strong class="text-[#0A1128] uppercase">{{ $donation->payment->paymentMethod }}</strong></p>
                                    @if($donation->payment->paymentReceipt)
                                        <a href="{{ asset('storage/' . $donation->payment->paymentReceipt) }}" target="_blank" class="text-[10px] font-black uppercase tracking-widest text-[#F5A623] hover:text-[#0A1128] transition-colors mt-2 inline-flex items-center gap-1 bg-amber-50 px-2 py-1 rounded">
                                            <span class="material-symbols-outlined text-[14px]">link</span> Voir le reçu uploadé
                                        </a>
                                    @endif
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-[#0A1128]">Finance</p>
                                    <p class="text-xs font-bold text-slate-400">{{ $donation->payment->paymentDate->format('d M Y • H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(in_array($donation->status, ['VALIDATED', 'PROCESSING', 'RECEIVED', 'IMPACT']))
                        <div class="relative pl-10">
                            <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-emerald-500 border-4 border-white shadow-sm z-10"></div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
                                <div>
                                    <p class="font-black text-[#0A1128]">Don Validé</p>
                                    <p class="text-sm font-medium text-slate-500">Les fonds ont été confirmés et ajoutés à la jauge du projet.</p>
                                </div>
                                <div class="text-left md:text-right">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-[#0A1128]">Admin AL-KHAIR</p>
                                    <p class="text-xs font-bold text-slate-400">{{ $donation->updated_at->format('d M Y • H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8 reveal active" style="animation-delay: 0.5s">
                
                <div class="bg-gradient-to-br from-[#0A1128] to-[#162040] text-white rounded-[1.5rem] p-8 overflow-hidden relative shadow-2xl">
                    <div class="relative z-10 space-y-6">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-[#F5A623]">Signature d'Audit</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-xs font-bold text-white/50 uppercase tracking-wider">ID Transaction</span>
                                <span class="text-xs font-black tracking-widest">{{ $donation->payment->transactionId ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-xs font-bold text-white/50 uppercase tracking-wider">Date création</span>
                                <span class="text-xs font-black">{{ $donation->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-xs font-bold text-white/50 uppercase tracking-wider">Message</span>
                                <span class="text-xs font-black text-right max-w-[150px] truncate" title="{{ $donation->message ?? 'Aucun' }}">{{ $donation->message ? 'Oui' : 'Non' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-1">
                                <span class="text-xs font-bold text-white/50 uppercase tracking-wider">Anonyme</span>
                                <span class="text-xs font-black">{{ $donation->isAnonymous ? 'Oui' : 'Non' }}</span>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/10">
                            <div class="flex items-start gap-3 bg-white/5 p-4 rounded-xl border border-white/10">
                                <span class="material-symbols-outlined text-[#F5A623] text-xl">security</span>
                                <p class="text-[10px] font-bold text-white/70 uppercase tracking-widest leading-relaxed">
                                    Enregistrement sécurisé. Toute modification non autorisée est bloquée.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-[#F5A623]/10 rounded-full blur-3xl pointer-events-none"></div>
                </div>

                <div class="neu-card-static p-8 space-y-6">
                    <h3 class="text-sm font-black uppercase tracking-widest text-[#0A1128] border-b border-slate-100 pb-4">Actions Administratives</h3>
                    
                    @if($donation->status === 'PENDING')
                        <form action="{{ route('admin.validateDonation', $donation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-[#0A1128] text-white font-black text-[10px] uppercase tracking-widest py-4 rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] transition-all flex items-center justify-center gap-2 shadow-lg active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                Approuver ce don
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.rejectDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Refuser définitivement ce don ?');">
                            @csrf
                            <button type="submit" class="w-full bg-red-50 text-red-600 font-black text-[10px] uppercase tracking-widest py-4 rounded-xl hover:bg-red-500 hover:text-white transition-all flex items-center justify-center gap-2 shadow-sm border border-red-100 mt-3 active:scale-95">
                                <span class="material-symbols-outlined text-[18px]">cancel</span>
                                Refuser
                            </button>
                        </form>
                    @else
                        <div class="w-full bg-slate-50 border border-slate-100 text-slate-400 font-black text-[10px] uppercase tracking-widest py-4 rounded-xl flex items-center justify-center gap-2 cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">lock</span>
                            Don déjà traité
                        </div>
                    @endif
                </div>
            </div>
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
