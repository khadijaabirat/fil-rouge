<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-green-500">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Mon Profil Association</h1>
            <a href="{{ route('association.dashboard') }}" class="text-green-600 hover:underline font-medium">Retour au Dashboard</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-6">{{ session('success') }}</div>
        @endif

       <form action="{{ route('association.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-8 flex items-center space-x-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="shrink-0">
                    @if($association->profilePhoto)
                        <img class="h-24 w-24 object-cover rounded-full border-4 border-green-500 shadow-sm" src="{{ asset('storage/' . $association->profilePhoto) }}" alt="Photo de profil">
                    @else
                        <div class="h-24 w-24 rounded-full bg-green-100 flex items-center justify-center border-4 border-green-500 text-green-600 font-bold text-xl">
                            {{ substr($association->name, 0, 2) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">Logo / Photo de profil</label>
                    <input type="file" name="profilePhoto" accept="image/jpeg, image/png, image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                    <p class="text-xs text-gray-500 mt-2">Formats acceptés : JPG, PNG. Taille max : 2MB.</p>
                    @error('profilePhoto') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nom de l'association *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $association->name) }}" required class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>

                <div>
                    <label for="rib" class="block text-gray-700 font-medium mb-2">RIB Bancaire (24 chiffres)</label>
                    <input type="text" id="rib" name="rib" value="{{ old('rib', $association->rib) }}" placeholder="Ex: 011810000000000000000000" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 font-mono text-blue-700">
                    @error('rib') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville', $association->ville) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $association->phone) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-700 font-medium mb-2">Adresse complète</label>
                <input type="text" id="address" name="address" value="{{ old('address', $association->address) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description / Présentation de l'association</label>
                <textarea id="description" name="description" rows="4" placeholder="Parlez-nous de vos objectifs et de vos actions sur le terrain..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">{{ old('description', $association->description) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-bold shadow-sm">
                    Mettre à jour le profil
                </button>
            </div>
        </form>
    </div>

</body>
</html>
<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Profil de l'Association - Al-Khair</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-secondary": "#ffffff",
              "on-tertiary-container": "#e05814",
              "inverse-surface": "#2d3133",
              "primary-fixed": "#d2e4ff",
              "on-background": "#191c1e",
              "primary-container": "#021c36",
              "on-primary-fixed-variant": "#324863",
              "inverse-on-surface": "#eff1f3",
              "surface-container-high": "#e6e8ea",
              "surface-container": "#eceef0",
              "on-error-container": "#93000a",
              "on-error": "#ffffff",
              "outline-variant": "#c4c6ce",
              "secondary-container": "#feb700",
              "on-surface-variant": "#43474d",
              "tertiary-container": "#370e00",
              "surface-container-low": "#f2f4f6",
              "on-tertiary-fixed-variant": "#7f2b00",
              "on-secondary-container": "#6b4b00",
              "inverse-primary": "#b1c8e9",
              "surface-container-lowest": "#ffffff",
              "tertiary-fixed": "#ffdbce",
              "secondary": "#7c5800",
              "on-surface": "#191c1e",
              "surface-variant": "#e0e3e5",
              "surface": "#f8f9fb",
              "primary": "#000000",
              "on-secondary-fixed-variant": "#5e4200",
              "error": "#ba1a1a",
              "on-secondary-fixed": "#271900",
              "primary-fixed-dim": "#b1c8e9",
              "on-primary": "#ffffff",
              "tertiary": "#000000",
              "surface-bright": "#f8f9fb",
              "secondary-fixed-dim": "#ffba20",
              "surface-container-highest": "#e0e3e5",
              "secondary-fixed": "#ffdea8",
              "outline": "#74777e",
              "on-tertiary": "#ffffff",
              "error-container": "#ffdad6",
              "tertiary-fixed-dim": "#ffb599",
              "surface-tint": "#4a607c",
              "surface-dim": "#d8dadc",
              "on-primary-container": "#6f85a3",
              "on-primary-fixed": "#021c36",
              "on-tertiary-fixed": "#370e00",
              "background": "#f8f9fb"
            },
            fontFamily: {
              "headline": ["Manrope"],
              "body": ["Inter"],
              "label": ["Inter"]
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
      .glass-header {
        backdrop-filter: blur(12px);
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-lg shadow-sm dark:shadow-none">
<div class="flex items-center justify-between px-8 h-16 max-w-screen-2xl mx-auto">
<div class="flex items-center gap-8">
<span class="text-xl font-bold text-slate-950 dark:text-white tracking-tighter font-headline">Al-Khair</span>
<nav class="hidden md:flex gap-6 items-center">
<a class="text-slate-900 dark:text-white border-b-2 border-amber-500 pb-1 font-headline font-semibold tracking-tight" href="#">Associations</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors font-headline font-semibold tracking-tight" href="#">Projects</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors font-headline font-semibold tracking-tight" href="#">KYC Hub</a>
<a class="text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 transition-colors font-headline font-semibold tracking-tight" href="#">Analytics</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="relative hidden lg:block">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="bg-slate-100 border-none rounded-full pl-10 pr-4 py-1.5 text-sm focus:ring-2 focus:ring-amber-500 w-64" placeholder="Search archive..." type="text"/>
</div>
<button class="p-2 hover:bg-slate-50 dark:hover:bg-slate-900 transition-all duration-200 rounded-full">
<span class="material-symbols-outlined text-slate-600">settings</span>
</button>
<img alt="Association Administrator Profile" class="w-8 h-8 rounded-full object-cover" data-alt="Association Administrator Profile headshot" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJ4AwGxUbpWU2E0V358M2XuPpV0Xi5kRpxlLOz7_4psGU2YbPddek7xmi1wra42In6gSpf6ge3UAln4RBIcrDJEVHlms7bspzdrD5swXyAAmjnq7MBB0Za1OQ2x-HHHPcyQyydD48HB7CB5c3Lf2rl3DFYasyFEgBnEMrkPK3EqgHqIwXYntsJ1l4_aFc70rlNPi_D_69xpOOr5Fs0aDwp_oF4BolvbmIjjbsDeuLSptDbakmzWitnpeqxCsp777u0uVajEJdIv08"/>
</div>
</div>
<div class="bg-slate-100/50 dark:bg-slate-800/50 h-[1px] w-full"></div>
</header>
<!-- Sidebar Navigation -->
<aside class="hidden lg:flex flex-col fixed left-0 top-0 py-6 h-screen w-64 border-r border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900 z-40 mt-16">
<div class="px-6 mb-8">
<h2 class="font-headline font-extrabold text-slate-900 dark:text-slate-100">The Ethical Archive</h2>
<p class="text-[10px] uppercase tracking-widest text-slate-400 font-label mt-1">Institutional Portal</p>
</div>
<nav class="space-y-1 px-3 flex-1">
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined text-amber-600">dashboard</span>
<span class="font-label text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined text-amber-600">account_balance</span>
<span class="font-label text-sm font-medium">Associations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined text-amber-600">layers</span>
<span class="font-label text-sm font-medium">Project Ledger</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined text-amber-600">verified_user</span>
<span class="font-label text-sm font-medium">KYC Verification</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined text-amber-600">settings</span>
<span class="font-label text-sm font-medium">System Settings</span>
</a>
</nav>
<div class="px-4 mt-auto">
<button class="w-full bg-primary-container text-white font-headline font-semibold py-3 rounded-xl shadow-lg hover:scale-102 active:scale-98 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">add</span>
                New Project
            </button>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="lg:ml-64 pt-24 pb-12 px-8 min-h-screen">
<div class="max-w-6xl mx-auto">
<!-- Header Section: Profile Branding -->
<section class="mb-12">
<div class="relative h-48 rounded-2xl overflow-hidden mb-[-4rem]">
<img alt="Header Background" class="w-full h-full object-cover" data-alt="Modern architecture interior workspace" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDRNhDSJLz6RAbABbeuBiLBGiw_bkRksf3f7260l9nGTPI9WeDSSAS3b0NYO3av7k28TUZycjdCP6oqfnjxgb0oWbd8qNCYTN6x4vm_LtjAeOnW_lvfTAUFo8i-L1skP6By8jR6Lz3kK1i4Vz82mdfWnXRST3Iffty7nLH748UzfV963NGBhLBwHshQ-4zFNcK4IiAITnQPd2wMssUDbdBDe0lXpgPJYTgptuJBKhLqcNNZgYZLcEE49Qz5ot3C2DYUrHLpY6ghwU"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
</div>
<div class="flex flex-col md:flex-row items-end gap-6 px-8 relative z-10">
<div class="w-32 h-32 rounded-2xl bg-white p-2 shadow-xl">
<img alt="Association Logo" class="w-full h-full object-contain rounded-xl" data-alt="Stylized geometric association logo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8i86sSygjnrsiiQsw3QVVWLwcJoaAwMxK4SqtgnqQb5FuGubLOD6wVDuPJLK_86sekw4yQ4b6Ner2QCRhTlkYljk6adoSJbc763XPqwAz3eyX7Z-ZU7-tm9Il49Nh7br5dXkuSAbpwdyIwEVxQsAKUfYbckVUP7T4CI6MLlEiDD1kCdLJvMrsZVpOookFcYWXq45-U9k4JZmlIT0f4tMtsZJup1RiKmidUjTEhGOp5tFLzK87d9e4uW4q8FfanVIYW8eyAHwG7sk"/>
</div>
<div class="flex-1 pb-2">
<div class="flex items-center gap-3 mb-1">
<h1 class="text-3xl font-headline font-extrabold text-on-surface">Fondation Atlas</h1>
<span class="bg-surface-container-highest text-on-surface-variant px-3 py-1 rounded-full text-xs font-label uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-sm">verified</span>
                                Authentifié
                            </span>
</div>
<p class="text-slate-500 font-body flex items-center gap-2">
<span class="material-symbols-outlined text-sm">location_on</span>
                            Casablanca, Maroc • <span class="text-amber-600 font-semibold">Éducation &amp; Développement</span>
</p>
</div>
<div class="pb-2 flex gap-3">
<button class="px-6 py-2.5 bg-white border border-outline-variant/30 rounded-full font-headline font-semibold text-slate-900 hover:bg-slate-50 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-lg">edit</span>
                            Éditer
                        </button>
<button class="px-6 py-2.5 bg-amber-500 text-white rounded-full font-headline font-semibold shadow-lg shadow-amber-500/20 hover:scale-102 transition-all">
                            Partager le profil
                        </button>
</div>
</div>
</section>
<!-- Grid Layout for Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
<!-- Left Column: Details & KYC -->
<div class="lg:col-span-2 space-y-8">
<!-- Basic Information Card -->
<div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm">
<h3 class="text-xl font-headline font-bold mb-6 flex items-center gap-2">
<span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                            Informations Générales
                        </h3>
<div class="space-y-6">
<div>
<label class="block text-xs font-label uppercase tracking-widest text-slate-400 mb-2">Description de l'Association</label>
<p class="text-on-surface font-body leading-relaxed">
                                    La Fondation Atlas œuvre depuis 2012 pour l'accès à l'éducation dans les zones rurales du Haut Atlas. Nous croyons en la transparence radicale et l'impact mesurable pour chaque dirham investi. Notre mission est d'éradiquer l'analphabétisme par des infrastructures durables et un soutien pédagogique continu.
                                </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
<div class="bg-surface-container-low p-4 rounded-xl">
<label class="block text-[10px] font-label uppercase tracking-widest text-slate-400 mb-1">Catégorie Principale</label>
<p class="font-headline font-semibold text-primary-container">Éducation et Formation</p>
</div>
<div class="bg-surface-container-low p-4 rounded-xl">
<label class="block text-[10px] font-label uppercase tracking-widest text-slate-400 mb-1">Siège Social</label>
<p class="font-headline font-semibold text-primary-container">22 Rue Al-Moutanabi, Casablanca</p>
</div>
</div>
</div>
</div>
<!-- KYC Verification Section -->
<div class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm border-l-4 border-amber-500">
<div class="flex items-start justify-between mb-8">
<div>
<h3 class="text-xl font-headline font-bold mb-1">Vérification KYC</h3>
<p class="text-sm text-slate-500 font-body italic">Conformité aux protocoles de transparence Al-Khair</p>
</div>
<span class="bg-secondary-container text-on-secondary-container px-4 py-1.5 rounded-full text-xs font-bold font-label flex items-center gap-2">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">pending</span>
                                EN ATTENTE DE VALIDATION
                            </span>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
<div class="space-y-4">
<div class="flex items-center gap-4 group cursor-pointer">
<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
<span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600">picture_as_pdf</span>
</div>
<div>
<p class="text-sm font-semibold">Statuts_Fondation_Atlas.pdf</p>
<p class="text-xs text-slate-400">Mis à jour le 12 Mars 2024</p>
</div>
</div>
<div class="flex items-center gap-4 group cursor-pointer">
<div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
<span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600">badge</span>
</div>
<div>
<p class="text-sm font-semibold">Registre_Commerce_J22.jpg</p>
<p class="text-xs text-slate-400">Mis à jour le 12 Mars 2024</p>
</div>
</div>
</div>
<div class="border-2 border-dashed border-outline-variant/40 rounded-2xl p-8 flex flex-col items-center justify-center text-center bg-surface-container-low/50 hover:bg-white hover:border-amber-500/50 transition-all group">
<span class="material-symbols-outlined text-3xl text-slate-300 group-hover:text-amber-500 mb-2">cloud_upload</span>
<p class="text-sm font-semibold text-slate-600">Déposer un nouveau document</p>
<p class="text-[10px] text-slate-400 mt-1 uppercase tracking-tighter">PDF ou JPG (max. 10MB)</p>
</div>
</div>
</div>
<!-- Projects Grid -->
<div class="space-y-6">
<div class="flex items-center justify-between">
<h3 class="text-xl font-headline font-bold">Projets Actifs</h3>
<button class="text-amber-600 text-sm font-semibold font-label hover:underline">Voir tout l'historique</button>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Project Card 1 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
<div class="h-40 relative">
<img alt="Projet Education" class="w-full h-full object-cover" data-alt="Children in a rural classroom setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJ3_iVoMkSy3T9MxL_GUfCWbfYy0cS3NxPkl5MeJIwXN-MUcHcwHUSXM-g-s99Oc4fzfGzVeC9b8nQkcUZLqzBypm6QKv3VRgmaxUvRCAXBZk5eM_H0e_91BtOrQibnuTHc3WDxly5q913G5V-rVDb6JdJFpPEIUiSzmVoBfiusiWyuLydG99C9dvGdJaQPUojqmtzBPJDHvOltc1Ufg_9-SJTSotYA08nscllTu7qK9MT_g2LZ2zLEbmkvswWh-3zFcbEX0rPyKE"/>
<div class="absolute top-3 right-3 bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded">ACTIF</div>
</div>
<div class="p-5">
<h4 class="font-headline font-bold text-lg mb-2 leading-tight">École Rurale Oukaimeden</h4>
<div class="mb-4">
<div class="flex justify-between text-[10px] font-label mb-1">
<span class="text-slate-400">OBJECTIF: 150 000 DH</span>
<span class="text-amber-600 font-bold">85%</span>
</div>
<div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-amber-600 to-secondary-container w-[85%]"></div>
</div>
</div>
<button class="w-full py-2 bg-slate-50 text-slate-900 text-xs font-bold rounded-lg border border-slate-100 hover:bg-slate-100 transition-colors">Détails du Ledger</button>
</div>
</div>
<!-- Project Card 2 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
<div class="h-40 relative">
<img alt="Projet Orphelinat" class="w-full h-full object-cover" data-alt="Community outreach event with diverse people" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDwYXmq5Gdc35VBmesDPTYJBRrUusMa8ZdBc7izVpTwnvt25NofUofZbn1gmqOTxRNJ8yPEwveGT6rZeC6wuamJ8M4iwGXmOb_LLexvYoplHzPj7YzINmv0-dCYFMLHFHBlBfdnygW99ROAhvHJWdj331qN8mnXqMm0w_QVh1d6Qm46we-WhQPmH6seO6Rm1j7ujg_F5UGN0NxyqjLW5PMp3g58BWRS8IhuS4zB9wJPFxMKYvFXwCdHrAXPieypcOz0fdLlZQPoZPU"/>
<div class="absolute top-3 right-3 bg-tertiary-container text-on-tertiary-container text-[10px] font-bold px-2 py-1 rounded">URGENT</div>
</div>
<div class="p-5">
<h4 class="font-headline font-bold text-lg mb-2 leading-tight">Cantine Scolaire Solidaire</h4>
<div class="mb-4">
<div class="flex justify-between text-[10px] font-label mb-1">
<span class="text-slate-400">OBJECTIF: 45 000 DH</span>
<span class="text-amber-600 font-bold">12%</span>
</div>
<div class="h-1.5 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-amber-600 to-secondary-container w-[12%]"></div>
</div>
</div>
<button class="w-full py-2 bg-slate-50 text-slate-900 text-xs font-bold rounded-lg border border-slate-100 hover:bg-slate-100 transition-colors">Détails du Ledger</button>
</div>
</div>
</div>
</div>
</div>
<!-- Right Column: Stats & Meta -->
<div class="space-y-8">
<!-- Impact Score Card -->
<div class="bg-primary-container text-white rounded-2xl p-8 relative overflow-hidden">
<div class="relative z-10">
<label class="block text-[10px] font-label uppercase tracking-widest opacity-60 mb-1">Score de Transparence</label>
<div class="flex items-baseline gap-2 mb-6">
<span class="text-5xl font-headline font-extrabold">9.8</span>
<span class="text-amber-500 font-bold">/10</span>
</div>
<div class="space-y-4">
<div class="flex items-center justify-between text-xs">
<span class="opacity-70">Donations Reçues</span>
<span class="font-bold">1.2M DH</span>
</div>
<div class="flex items-center justify-between text-xs">
<span class="opacity-70">Vérifications Blockchain</span>
<span class="font-bold">452</span>
</div>
<div class="flex items-center justify-between text-xs">
<span class="opacity-70">Projets Complétés</span>
<span class="font-bold">14</span>
</div>
</div>
</div>
<!-- Abstract Background Decoration -->
<div class="absolute -right-4 -bottom-4 w-32 h-32 bg-amber-500/20 rounded-full blur-3xl"></div>
<div class="absolute -left-4 top-0 w-24 h-24 bg-white/5 rounded-full blur-2xl"></div>
</div>
<!-- KYC Status Detailed Info -->
<div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm">
<h4 class="font-headline font-bold text-sm mb-4">Prochaine Étape KYC</h4>
<div class="flex gap-4 mb-6">
<div class="w-1 bg-amber-500 rounded-full"></div>
<div>
<p class="text-sm font-semibold">Validation de l'identité</p>
<p class="text-xs text-slate-500 leading-relaxed">Le comité de conformité examine actuellement vos statuts. Délai estimé : <span class="font-bold">48h</span>.</p>
</div>
</div>
<button class="w-full py-3 bg-surface-container-low text-on-surface text-xs font-bold rounded-xl hover:bg-surface-container-high transition-colors flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm">support_agent</span>
                            Contacter le support KYC
                        </button>
</div>
<!-- Map/Location Card -->
<div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm">
<div class="h-48 relative">
<img alt="Location Map" class="w-full h-full object-cover" data-location="Casablanca" src="https://lh3.googleusercontent.com/aida-public/AB6AXuChPinPJon5USi24tYoEM5BOtVWRYE4iqfKcoRiw0g7iZJlioouCZ7_TaSgO7EFLGrtqAfczXVLS1Nj9X4QeMIPtor-cTdxRw3do-RE2mSNvT1yDCgi4qJnX93rY50gS2EVdzyel7B_Q6cKrcTHMjWpiHLPBapCd_mf0gPScaoRxVDR6NKQ9RsWzO-Z0UfkyqjidxZcw0-Bx7ZSdoZdp24an2s2VZ7pui61jFgEJpXpmBtlQPcxJNJ-rTK8msLgGC-K7EGOKkdgeBY"/>
<div class="absolute inset-0 bg-slate-900/10 pointer-events-none"></div>
</div>
<div class="p-4">
<p class="text-xs font-label uppercase tracking-widest text-slate-400 mb-1">Région d'Impact</p>
<p class="font-bold text-primary-container">Grand Casablanca &amp; Haut Atlas</p>
</div>
</div>
</div>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full py-8 border-t border-slate-100 dark:border-slate-900 bg-slate-50 dark:bg-slate-950 lg:ml-64 w-auto">
<div class="flex flex-col items-center justify-center space-y-4 max-w-screen-xl mx-auto px-8">
<div class="flex gap-8">
<a class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-label text-xs tracking-wide uppercase underline underline-offset-4 transition-all" href="#">Transparency Report</a>
<a class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-label text-xs tracking-wide uppercase underline underline-offset-4 transition-all" href="#">Privacy Protocol</a>
<a class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 font-label text-xs tracking-wide uppercase underline underline-offset-4 transition-all" href="#">Terms of Service</a>
</div>
<p class="text-slate-400 dark:text-slate-500 font-label text-xs tracking-wide uppercase text-center">
                © 2024 Al-Khair Humanitarian Institution. All records secured via The Ethical Archive.
            </p>
</div>
</footer>
</body></html>