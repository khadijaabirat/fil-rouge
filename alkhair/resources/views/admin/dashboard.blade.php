<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tableau de Bord Administrateur - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "brand-navy": "#0A1128",
                        "brand-gold": "#F5A623",
                        "brand-light-gold": "#FFD085",
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fb;
            color: #191c1e;
        }
        .glass-effect {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="bg-slate-50 font-body selection:bg-brand-gold/30">
    <!-- Sidebar -->
    <aside class="h-screen w-64 fixed left-0 top-0 z-50 bg-white dark:bg-slate-900 flex flex-col p-4 gap-2 border-r border-slate-200">
        <div class="mb-8 px-4 py-6">
            <div class="flex items-center gap-2 mb-2">
                <div class="bg-gradient-to-br from-brand-navy to-brand-gold p-2 rounded-lg font-black text-white text-lg">AK</div>
                <div>
                    <h1 class="font-headline font-extrabold text-lg text-slate-900 uppercase tracking-wider">AL-KHAIR</h1>
                    <p class="text-xs font-medium text-brand-gold uppercase tracking-widest">Admin</p>
                </div>
            </div>
        </div>
        <nav class="flex-grow space-y-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-brand-gold/10 text-brand-gold font-bold transition-transform duration-200" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-['Inter'] text-sm font-medium">Tableau de Bord</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors" href="{{ route('admin.categories.index') }}">
                <span class="material-symbols-outlined">category</span>
                <span class="font-['Inter'] text-sm font-medium">Catégories</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors" href="#">
                <span class="material-symbols-outlined">account_balance</span>
                <span class="font-['Inter'] text-sm font-medium">Associations</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors" href="#">
                <span class="material-symbols-outlined">assignment</span>
                <span class="font-['Inter'] text-sm font-medium">Projets</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 hover:bg-slate-200 transition-colors" href="#">
                <span class="material-symbols-outlined">volunteer_activism</span>
                <span class="font-['Inter'] text-sm font-medium">Dons</span>
            </a>
        </nav>
        <div class="mt-auto p-4 bg-brand-navy text-white rounded-xl text-xs flex items-center justify-between">
            <span class="font-medium">Système: Actif</span>
            <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full py-2 text-sm font-bold text-brand-gold hover:bg-brand-gold/10 rounded-lg transition-colors">
                Déconnexion
            </button>
        </form>
    </aside>

    <!-- Main Content Area -->
    <main class="ml-64 min-h-screen">
        <!-- Top Navigation -->
        <header class="w-full sticky top-0 z-40 bg-white border-b border-slate-200 shadow-sm flex justify-between items-center px-8 h-16">
            <div class="flex items-center gap-8">
                <h1 class="font-headline font-bold text-xl tracking-tight text-brand-navy">AL-KHAIR</h1>
            </div>
            <div class="flex items-center gap-4">
                @if(session('success'))
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-700 text-sm font-medium">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-8 max-w-7xl mx-auto space-y-12">
            <!-- Header Section -->
            <section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div class="space-y-1">
                    <h2 class="font-headline text-3xl font-extrabold tracking-tight text-brand-navy">Vue d'ensemble</h2>
                    <p class="text-slate-600 font-medium">Gestion des validations et modérations en attente.</p>
                </div>
            </section>

            <!-- Main Dashboard Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left Column: Pending Validations -->
                <section class="lg:col-span-8 space-y-8">
                    <!-- Pending Associations -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="font-headline text-xl font-bold text-brand-navy">Associations en attente</h3>
                                <p class="text-sm text-slate-600">Validez les nouvelles demandes d'inscription</p>
                            </div>
                            <span class="px-3 py-1 bg-brand-gold/20 text-brand-gold text-[10px] font-bold rounded-full uppercase tracking-tighter">{{ $pendingAssociations->count() }} EN ATTENTE</span>
                        </div>
                        <div class="space-y-4">
                            @forelse($pendingAssociations as $assoc)
                                <div class="bg-slate-50 p-5 rounded-xl flex items-center gap-6 hover:shadow-lg transition-all duration-300">
                                    <div class="w-12 h-12 rounded-lg bg-brand-gold/10 flex items-center justify-center flex-shrink-0 text-brand-navy font-bold">
                                        {{ substr($assoc->name, 0, 1) }}
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-slate-900">{{ $assoc->name }}</h4>
                                        <p class="text-xs text-slate-500">{{ $assoc->ville }} • Licence: {{ $assoc->licenseNumber }}</p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $assoc->documentKYC) }}" target="_blank" class="px-3 py-2 text-xs font-bold text-slate-600 hover:bg-slate-200 rounded-lg transition-colors">
                                            Voir Document
                                        </a>
                                        <form action="{{ route('admin.validateAssociation', $assoc->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 text-xs font-bold bg-brand-gold text-white rounded-lg hover:bg-brand-gold/90 transition-all">
                                                Valider
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-slate-100 p-8 rounded-xl text-center">
                                    <p class="text-slate-600 font-medium">Aucune association en attente</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Pending Manual Donations -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="font-headline text-xl font-bold text-brand-navy">Dons manuels en attente</h3>
                                <p class="text-sm text-slate-600">Validez les paiements par virement bancaire</p>
                            </div>
                            <span class="px-3 py-1 bg-brand-gold/20 text-brand-gold text-[10px] font-bold rounded-full uppercase tracking-tighter">{{ $pendingDonations->count() }} EN ATTENTE</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Donateur</th>
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Projet</th>
                                        <th class="text-right py-3 px-4 font-bold text-slate-700">Montant</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Reçu</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pendingDonations as $donation)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                                            <td class="py-3 px-4">{{ $donation->isAnonymous ? 'Anonyme' : ($donation->donator->name ?? 'Inconnu') }}</td>
                                            <td class="py-3 px-4">{{ $donation->project->title ?? 'Projet supprimé' }}</td>
                                            <td class="py-3 px-4 text-right font-bold text-brand-gold">{{ number_format($donation->amount, 0, ',', ' ') }} DH</td>
                                            <td class="py-3 px-4 text-center">
                                                @if($donation->payment && $donation->payment->paymentReceipt)
                                                    <a href="{{ asset('storage/' . $donation->payment->paymentReceipt) }}" target="_blank" class="text-brand-gold hover:underline">Voir</a>
                                                @else
                                                    <span class="text-slate-400 text-xs">N/A</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                <div class="flex gap-1 justify-center">
                                                    <form action="{{ route('admin.validateDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Confirmer la validation de ce don ?');">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-emerald-500 text-white rounded hover:bg-emerald-600">
                                                            ✓
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.rejectDonation', $donation->id) }}" method="POST" onsubmit="return confirm('Refuser ce don ?');">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-red-500 text-white rounded hover:bg-red-600">
                                                            ✕
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8 px-4 text-center text-slate-600 font-medium">
                                                Aucun don manuel en attente
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Project Moderation -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="font-headline text-xl font-bold text-brand-navy">Modération des Projets</h3>
                                <p class="text-sm text-slate-600">Gérez les projets actifs et suspendus</p>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Titre</th>
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Association</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Statut</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($managedProjects as $project)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                                            <td class="py-3 px-4 font-medium">{{ $project->title }}</td>
                                            <td class="py-3 px-4">{{ $project->association->name ?? 'N/A' }}</td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="px-2 py-1 text-xs font-bold rounded {{ $project->status === 'SUSPENDED' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                    {{ $project->status === 'SUSPENDED' ? 'Suspendu' : 'Actif' }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                @if($project->status === 'SUSPENDED')
                                                    <form action="{{ route('admin.restoreProject', $project->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-emerald-500 text-white rounded hover:bg-emerald-600">
                                                            Restaurer
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.suspendProject', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Suspendre ce projet ?');">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-red-500 text-white rounded hover:bg-red-600">
                                                            Suspendre
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-8 px-4 text-center text-slate-600 font-medium">
                                                Aucun projet à modérer
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Association Moderation -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="font-headline text-xl font-bold text-brand-navy">Modération des Associations</h3>
                                <p class="text-sm text-slate-600">Gérez les statuts des associations</p>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Nom</th>
                                        <th class="text-left py-3 px-4 font-bold text-slate-700">Ville</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Statut</th>
                                        <th class="text-center py-3 px-4 font-bold text-slate-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($managedAssociations as $assoc)
                                        <tr class="border-b border-slate-100 hover:bg-slate-50">
                                            <td class="py-3 px-4 font-medium">{{ $assoc->name }}</td>
                                            <td class="py-3 px-4">{{ $assoc->ville }}</td>
                                            <td class="py-3 px-4 text-center">
                                                <span class="px-2 py-1 text-xs font-bold rounded {{ $assoc->status === 'BANNED' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                                    {{ $assoc->status === 'BANNED' ? 'Bannue' : 'Active' }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                @if($assoc->status === 'BANNED')
                                                    <form action="{{ route('admin.unbanAssociation', $assoc->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-emerald-500 text-white rounded hover:bg-emerald-600">
                                                            Réactiver
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.banAssociation', $assoc->id) }}" method="POST" class="inline" onsubmit="return confirm('Bannir cette association ? Tous ses projets seront suspendus.');">
                                                        @csrf
                                                        <button type="submit" class="px-3 py-1 text-xs font-bold bg-red-500 text-white rounded hover:bg-red-600">
                                                            Bannir
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-8 px-4 text-center text-slate-600 font-medium">
                                                Aucune association à modérer
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Right Column: Summary Stats -->
                <section class="lg:col-span-4 space-y-6">
                    <!-- Donation Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="font-headline font-bold text-brand-navy mb-4">Montant Total</h3>
                        <p class="text-3xl font-black text-brand-gold">
                            @php
                                $total = \App\Models\Donation::where('status', 'RECEIVED')->sum('amount') ?? 0;
                            @endphp
                            {{ number_format($total, 0, ',', ' ') }} DH
                        </p>
                    </div>

                    <!-- Association Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                        <h3 class="font-headline font-bold text-brand-navy mb-4">Associations Actives</h3>
                        <p class="text-3xl font-black text-brand-gold">
                            @php
                                $activeAssocs = \App\Models\User::where('role', 'ASSOCIATION')->where('status', 'APPROVED')->count() ?? 0;
                            @endphp
                            {{ $activeAssocs }}
                        </p>
                    </div>

                    <!-- Pending Actions -->
                    <div class="bg-brand-gold/10 border-l-4 border-brand-gold rounded-lg p-6">
                        <h3 class="font-headline font-bold text-brand-navy mb-4">Actions en attente</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-700">Associations</span>
                                <span class="font-bold text-brand-gold">{{ $pendingAssociations->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-700">Dons manuels</span>
                                <span class="font-bold text-brand-gold">{{ $pendingDonations->count() }}</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Al-Khair Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "tertiary-container": "#370e00",
              "surface-tint": "#4a607c",
              "tertiary-fixed": "#ffdbce",
              "primary": "#000000",
              "inverse-on-surface": "#eff1f3",
              "primary-fixed": "#d2e4ff",
              "on-tertiary-fixed": "#370e00",
              "on-primary": "#ffffff",
              "on-error": "#ffffff",
              "on-tertiary": "#ffffff",
              "error-container": "#ffdad6",
              "primary-container": "#021c36",
              "secondary-container": "#feb700",
              "on-surface": "#191c1e",
              "on-tertiary-container": "#e05814",
              "surface-container-lowest": "#ffffff",
              "surface-container": "#eceef0",
              "on-secondary-fixed": "#271900",
              "surface-container-highest": "#e0e3e5",
              "on-error-container": "#93000a",
              "error": "#ba1a1a",
              "tertiary-fixed-dim": "#ffb599",
              "surface-container-low": "#f2f4f6",
              "on-secondary": "#ffffff",
              "secondary-fixed": "#ffdea8",
              "on-secondary-fixed-variant": "#5e4200",
              "on-background": "#191c1e",
              "outline-variant": "#c4c6ce",
              "outline": "#74777e",
              "background": "#f8f9fb",
              "on-tertiary-fixed-variant": "#7f2b00",
              "surface-dim": "#d8dadc",
              "on-surface-variant": "#43474d",
              "surface-variant": "#e0e3e5",
              "surface-container-high": "#e6e8ea",
              "surface-bright": "#f8f9fb",
              "primary-fixed-dim": "#b1c8e9",
              "on-secondary-container": "#6b4b00",
              "surface": "#f8f9fb",
              "secondary-fixed-dim": "#ffba20",
              "on-primary-fixed-variant": "#324863",
              "secondary": "#7c5800",
              "on-primary-fixed": "#021c36",
              "inverse-surface": "#2d3133",
              "inverse-primary": "#b1c8e9",
              "tertiary": "#000000",
              "on-primary-container": "#6f85a3"
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
          },
        },
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fb;
        color: #191c1e;
      }
      .glass-effect {
        backdrop-filter: blur(12px);
        background-color: rgba(255, 255, 255, 0.8);
      }
    </style>
