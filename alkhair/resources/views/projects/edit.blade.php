<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 min-h-screen flex justify-center items-center">

    <div class="max-w-3xl w-full bg-white p-8 rounded-2xl shadow-lg border-t-4 border-blue-500">

        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Modifier le projet</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-blue-600 font-medium transition flex items-center gap-1">
                &larr; Retour au Dashboard
            </a>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-md mb-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-800 font-bold">Politique de transparence AL-KHAIR</p>
                    <p class="text-sm text-blue-700 mt-1">
                        Pour des raisons de sécurité et de confiance envers vos donateurs, l'objectif financier <strong>({{ $project->goalAmount }} DH)</strong> et la catégorie ne peuvent plus être modifiés après la publication. Vous pouvez uniquement mettre à jour le contenu de la campagne.
                    </p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-md mb-6 border border-red-200">
                <ul class="list-disc pl-5 font-medium text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Titre du projet <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">
            </div>

            <div class="mb-6">
                <label for="videoUrl" class="block text-gray-700 font-bold mb-2">Lien de la vidéo de campagne (Optionnel)</label>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl', $project->videoUrl) }}" placeholder="https://youtube.com/..." class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm text-blue-600">
                <p class="text-xs text-gray-500 mt-2 font-medium">Ajouter une vidéo augmente vos chances de recevoir des dons.</p>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image du Projet (Optionnel)</label>
                @if($project->image)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Image actuelle" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                @endif
                <div class="flex items-center gap-4">
                    <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">
                </div>
                <p class="text-xs text-gray-500 mt-2 font-medium">Formats acceptés: JPG, PNG, WEBP (Max: 5 Mo)</p>
                <div id="imagePreview" class="mt-3 hidden">
                    <p class="text-sm text-gray-600 mb-2">Nouvelle image:</p>
                    <img id="preview" class="w-full h-48 object-cover rounded-lg border border-gray-200" alt="Aperçu">
                </div>
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description détaillée <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="6" required class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex items-center justify-between border-t pt-6">
                <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-gray-800 font-bold px-4 py-2 transition">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Enregistrer les modifications
                </button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
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
              "tertiary-fixed-dim": "#ffb599",
              "on-primary": "#ffffff",
              "on-tertiary-fixed-variant": "#7f2b00",
              "on-secondary-fixed-variant": "#5e4200",
              "surface-container-highest": "#e0e3e5",
              "on-background": "#191c1e",
              "on-error-container": "#93000a",
              "tertiary-fixed": "#ffdbce",
              "on-primary-fixed": "#021c36",
              "outline-variant": "#c4c6ce",
              "on-tertiary": "#ffffff",
              "primary-fixed": "#d2e4ff",
              "on-primary-container": "#6f85a3",
              "surface-dim": "#d8dadc",
              "on-secondary-fixed": "#271900",
              "on-primary-fixed-variant": "#324863",
              "on-tertiary-container": "#e05814",
              "on-secondary": "#ffffff",
              "primary-container": "#021c36",
              "outline": "#74777e",
              "tertiary": "#000000",
              "inverse-primary": "#b1c8e9",
              "background": "#f8f9fb",
              "secondary-fixed": "#ffdea8",
              "secondary-container": "#feb700",
              "surface-tint": "#4a607c",
              "on-surface-variant": "#43474d",
              "error-container": "#ffdad6",
              "surface-container-high": "#e6e8ea",
              "on-tertiary-fixed": "#370e00",
              "surface-container-low": "#f2f4f6",
              "secondary-fixed-dim": "#ffba20",
              "primary-fixed-dim": "#b1c8e9",
              "surface-container": "#eceef0",
              "surface-variant": "#e0e3e5",
              "error": "#ba1a1a",
              "surface-bright": "#f8f9fb",
              "primary": "#000000",
              "on-surface": "#191c1e",
              "surface": "#f8f9fb",
              "surface-container-lowest": "#ffffff",
              "on-secondary-container": "#6b4b00",
              "on-error": "#ffffff",
              "inverse-surface": "#2d3133",
              "tertiary-container": "#370e00",
              "secondary": "#7c5800",
              "inverse-on-surface": "#eff1f3"
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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fb;
        }
        h1, h2, h3, .font-headline {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased">
<!-- Shell Layout -->
<div class="flex min-h-screen">
<!-- SideNavBar Component -->
<aside class="h-screen w-64 fixed left-0 top-0 border-r border-slate-200 bg-slate-50 flex flex-col py-6 z-50">
<div class="px-6 mb-8">
<div class="flex items-center gap-3">
<div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-secondary-container" style="font-variation-settings: 'FILL' 1;">archive</span>
</div>
<div>
<h1 class="font-manrope text-lg font-black text-slate-900 tracking-tight">Al-Khair</h1>
<p class="text-xs text-slate-500 font-medium">Ethical Archive</p>
</div>
</div>
</div>
<nav class="flex-1 space-y-1 px-3">
<a class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all duration-200 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">dashboard</span>
<span class="font-inter font-medium text-sm">Dashboard</span>
</a>
<!-- Active Tab: Projects -->
<a class="flex items-center gap-3 px-3 py-2 bg-white text-amber-600 shadow-sm rounded-lg transition-all duration-200 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">folder_shared</span>
<span class="font-inter font-medium text-sm">Projects</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all duration-200 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">group</span>
<span class="font-inter font-medium text-sm">Donors</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all duration-200 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">analytics</span>
<span class="font-inter font-medium text-sm">Reports</span>
</a>
<a class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all duration-200 cursor-pointer active:opacity-80" href="#">
<span class="material-symbols-outlined text-[20px]">settings</span>
<span class="font-inter font-medium text-sm">Settings</span>
</a>
</nav>
<div class="px-4 mt-auto">
<button class="w-full bg-primary-container text-white rounded-xl py-3 px-4 flex items-center justify-center gap-2 hover:scale-102 transition-transform active:scale-98 shadow-md">
<span class="material-symbols-outlined text-sm">add</span>
<span class="font-inter font-semibold text-sm">Create Project</span>
</button>
</div>
</aside>
<!-- Main Content Area -->
<main class="flex-1 ml-64 min-h-screen">
<!-- TopNavBar Component -->
<header class="w-full sticky top-0 z-40 bg-white/80 backdrop-blur-lg flex items-center justify-between px-8 py-4 border-b border-slate-100 shadow-sm">
<div class="flex items-center gap-4 flex-1">
<div class="relative w-full max-w-md">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
<input class="w-full bg-slate-100 border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-amber-500/20 transition-all" placeholder="Rechercher un projet..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-500 hover:bg-slate-50 rounded-full transition-colors relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-tertiary-container rounded-full"></span>
</button>
<button class="p-2 text-slate-500 hover:bg-slate-50 rounded-full transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="h-8 w-px bg-slate-100 mx-2"></div>
<div class="flex items-center gap-3">
<div class="text-right">
<p class="text-sm font-bold text-slate-900 leading-none">Admin Al-Khair</p>
<p class="text-[10px] font-medium text-slate-500 uppercase tracking-wider mt-1">Directeur</p>
</div>
<img alt="User profile" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm" data-alt="Professional user portrait with dark background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjXLCjHEeBnXLXLmf21GRFT1Z6SAzUbqPf3L5YGm_4Hrc1-Bw5NCYOhRo4jt0pfu8YwBkcfi3DWnomM66gXO4UHqel_p8L137OrUfEkdI9LGGtj_kvMP83M6w_vN02pvENyzGRixBVrFZq9LJFwVU0wQX-YT8u0ga1UE2pTjQ-_vJXYaKJVhrvgvRGa2BTY3g3NTJ2aUFZRzE5l6Y0gdjvd6OtUe1oHjFrhp86iX_ijC4XpuDnoCuKaXY2H81V4aOo16E6BRkewQs"/>
</div>
</div>
</header>
<!-- Dashboard Content -->
<div class="p-8 max-w-7xl mx-auto space-y-10">
<!-- Header Section -->
<div class="flex items-end justify-between">
<div class="space-y-2">
<div class="flex items-center gap-2">
<span class="h-1 w-8 bg-secondary-container rounded-full"></span>
<span class="text-xs font-bold uppercase tracking-[0.1em] text-secondary">Tableau de Bord</span>
</div>
<h2 class="text-4xl font-headline font-extrabold text-primary-container tracking-tight">Mes Projets</h2>
</div>
<button class="group flex items-center gap-3 bg-secondary-container text-on-secondary-container px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all active:scale-95">
<span class="material-symbols-outlined text-xl">add_circle</span>
<span>Nouveau Projet</span>
</button>
</div>
<!-- Projects Table (Bento Grid Inspired Entity Rows) -->
<div class="space-y-4">
<!-- Table Header -->
<div class="grid grid-cols-12 px-6 py-2 text-[10px] font-bold uppercase tracking-widest text-slate-400">
<div class="col-span-4">Nom du Projet</div>
<div class="col-span-2">Catégorie</div>
<div class="col-span-2 text-center">Statut</div>
<div class="col-span-3">Fonds Collectés</div>
<div class="col-span-1 text-right">Actions</div>
</div>
<!-- Project Row 1 -->
<div class="grid grid-cols-12 items-center bg-surface-container-lowest p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition-shadow">
<div class="col-span-4 flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Water well construction in rural village" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5WGpMzMau5DlSSIkwmw_HGg2pTnRr08IJwYuTjrsukhx7UkLT6SGHoYk8kb2ks8RvEoiyeC7RKlh602iBpKuW-ty6eKrzEJIkNneknQHtqAQ3Z0tHUBn89GmvvXDMnKfTbhd8PTMSTJ3ys123BY4eyrN4MVvlkogZcjdDXKl1jSXV79-4iq1GQmwQa66QSyahZPlqpimeUPdrUJ7Zm7_d_owdaMD9eXkuj6qX67DBSgH8vs1Z0xHz2loF2tx1jFCGo32e0s1emu4"/>
</div>
<div>
<h3 class="font-bold text-slate-900">Puits de l'Espoir - Atlas</h3>
<p class="text-xs text-slate-500">ID: #AK-2024-001</p>
</div>
</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Eau &amp; Assainissement</span>
</div>
<div class="col-span-2 flex justify-center">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700">
<span class="w-1 h-1 rounded-full bg-emerald-500 mr-2"></span> Active
                            </span>
</div>
<div class="col-span-3 pr-8">
<div class="flex justify-between text-[11px] font-bold mb-1.5">
<span class="text-slate-900">12 450 €</span>
<span class="text-amber-600">83%</span>
</div>
<div class="w-full h-2 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container rounded-full" style="width: 83%"></div>
</div>
<p class="text-[9px] text-slate-400 mt-1 uppercase font-semibold">Objectif: 15 000 €</p>
</div>
<div class="col-span-1 flex justify-end gap-2">
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-slate-900 transition-colors">
<span class="material-symbols-outlined text-lg">edit</span>
</button>
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-amber-600 transition-colors">
<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">visibility</span>
</button>
</div>
</div>
<!-- Project Row 2 -->
<div class="grid grid-cols-12 items-center bg-surface-container-lowest p-6 rounded-2xl shadow-sm border-l-4 border-slate-300 hover:shadow-md transition-shadow">
<div class="col-span-4 flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Children studying in a bright classroom" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQ4r7w7NLWbuJ7Rzs2bw8-AvsQL4KDclvECraQr7RJdqVGq_eGRQfwEpRdLbjszfBuFdK3gWg3i546wDPJQWi46UiZaLu3Kp9n2VQ0RZvXehpsvCXMGUUlCgQ1q7_gfDT2fMaqZSJDh8bwpld4rm2gy_o9r5-F4KU4eySlTYgKoLq3SLk8Gd27UARdFOeJwZPftdpplfi9_lPBJyqxxE1An-AXQaQTfOMeUL1WPAR-tnf8YhKZCTgZqWBDZdXDa0f5jRnBtNXbdRw"/>
</div>
<div>
<h3 class="font-bold text-slate-900">École Primaire Er-Rachidia</h3>
<p class="text-xs text-slate-500">ID: #AK-2023-089</p>
</div>
</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Éducation</span>
</div>
<div class="col-span-2 flex justify-center">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-500">
<span class="w-1 h-1 rounded-full bg-slate-400 mr-2"></span> Completed
                            </span>
</div>
<div class="col-span-3 pr-8">
<div class="flex justify-between text-[11px] font-bold mb-1.5">
<span class="text-slate-900">45 000 €</span>
<span class="text-emerald-600">100%</span>
</div>
<div class="w-full h-2 bg-emerald-50 rounded-full overflow-hidden">
<div class="h-full bg-emerald-500 rounded-full" style="width: 100%"></div>
</div>
<p class="text-[9px] text-slate-400 mt-1 uppercase font-semibold">Objectif: 45 000 €</p>
</div>
<div class="col-span-1 flex justify-end gap-2">
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-slate-900 transition-colors">
<span class="material-symbols-outlined text-lg">edit</span>
</button>
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-amber-600 transition-colors">
<span class="material-symbols-outlined text-lg">bar_chart_4_bars</span>
</button>
</div>
</div>
<!-- Project Row 3 -->
<div class="grid grid-cols-12 items-center bg-surface-container-lowest p-6 rounded-2xl shadow-sm border-l-4 border-tertiary-container hover:shadow-md transition-shadow">
<div class="col-span-4 flex items-center gap-4">
<div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0">
<img class="w-full h-full object-cover" data-alt="Medical supply boxes in a hospital" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC25no9-NLoAQZF4_D1msw_fuB-RbROe6jbI-RQ3UrY1qLGKbIKtq7BU0vIzqenR9x2k8jr8MUikBy17H_ZkS7ape7ShtH3DhkLkmFTgeg7v3DO-6HpkMqLXZ6xuyzKQ8UxxN7NnpKHY7Y9QU1CrgCLg1nFoQBwwGHfAj5-s-oVp8uFq1RbpiDUXrkosTazMVErTIpcEEGBXac_AWiU65CUMe-eB38gvgyz9k1TslL1FDav-OdDnRCwRqsdBHVMxH6DIpEY0cNwme4"/>
</div>
<div>
<h3 class="font-bold text-slate-900">Urgence Médicale - Rif</h3>
<p class="text-xs text-slate-500">ID: #AK-2023-112</p>
</div>
</div>
<div class="col-span-2">
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Santé</span>
</div>
<div class="col-span-2 flex justify-center">
<span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-orange-50 text-orange-700">
<span class="w-1 h-1 rounded-full bg-orange-500 mr-2"></span> Expired
                            </span>
</div>
<div class="col-span-3 pr-8">
<div class="flex justify-between text-[11px] font-bold mb-1.5">
<span class="text-slate-900">8 200 €</span>
<span class="text-slate-500">41%</span>
</div>
<div class="w-full h-2 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-slate-400 rounded-full" style="width: 41%"></div>
</div>
<p class="text-[9px] text-slate-400 mt-1 uppercase font-semibold">Objectif: 20 000 €</p>
</div>
<div class="col-span-1 flex justify-end gap-2">
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-slate-900 transition-colors">
<span class="material-symbols-outlined text-lg">edit</span>
</button>
<button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-error transition-colors">
<span class="material-symbols-outlined text-lg">delete</span>
</button>
</div>
</div>
</div>
<!-- Footer Summary Card (Asymmetric Bento) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
<div class="md:col-span-2 bg-primary-container p-8 rounded-[2rem] text-white relative overflow-hidden group">
<div class="relative z-10">
<h4 class="text-2xl font-bold mb-2">Impact Total</h4>
<p class="text-primary-fixed/60 max-w-sm mb-6">Grâce à vos 24 projets actifs, vous avez aidé plus de 15,000 personnes cette année.</p>
<div class="flex gap-10">
<div>
<span class="block text-3xl font-black text-secondary-container">258k €</span>
<span class="text-[10px] uppercase font-bold tracking-widest text-primary-fixed/40">Total Collecté</span>
</div>
<div>
<span class="block text-3xl font-black text-secondary-container">12</span>
<span class="text-[10px] uppercase font-bold tracking-widest text-primary-fixed/40">Villes Touchées</span>
</div>
</div>
</div>
<div class="absolute -right-10 -bottom-10 w-64 h-64 bg-secondary-container/10 rounded-full blur-3xl group-hover:bg-secondary-container/20 transition-colors"></div>
</div>
<div class="bg-surface-container-low p-8 rounded-[2rem] flex flex-col justify-between border border-white/40">
<div>
<span class="material-symbols-outlined text-amber-600 text-3xl mb-4">stars</span>
<h4 class="text-lg font-bold text-primary-container">Top Donateur</h4>
<p class="text-sm text-slate-500 mt-1">Fondation Atlas Global</p>
</div>
<div class="mt-6 flex items-center justify-between">
<span class="text-xl font-bold text-slate-900">45 000 €</span>
<span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">+12%</span>
</div>
</div>
</div>
</div>
</main>
</div>
</body></html>