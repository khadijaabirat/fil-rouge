<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Al-Khair Admin - Gestion des Utilisateurs</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "on-primary-container": "#6f85a3",
              "surface-container-high": "#e6e8ea",
              "tertiary-fixed-dim": "#ffb599",
              "surface-container": "#eceef0",
              "on-secondary-fixed": "#271900",
              "secondary-container": "#feb700",
              "inverse-surface": "#2d3133",
              "on-background": "#191c1e",
              "on-tertiary-fixed": "#370e00",
              "on-surface-variant": "#43474d",
              "surface-tint": "#4a607c",
              "on-tertiary-container": "#e05814",
              "on-secondary": "#ffffff",
              "tertiary-fixed": "#ffdbce",
              "surface-bright": "#f8f9fb",
              "on-tertiary": "#ffffff",
              "surface-container-highest": "#e0e3e5",
              "surface-variant": "#e0e3e5",
              "inverse-on-surface": "#eff1f3",
              "primary-fixed": "#d2e4ff",
              "surface": "#f8f9fb",
              "secondary": "#7c5800",
              "secondary-fixed-dim": "#ffba20",
              "on-tertiary-fixed-variant": "#7f2b00",
              "error-container": "#ffdad6",
              "tertiary-container": "#370e00",
              "on-primary": "#ffffff",
              "primary-fixed-dim": "#b1c8e9",
              "primary-container": "#021c36",
              "on-surface": "#191c1e",
              "surface-container-low": "#f2f4f6",
              "outline-variant": "#c4c6ce",
              "on-secondary-container": "#6b4b00",
              "on-primary-fixed": "#021c36",
              "primary": "#000000",
              "background": "#f8f9fb",
              "on-primary-fixed-variant": "#324863",
              "inverse-primary": "#b1c8e9",
              "surface-dim": "#d8dadc",
              "on-error-container": "#93000a",
              "on-error": "#ffffff",
              "secondary-fixed": "#ffdea8",
              "tertiary": "#000000",
              "outline": "#74777e",
              "surface-container-lowest": "#ffffff",
              "on-secondary-fixed-variant": "#5e4200",
              "error": "#ba1a1a"
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
            vertical-align: middle;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex">
<!-- SideNavBar (Authority: JSON & Design System) -->
<aside class="fixed left-0 top-0 h-full w-64 border-r-0 bg-[#001A33] dark:bg-black shadow-2xl flex flex-col py-6 z-50">
<div class="px-6 mb-10">
<h1 class="text-white font-bold text-2xl tracking-tight">Al-Khair</h1>
<p class="text-slate-400 text-xs font-['Inter'] mt-1">Portail Admin</p>
</div>
<nav class="space-y-2 px-4 flex-grow">
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined transition-transform duration-200 group-active:scale-95" data-icon="dashboard">dashboard</span>
<span class="font-['Manrope'] font-medium text-sm">Tableau de bord</span>
</a>
<!-- ACTIVE TAB: Utilisateurs -->
<a class="flex items-center gap-3 px-4 py-3 bg-white/10 text-white rounded-lg border-l-4 border-[#feb700] transition-transform duration-200 ease-in-out" href="#">
<span class="material-symbols-outlined" data-icon="group">group</span>
<span class="font-['Manrope'] font-medium text-sm">Utilisateurs</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
<span class="font-['Manrope'] font-medium text-sm">Campagnes</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined" data-icon="analytics">analytics</span>
<span class="font-['Manrope'] font-medium text-sm">Rapports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined" data-icon="settings_accessibility">settings_accessibility</span>
<span class="font-['Manrope'] font-medium text-sm">Paramètres</span>
</a>
</nav>
<div class="mt-auto px-4 space-y-2">
<button class="w-full bg-secondary-container text-on-secondary-fixed py-3 px-4 rounded-lg font-bold text-sm mb-6 flex items-center justify-center gap-2 hover:scale-[1.02] active:scale-95 transition-all">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
                Nouvel Utilisateur
            </button>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