</head>
<body class="bg-surface font-body selection:bg-secondary-container/30">
<!-- SideNavBar (Execution from JSON) -->
<aside class="h-screen w-64 fixed left-0 top-0 z-50 bg-slate-50 dark:bg-slate-900 flex flex-col p-4 gap-2">
<div class="mb-8 px-4 py-6">
<h1 class="font-headline font-extrabold text-lg text-slate-900 dark:text-white uppercase tracking-wider">Al-Khair Admin</h1>
<p class="text-xs font-medium text-slate-500 uppercase tracking-widest mt-1">Humanitarian Portal</p>
</div>
<nav class="flex-grow space-y-1">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-500/10 text-amber-700 dark:text-amber-400 font-bold translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
<span class="font-['Inter'] text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="account_balance">account_balance</span>
<span class="font-['Inter'] text-sm font-medium">Associations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="assignment">assignment</span>
<span class="font-['Inter'] text-sm font-medium">Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
<span class="font-['Inter'] text-sm font-medium">Donations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-['Inter'] text-sm font-medium">Users</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="assessment">assessment</span>
<span class="font-['Inter'] text-sm font-medium">Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 transition-colors" href="#">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
<span class="font-['Inter'] text-sm font-medium">Settings</span>
</a>
</nav>
<div class="mt-auto p-4 bg-primary-container text-white/90 rounded-xl text-xs flex items-center justify-between">
<span class="font-medium">System Status: Active</span>
<div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-64 min-h-screen">
<!-- TopNavBar (Execution from JSON) -->
<header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-lg border-b border-slate-200/50 shadow-sm flex justify-between items-center px-8 h-16">
<div class="flex items-center gap-8">
<span class="font-['Manrope'] font-bold text-xl tracking-tight text-slate-950">Al-Khair</span>
<div class="hidden md:flex gap-6">
<a class="font-['Inter'] font-semibold text-sm text-black border-b-2 border-amber-500 pb-1" href="#">Dashboard</a>
<a class="font-['Inter'] font-medium text-sm text-slate-500 hover:text-amber-600 transition-colors" href="#">Analytics</a>
<a class="font-['Inter'] font-medium text-sm text-slate-500 hover:text-amber-600 transition-colors" href="#">Support</a>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-all">
<span class="material-symbols-outlined" data-icon="settings">settings</span>
</button>
<div class="h-8 w-8 rounded-full overflow-hidden bg-slate-200 ml-2">
<img alt="Admin Avatar" class="w-full h-full object-cover" data-alt="Portrait of a professional male administrator" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjvhta3jcDMZS43cvTdJey4_XvTOg9BuZ_HO0xYtaYV9pwxCE2TYkDo0XskfdpBktDmyu4Vrmagw8RyFHKEHWk0kbeKMbeIOKCWDOlbuRFcuBYg4pcoSqI9bbiOMlhFgwmBJmE6MxRjhBcuXFFkKuvbjPTIEh7SumGAjVoRamQjRTh64ks_KgmxPAZi8mxZL4LOOciqTIAS65A9qdsYaTupn9uLAoaZT21CQVgHFfk3Hi-3tblNF18ecWofWJIIf9-w-7Ye5AXue0"/>
</div>
</div>
</header>
<!-- Dashboard Content -->
<div class="p-8 max-w-7xl mx-auto space-y-12">
<!-- Header Section -->
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
<div class="space-y-1">
<h2 class="font-headline text-3xl font-extrabold tracking-tight text-primary-container">Platform Overview</h2>
<p class="text-on-surface-variant font-medium">Real-time performance and pending administrative actions.</p>
</div>
<div class="flex gap-3">
<button class="px-5 py-2.5 bg-surface-container-high text-on-surface font-semibold text-sm rounded-lg flex items-center gap-2 hover:bg-surface-container-highest transition-all">
<span class="material-symbols-outlined text-lg" data-icon="file_download">file_download</span>
                        Export Report
                    </button>
