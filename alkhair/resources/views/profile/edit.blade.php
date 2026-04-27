<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mon Profil | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        
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
                <p class="text-[10px] font-bold text-[#F5A623] tracking-[0.2em] uppercase mt-0.5">
                    {{ auth()->user()->role === 'donator' ? 'Espace Donateur' : 'Espace Profil' }}
                </p>
            </div>
        </div>
    </div>

    <nav class="flex-grow space-y-2">
        <a href="{{ auth()->user()->role === 'donator' ? route('donator.dashboard') : route('dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3.5 text-slate-600">
            <span class="material-symbols-outlined text-xl">dashboard</span>
            <span class="text-sm font-semibold">Tableau de bord</span>
        </a>
        <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3.5 active">
            <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
            <span class="text-sm font-semibold">Mon Profil</span>
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
            <a href="{{ auth()->user()->role === 'donator' ? route('donator.dashboard') : route('dashboard') }}" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-[#0A1128]">arrow_back</span>
            </a>
            <h2 class="text-xl font-black text-[#0A1128] tracking-tight">Paramètres du profil</h2>
        </div>
        <div class="flex items-center gap-5">
            <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-[#0A1128] truncate max-w-[200px]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#F5A623] font-bold uppercase tracking-wider">{{ auth()->user()->role }}</p>
                </div>
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#0A1128] to-[#1a2744] flex items-center justify-center font-black text-[#F5A623] text-sm shadow-lg border border-[#F5A623]/20">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </div>
            </div>
        </div>
    </header>

    <div class="pt-24 pb-20 px-8 max-w-4xl mx-auto space-y-8">
        
        <div class="reveal active">
            <h2 class="text-4xl font-black text-[#0A1128] tracking-tight mb-2">Mon Profil</h2>
            <p class="text-slate-500 text-sm max-w-2xl leading-relaxed">Gérez vos informations personnelles, votre adresse email et la sécurité de votre compte.</p>
        </div>

        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div class="neu-card-static p-5 border-l-4 border-emerald-500 flex items-center gap-4 reveal active bg-emerald-50/30">
                <span class="material-symbols-outlined text-emerald-500 text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <span class="font-bold text-sm text-emerald-700">Mise à jour effectuée avec succès.</span>
            </div>
        @endif

        <!-- Profile Information -->
        <div class="neu-card-static p-8 reveal" style="animation-delay: 0.1s">
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100">
                    <span class="material-symbols-outlined text-blue-600">manage_accounts</span>
                </div>
                <div>
                    <h3 class="font-black text-xl text-[#0A1128]">Informations du Profil</h3>
                    <p class="text-xs text-slate-500">Mettez à jour le nom et l'adresse email de votre compte.</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Nom Complet</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus class="w-full modern-input px-4 py-3.5" />
                    @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Adresse Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="w-full modern-input px-4 py-3.5" />
                    @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-[#0A1128] text-white font-black rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-md text-xs uppercase tracking-wider">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="neu-card-static p-8 reveal" style="animation-delay: 0.2s">
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                    <span class="material-symbols-outlined text-[#F5A623]">key</span>
                </div>
                <div>
                    <h3 class="font-black text-xl text-[#0A1128]">Mettre à jour le mot de passe</h3>
                    <p class="text-xs text-slate-500">Assurez-vous que votre compte utilise un mot de passe long et aléatoire.</p>
                </div>
            </div>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Mot de passe actuel</label>
                    <input id="update_password_current_password" name="current_password" type="password" required class="w-full modern-input px-4 py-3.5" />
                    @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="update_password_password" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Nouveau mot de passe</label>
                    <input id="update_password_password" name="password" type="password" required class="w-full modern-input px-4 py-3.5" />
                    @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Confirmer le mot de passe</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" required class="w-full modern-input px-4 py-3.5" />
                    @error('password_confirmation', 'updatePassword') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-[#0A1128] text-white font-black rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-md text-xs uppercase tracking-wider">
                        Modifier le mot de passe
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Account -->
        <div class="neu-card-static p-8 border-l-4 border-red-500 bg-red-50/10 reveal" style="animation-delay: 0.3s">
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-red-100">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center border border-red-200">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                </div>
                <div>
                    <h3 class="font-black text-xl text-red-600">Supprimer le compte</h3>
                    <p class="text-xs text-red-400">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.</p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-[10px] font-bold uppercase tracking-wider text-red-400 mb-2">Mot de passe pour confirmer</label>
                    <input id="password" name="password" type="password" required placeholder="Votre mot de passe" class="w-full bg-white border border-red-200 rounded-xl px-4 py-3.5 focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none transition-all" />
                    @error('password', 'userDeletion') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white font-black rounded-xl hover:bg-red-700 transition-all shadow-md text-xs uppercase tracking-wider">
                        Supprimer définitivement
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