<span class="font-['Manrope'] font-medium text-sm">Aide</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:text-white transition-all hover:bg-white/5 rounded-lg group" href="#">
<span class="material-symbols-outlined" data-icon="logout">logout</span>
<span class="font-['Manrope'] font-medium text-sm">Déconnexion</span>
</a>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="flex-1 ml-64 min-h-screen relative flex flex-col">
<!-- TopAppBar (Authority: JSON) -->
<header class="w-full sticky top-0 z-40 bg-slate-50/80 dark:bg-slate-950/80 backdrop-blur-md shadow-sm dark:shadow-none flex justify-between items-center px-6 py-3 w-full">
<div class="flex items-center gap-4">
<div class="relative">
<span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 material-symbols-outlined" data-icon="search">search</span>
<input class="bg-surface-container-low border-none rounded-full pl-10 pr-4 py-1.5 text-sm w-64 focus:ring-2 focus:ring-secondary-container transition-all" placeholder="Rechercher..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors duration-200 active:scale-95">
<span class="material-symbols-outlined text-slate-600" data-icon="notifications">notifications</span>
</button>
<button class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-900 transition-colors duration-200 active:scale-95">
<span class="material-symbols-outlined text-slate-600" data-icon="settings">settings</span>
</button>
<div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 mx-2"></div>
<div class="flex items-center gap-3">
<img class="w-8 h-8 rounded-full object-cover" data-alt="Admin profile photo showing male face" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbfMjTxe6poP2eVqOyidIKv8WO7WDCSTyQO3XhY5fzLG8WFHCzwckO3BVxZkTUPPkqYLrFM4ZI11bPXnRlEUvPtjt3h2aNgQX4ckgmkAmZA8OUOlhg-y8wEf417Vhu6FQ0wwKuIryoBo--pu-QQ4BYZeLGg9TKyl4UP0qlEinfm1iHAOuXvWKqlKcOUHxIX3ALtpsHGWEQtiQkuQR_LCoc25CkZba4iOjZ7tyte-uEG_RYZlWWjfLFKAxzmajn1cefvuKmVncRn2s"/>
<span class="font-['Inter'] text-sm tracking-tight font-semibold text-slate-900">Admin</span>
</div>
</div>
</header>
<!-- Editorial Content Section -->
<div class="px-10 py-12 max-w-7xl mx-auto w-full flex-grow">
<!-- Header Group -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
<div class="max-w-xl">
<h2 class="text-4xl font-extrabold tracking-tighter text-primary mb-4 leading-none">Gestion des Utilisateurs</h2>
<p class="text-on-surface-variant leading-relaxed">Supervisez et modérez la communauté Al-Khair. Validez les nouvelles associations et gérez les droits d'accès des donateurs.</p>
</div>
<div class="flex gap-2">
<span class="bg-surface-container-highest px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-on-surface-variant flex items-center gap-2">
<span class="w-2 h-2 rounded-full bg-green-500"></span>
                        1,284 Actifs
                    </span>
</div>
</div>
<!-- Filter Bento Bar -->
<div class="bg-surface-container-low p-1.5 rounded-xl mb-8 flex flex-wrap items-center gap-2 shadow-sm">
<button class="px-6 py-2.5 rounded-lg bg-surface-container-lowest shadow-sm text-sm font-bold text-primary transition-all">Tous</button>
<button class="px-6 py-2.5 rounded-lg hover:bg-white/50 text-sm font-medium text-on-surface-variant transition-all">Donateurs</button>
<button class="px-6 py-2.5 rounded-lg hover:bg-white/50 text-sm font-medium text-on-surface-variant transition-all">Associations</button>
<button class="px-6 py-2.5 rounded-lg hover:bg-white/50 text-sm font-medium text-on-surface-variant transition-all flex items-center gap-2">
                    En attente
                    <span class="bg-tertiary-container text-on-tertiary-container px-2 py-0.5 rounded text-[10px]">12</span>