</div>
</section>
<!-- Statistics Cards (Bento Grid Style) -->
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_32px_64px_-12px_rgba(25,28,30,0.04)] border border-white flex flex-col gap-4">
<div class="flex justify-between items-start">
<span class="p-2 bg-amber-500/10 text-amber-700 rounded-lg">
<span class="material-symbols-outlined" data-icon="payments">payments</span>
</span>
<span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+12.5%</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Collected</p>
<h3 class="text-2xl font-extrabold font-headline text-primary-container mt-1">1,284,500 <span class="text-sm font-medium">DH</span></h3>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_32px_64px_-12px_rgba(25,28,30,0.04)] border border-white flex flex-col gap-4">
<div class="flex justify-between items-start">
<span class="p-2 bg-slate-100 text-primary-container rounded-lg">
<span class="material-symbols-outlined" data-icon="account_balance">account_balance</span>
</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Active Associations</p>
<h3 class="text-2xl font-extrabold font-headline text-primary-container mt-1">42</h3>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_32px_64px_-12px_rgba(25,28,30,0.04)] border border-white flex flex-col gap-4">
<div class="flex justify-between items-start">
<span class="p-2 bg-slate-100 text-primary-container rounded-lg">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
</span>
<span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">+210 new</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Donors</p>
<h3 class="text-2xl font-extrabold font-headline text-primary-container mt-1">8,942</h3>
</div>
</div>
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_32px_64px_-12px_rgba(25,28,30,0.04)] border border-white flex flex-col gap-4">
<div class="flex justify-between items-start">
<span class="p-2 bg-amber-500 text-white rounded-lg">
<span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
</span>
</div>
<div>
<p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Impact Rate</p>
<h3 class="text-2xl font-extrabold font-headline text-primary-container mt-1">94.8%</h3>
</div>
</div>
</section>
<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<!-- Left Column: Pending Validations -->
<section class="lg:col-span-8 space-y-8">
<div class="bg-surface-container-low rounded-2xl p-8">
<div class="flex items-center justify-between mb-8">
<div>
<h3 class="font-headline text-xl font-bold text-primary-container">Pending Validations</h3>
<p class="text-sm text-on-surface-variant">Review new association requests and projects</p>
</div>
<span class="px-3 py-1 bg-tertiary-container text-white text-[10px] font-bold rounded-full uppercase tracking-tighter">4 ACTIONS REQUIRED</span>
</div>
<div class="space-y-4">
<!-- Pending Item 1 -->
<div class="bg-surface-container-lowest p-5 rounded-xl flex items-center gap-6 group hover:shadow-lg transition-all duration-300">
<div class="w-12 h-12 rounded-lg bg-surface-container overflow-hidden flex-shrink-0">
<img alt="Assoc Logo" class="w-full h-full object-cover" data-alt="Non-profit organization logo showing helping hands" src="https://lh3.googleusercontent.com/aida-public/AB6AXuChiBju_w2JGEVHGAWeLF99OarP8aUDNGYy4GXU7lQY6UbukF4lDZWkb0d73uK4ejdiL3zIeYmJ6j6zsuXHaI7rtixmWABb6rU7cS-pfkGak9mUJvm54RlQKo5s0hUDdyUojhu75T8S4SKhWiJF9705BaN2XUaWMbf_EHHGmefGISPqYlT_jSp9NzDvZTLtp1xzyN3ODtNlIOzTRVCfpoppCxb38scC_aT2L7K8pmR0vQsNhDhfj-enYtHq6IpYqDm7OifAHhkw1t4"/>
</div>
<div class="flex-grow">
<h4 class="font-bold text-on-surface">Atlas Relief Network</h4>
<p class="text-xs text-on-surface-variant">New Association Account • Submitted 2h ago</p>
</div>
<div class="flex gap-2">
<button class="px-4 py-2 text-xs font-bold text-error hover:bg-error-container rounded-lg transition-colors">Reject</button>
<button class="px-4 py-2 text-xs font-bold bg-primary-container text-white rounded-lg hover:scale-105 transition-all">Approve</button>
</div>
</div>
<!-- Pending Item 2 -->
<div class="bg-surface-container-lowest p-5 rounded-xl flex items-center gap-6 group hover:shadow-lg transition-all duration-300">
<div class="w-12 h-12 rounded-lg bg-surface-container overflow-hidden flex-shrink-0">
<img alt="Project Logo" class="w-full h-full object-cover" data-alt="Community well building project in Africa" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7S-s6n_IslWKt3faNAKAlciMqUAQzW6EkH2edOylSgRuOxtwLLdhKY8LFWYJ-5Ixn05PN7yTfgzhltCw5T7PeZSCTcaZw09UBZyFE_9bzx53jp8HWPyMKsWiq_Baq9PhlXpsXQiGag7x9Xhcbv66Fzwtb3hcKwWB7YzFN4BrdBHw9Lfgp0LllfXadzBrYmfN6Xj2JNyGGgRKC1qQB-LFAEu5iw8iTeAC5tJgEuzOEFccxyetTU7Ysv8zlWvXt5WpJjZR7iirkbX0"/>
</div>
<div class="flex-grow">
<h4 class="font-bold text-on-surface">Village Water Well - Azilal</h4>
<p class="text-xs text-on-surface-variant">Infrastructure Project • Submitted 5h ago</p>
</div>
<div class="flex gap-2">
<button class="px-4 py-2 text-xs font-bold text-error hover:bg-error-container rounded-lg transition-colors">Reject</button>
<button class="px-4 py-2 text-xs font-bold bg-primary-container text-white rounded-lg hover:scale-105 transition-all">Approve</button>
</div>
</div>
<!-- Pending Item 3 -->
<div class="bg-surface-container-lowest p-5 rounded-xl flex items-center gap-6 group hover:shadow-lg transition-all duration-300">
<div class="w-12 h-12 rounded-lg bg-surface-container overflow-hidden flex-shrink-0">
<img alt="Assoc Logo" class="w-full h-full object-cover" data-alt="Educational charity icon with books" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAM9ztm7875iJpn1QSkJ-BUweA2eJd6gpFbM6eMia_zgXWYqyfQK4rUaKr1Mx557Uo7-w8P8LYJ4ahvLZIBevI9M7Xr0NXjTf9zZu7k2y8_-Ur-4gsqnPYObgLQ9WnEEBUb6yCDdcdx-g3duuevMJ3niKRIgM9PLz81ufPQC7JN6IB_syNtd3vTpk6qG-Yd5cxcWCmWuREusoBiw8Rh2kQKibb0gphdJnK28ZnwjbqsdYm1MOW-KSncsd4XCRyh16v_HY0nzbjtY5I"/>
</div>
<div class="flex-grow">
<h4 class="font-bold text-on-surface">Savoir Pour Tous</h4>
<p class="text-xs text-on-surface-variant">Education NGO • Submitted yesterday</p>
</div>
<div class="flex gap-2">
<button class="px-4 py-2 text-xs font-bold text-error hover:bg-error-container rounded-lg transition-colors">Reject</button>
<button class="px-4 py-2 text-xs font-bold bg-primary-container text-white rounded-lg hover:scale-105 transition-all">Approve</button>
</div>
</div>
</div>
</div>
<!-- Global Donation Chart (Simulated Visualization) -->
<div class="bg-surface-container-lowest rounded-2xl p-8 border border-surface-container-high">
<div class="flex items-center justify-between mb-10">
<div>
<h3 class="font-headline text-xl font-bold text-primary-container">Donation Trends</h3>
<p class="text-sm text-on-surface-variant">Volume analysis for the last 6 months</p>
</div>
<div class="flex gap-2 bg-surface-container-low p-1 rounded-lg">
<button class="px-3 py-1 text-[10px] font-bold bg-white rounded shadow-sm">VOLUME</button>
<button class="px-3 py-1 text-[10px] font-bold text-on-surface-variant">COUNT</button>
</div>
</div>
<div class="relative h-64 w-full flex items-end gap-2 px-2">
<!-- Simplified CSS-based Bar Chart representing 6 months -->
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 45%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-primary-container text-white text-[10px] py-1 px-2 rounded">180K</div>
<div class="absolute inset-0 bg-primary-container/20 rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">MAY</span>
</div>
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 60%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-primary-container text-white text-[10px] py-1 px-2 rounded">240K</div>
<div class="absolute inset-0 bg-primary-container/20 rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">JUN</span>
</div>
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 55%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-primary-container text-white text-[10px] py-1 px-2 rounded">210K</div>
<div class="absolute inset-0 bg-primary-container/20 rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">JUL</span>
</div>
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 85%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-amber-500 text-on-secondary-fixed text-[10px] py-1 px-2 rounded">340K</div>
<div class="absolute inset-0 bg-secondary-container rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">AUG</span>
</div>
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 70%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-primary-container text-white text-[10px] py-1 px-2 rounded">280K</div>
<div class="absolute inset-0 bg-primary-container/20 rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">SEP</span>
</div>
<div class="flex-grow bg-slate-100 rounded-t-lg relative group" style="height: 95%;">
<div class="absolute -top-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity bg-primary-container text-white text-[10px] py-1 px-2 rounded">390K</div>
<div class="absolute inset-0 bg-primary-container/20 rounded-t-lg"></div>
<span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] font-bold text-slate-400">OCT</span>
</div>
</div>
</div>
</section>
<!-- Right Column: Manual Donations & Stats -->
<section class="lg:col-span-4 space-y-8">
<div class="bg-primary-container text-white rounded-2xl p-8 relative overflow-hidden shadow-xl">
<div class="relative z-10">
<h3 class="font-headline text-lg font-bold mb-6">Recent Manual Donations</h3>
<div class="space-y-6">
<!-- Transaction 1 -->
<div class="space-y-3 pb-4 border-b border-white/10">
<div class="flex justify-between items-start">
<div>
<p class="text-sm font-bold">Ahmed Mansouri</p>
<p class="text-[10px] text-white/60">Bank Transfer • 5,000 DH</p>
</div>
<span class="text-[10px] px-2 py-0.5 rounded bg-amber-500 text-on-secondary-fixed font-bold">PENDING</span>
</div>
<div class="flex gap-2">
<button class="flex-1 py-2 text-[10px] font-bold bg-white/10 hover:bg-white/20 rounded transition-colors flex items-center justify-center gap-1">
<span class="material-symbols-outlined text-sm" data-icon="receipt_long">receipt_long</span> Verify Receipt
                                        </button>
