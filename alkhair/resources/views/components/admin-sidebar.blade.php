<aside class="h-screen w-64 fixed left-0 top-0 z-50 bg-slate-50 dark:bg-slate-900 flex flex-col p-4 gap-2">
    <div class="mb-8 px-4 py-6">
        <h1 class="font-headline font-extrabold text-lg text-slate-900 dark:text-white uppercase tracking-wider">AL-KHAIR</h1>
        <p class="text-xs font-medium text-slate-500 uppercase tracking-widest mt-1">Admin</p>
    </div>
    <nav class="flex-grow space-y-1">
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500/10 text-amber-700 font-bold translate-x-1' : 'text-slate-600 hover:bg-slate-200' }} transition-transform duration-200" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="text-sm font-medium">Tableau de Bord</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-amber-500/10 text-amber-700 font-bold translate-x-1' : 'text-slate-600 hover:bg-slate-200' }} transition-colors" href="{{ route('admin.categories.index') }}">
            <span class="material-symbols-outlined">category</span>
            <span class="text-sm font-medium">Catégories</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.validations') ? 'bg-amber-500/10 text-amber-700 font-bold translate-x-1' : 'text-slate-600 hover:bg-slate-200' }} transition-colors" href="{{ route('admin.validations') }}">
            <span class="material-symbols-outlined">fact_check</span>
            <span class="text-sm font-medium">Validations KYC</span>
        </a>
        <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users') ? 'bg-amber-500/10 text-amber-700 font-bold translate-x-1' : 'text-slate-600 hover:bg-slate-200' }} transition-colors" href="{{ route('admin.users') }}">
            <span class="material-symbols-outlined">group</span>
            <span class="text-sm font-medium">Utilisateurs</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-4 px-4">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 py-3 text-red-600 hover:text-red-700 font-medium text-sm transition-colors text-left">
                <span class="material-symbols-outlined">logout</span>
                Déconnexion
            </button>
        </form>
    </nav>
    <div class="mt-auto p-4 bg-primary-container text-white/90 rounded-xl text-xs flex items-center justify-between">
        <span class="font-medium">Système: Actif</span>
        <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
    </div>
</aside>