</button>
</div>
<!-- Users Data Table (Institutional Style) -->
<div class="bg-surface-container-lowest rounded-2xl shadow-[0_32px_64px_-12px_rgba(25,28,30,0.06)] overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low/50">
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter']">Utilisateur</th>
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter']">Email</th>
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter']">Rôle</th>
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter']">Statut</th>
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter']">Date d'inscription</th>
<th class="px-6 py-5 text-xs font-bold uppercase tracking-widest text-on-surface-variant/70 font-['Inter'] text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-surface-container">
<!-- User Row 1 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200">
<img class="w-full h-full object-cover" data-alt="Portrait of a user with glasses" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBBVDwypc7Du9StsRkvcDjMQQjx9WoedLtqa5o3U6zd-UdVVOrRep5sThHMvGSt7JGpf_Fq1DHuU29NoyNkKCbV99KaytnNvH2Yl8K2SbsLcKamti7mkNb7j33t4ARqBOzGZCGtTuZNNuhY3vUEUt5ort4n3r058vpV44A7Oo9xjLjDjC8fnnlMb0Xk4vHmq2bZlNZF-vlTonjZ-sSjuJlyfaKGmJYwxIB90Lo9LOhEfroLLMsb2U7Erb5cvJpABfedKStUstfmVak"/>
</div>
<span class="font-semibold text-on-surface">Ahmed El Mansouri</span>
</div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">ahmed.mansouri@email.com</td>
<td class="px-6 py-4">
<span class="text-xs font-medium px-2 py-1 bg-surface-container-high rounded-full text-on-surface">Donateur</span>
</td>
<td class="px-6 py-4">
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Actif
                                    </div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">12 Oct 2023</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group" title="Éditer">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors" data-icon="edit">edit</span>
</button>
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group" title="Suspendre">
<span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600 transition-colors" data-icon="block">block</span>
</button>
<button class="p-2 hover:bg-error-container/20 rounded-lg transition-colors group" title="Supprimer">
<span class="material-symbols-outlined text-slate-400 group-hover:text-error transition-colors" data-icon="delete">delete</span>
</button>
</div>
</td>
</tr>
<!-- User Row 2 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200">
<img class="w-full h-full object-cover" data-alt="Portrait of a young woman smiling" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUuxZOAFJA0UhG2SkTtHl5dfn3vZl7csJ6LN1C_qLlkdPOFfSyGXNC1jojEFfjQ70htJ4BnBjhBXZIwFqdYbrf_GCdR0FzGg2eJ_ZugVWDlqqKWj7iK2dfH68xsAH4dt0d0qEo9V_NpVzP1S8boI5aHdszWNH68QEx_q-7I7FcUloDTSklRfUVEsPQMO-3FoC_lTfR_k16ZNRXCX3qMaSpKAxdMewa3DHkVD1zADbbTKLHII5iXoi6Fc4iusbpxm3w_OUuSrdM0zA"/>
</div>
<span class="font-semibold text-on-surface">Association Al-Amal</span>
</div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">contact@alamal.org</td>
<td class="px-6 py-4">
<span class="text-xs font-medium px-2 py-1 bg-surface-container-high rounded-full text-on-surface">Association</span>
</td>
<td class="px-6 py-4">
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        En attente
                                    </div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">04 Jan 2024</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors" data-icon="edit">edit</span></button>
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600 transition-colors" data-icon="block">block</span></button>
<button class="p-2 hover:bg-error-container/20 rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-error transition-colors" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
<!-- User Row 3 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200">
<img class="w-full h-full object-cover" data-alt="Portrait of a middle aged man" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUg_-UyiOlEJKGWRkXwpTSUxe5V17mSRv-Ckq0vJg-FYTsITVH8MdMuP24ZPww_0EDKlFr99v0kAdg8-Et8VMlNvXba2csWTytkBtemoAq3V6LWzUiyyMK0K-v0zZ2mvtlgZRflkEPTJOogvtqa4tbevBbSTSdVGvMD27IoYSl6UHsde7gm8H8i0p2iOb9HTPRTvdyxivU_XUpF84nidq55fnqMp-GcA3kZ8mRUuACiK8UUFKr-wwaI0wMuYBuc1RlcCP58Njouw8"/>
</div>
<span class="font-semibold text-on-surface">Youssef Bennani</span>
</div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">youssef.b@email.com</td>
<td class="px-6 py-4">
<span class="text-xs font-medium px-2 py-1 bg-surface-container-high rounded-full text-on-surface">Donateur</span>
</td>
<td class="px-6 py-4">
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Suspendu
                                    </div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">22 Sep 2023</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors" data-icon="edit">edit</span></button>