<button class="flex-1 py-2 text-[10px] font-bold bg-secondary-container text-on-secondary-fixed rounded hover:scale-105 transition-all">Confirm</button>
</div>
</div>
<!-- Transaction 2 -->
<div class="space-y-3 pb-4 border-b border-white/10">
<div class="flex justify-between items-start">
<div>
<p class="text-sm font-bold">Inara Co. Ltd</p>
<p class="text-[10px] text-white/60">Corporate Grant • 25,000 DH</p>
</div>
<span class="text-[10px] px-2 py-0.5 rounded bg-amber-500 text-on-secondary-fixed font-bold">PENDING</span>
</div>
<div class="flex gap-2">
<button class="flex-1 py-2 text-[10px] font-bold bg-white/10 hover:bg-white/20 rounded transition-colors flex items-center justify-center gap-1">
<span class="material-symbols-outlined text-sm" data-icon="receipt_long">receipt_long</span> Verify Receipt
                                        </button>
<button class="flex-1 py-2 text-[10px] font-bold bg-secondary-container text-on-secondary-fixed rounded hover:scale-105 transition-all">Confirm</button>
</div>
</div>
</div>
<button class="w-full mt-6 py-3 text-xs font-bold text-white/70 hover:text-white transition-colors uppercase tracking-widest">View All Queue</button>
</div>
<!-- Decorative element -->
<div class="absolute -right-12 -bottom-12 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl"></div>
</div>
<!-- Platform Activity Feed -->
<div class="bg-surface-container-low rounded-2xl p-8 border border-white">
<h3 class="font-headline text-lg font-bold text-primary-container mb-6">Activity Feed</h3>
<div class="space-y-6 relative">
<!-- Line decoration -->
<div class="absolute left-2.5 top-2 bottom-2 w-0.5 bg-slate-200"></div>
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-emerald-500 border-4 border-surface-container-low"></div>
<p class="text-xs font-bold text-on-surface">System Verification</p>
<p class="text-[10px] text-on-surface-variant">Education Hub project reached 100% funding.</p>
<span class="text-[10px] text-slate-400">12 mins ago</span>
</div>
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-amber-500 border-4 border-surface-container-low"></div>
<p class="text-xs font-bold text-on-surface">New Association Flagged</p>
<p class="text-[10px] text-on-surface-variant">Duplicate documentation detected for 'Atlas Relief'.</p>
<span class="text-[10px] text-slate-400">45 mins ago</span>
</div>
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-primary-container border-4 border-surface-container-low"></div>
<p class="text-xs font-bold text-on-surface">Weekly Report Generated</p>
<p class="text-[10px] text-on-surface-variant">Financial audit for Q4 is now ready for review.</p>
<span class="text-[10px] text-slate-400">2 hours ago</span>
</div>
</div>
</div>
</section>
</div>
</div>
</main>
<!-- Floating Tooltip (Generic implementation for UI demo) -->
<div class="fixed bottom-8 right-8 group">
<div class="bg-primary-container text-white p-4 rounded-full shadow-2xl cursor-help hover:scale-110 transition-transform">
<span class="material-symbols-outlined" data-icon="support_agent">support_agent</span>
</div>
<div class="absolute bottom-full right-0 mb-4 w-48 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
<div class="bg-slate-900 text-white text-[10px] font-medium p-3 rounded-xl shadow-xl border border-slate-700">
                Need help with the platform? Contact Al-Khair technical support.
            </div>
</div>
</div>
</body></html>