<button class="p-2 bg-amber-100/50 rounded-lg transition-colors group" title="Lever la suspension"><span class="material-symbols-outlined text-amber-600" data-icon="settings_backup_restore">settings_backup_restore</span></button>
<button class="p-2 hover:bg-error-container/20 rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-error transition-colors" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
<!-- User Row 4 -->
<tr class="hover:bg-surface-container-low/30 transition-colors">
<td class="px-6 py-4">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-200">
<img class="w-full h-full object-cover" data-alt="Portrait of a professional woman" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCNovnJ22Do7dDUopUSckxquppsCye6Q5MNuzjgpTvM3vurJQbjiQRQuoawbksm0c8OPHKs8n2Qb5KENLoDdyYYAV-5GnkiB56dCYTjMV41dcMtBhfLRDNXi97ttbZ_z7gnv9326SFRvOsTUp-696o1FGyiKhZz4wYgKcHEUycfbhV2YhpZLdvNbV3-SdScGU37sDXoexfF8rPIe2P2QrBPc0UtAjGF8SK2bX3srq_9VOLayhfPYn58447Ydx9Kdw--W6zTSGlXGC0"/>
</div>
<span class="font-semibold text-on-surface">Karima Drissi</span>
</div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">karima.drissi@cloud.ma</td>
<td class="px-6 py-4">
<span class="text-xs font-medium px-2 py-1 bg-surface-container-high rounded-full text-on-surface">Donateur</span>
</td>
<td class="px-6 py-4">
<div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold">
<span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Actif
                                    </div>
</td>
<td class="px-6 py-4 text-sm text-on-surface-variant">15 Dec 2023</td>
<td class="px-6 py-4 text-right">
<div class="flex justify-end gap-2">
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors" data-icon="edit">edit</span></button>
<button class="p-2 hover:bg-surface-container rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-amber-600 transition-colors" data-icon="block">block</span></button>
<button class="p-2 hover:bg-error-container/20 rounded-lg transition-colors group"><span class="material-symbols-outlined text-slate-400 group-hover:text-error transition-colors" data-icon="delete">delete</span></button>
</div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Footer -->
<div class="px-6 py-6 bg-surface-container-low/30 flex items-center justify-between border-t border-surface-container">
<span class="text-sm text-on-surface-variant font-medium">Affichage de 1-4 sur 1,284 utilisateurs</span>
<div class="flex items-center gap-1">
<button class="p-2 rounded-lg hover:bg-surface-container transition-colors disabled:opacity-30" disabled="">
<span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
</button>
<button class="w-8 h-8 rounded-lg bg-primary text-white text-sm font-bold shadow-md">1</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-sm font-medium transition-colors">2</button>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-sm font-medium transition-colors">3</button>
<span class="px-2 text-on-surface-variant">...</span>
<button class="w-8 h-8 rounded-lg hover:bg-surface-container text-sm font-medium transition-colors">42</button>
<button class="p-2 rounded-lg hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
</div>
<!-- Footer Shadow Separation Logic -->
<footer class="mt-auto py-8 px-10 bg-surface-container-low border-t border-transparent text-center">
<p class="text-xs text-on-surface-variant/60 font-medium tracking-widest uppercase">© 2024 Al-Khair Administrative Portal — Ethical Archive System</p>
</footer>
</main>
</body></html>