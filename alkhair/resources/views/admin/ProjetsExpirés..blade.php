<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Al-Khair | Gestion des Projets Expirés</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
      .glass-effect {
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
      }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
<!-- TopAppBar -->
<header class="bg-white/80 backdrop-blur-lg fixed top-0 w-full z-50 shadow-sm">
<div class="flex items-center justify-between px-8 h-16 max-w-screen-2xl mx-auto">
<div class="flex items-center gap-8">
<span class="text-xl font-bold text-slate-950 tracking-tighter font-headline">Al-Khair</span>
<nav class="hidden md:flex items-center gap-6 font-headline font-semibold tracking-tight">
<a class="text-slate-500 hover:text-slate-800 transition-colors" href="#">Associations</a>
<a class="text-slate-900 border-b-2 border-amber-500 pb-1" href="#">Projects</a>
<a class="text-slate-500 hover:text-slate-800 transition-colors" href="#">KYC Hub</a>
<a class="text-slate-500 hover:text-slate-800 transition-colors" href="#">Analytics</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="pl-10 pr-4 py-2 bg-surface-container-low border-none rounded-full text-sm focus:ring-2 focus:ring-secondary-container w-64" placeholder="Rechercher un projet..." type="text"/>
</div>
<button class="p-2 hover:bg-slate-50 rounded-full transition-all">
<span class="material-symbols-outlined text-slate-600">settings</span>
</button>
<img alt="Association Administrator Profile" class="w-8 h-8 rounded-full object-cover ring-2 ring-surface-container" data-alt="Professional portrait of a middle-aged male administrator" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuU5HELDVbf9-Yh0VPbex-58RkuvDrzUep6E9oKsx3k4udNvREk8xp9Wk0bv1J4I1olKut8jQIXk60boz5pnSsnYnxsRJJZdZHdXhdi1UfgKqnnMDt01UKPDPYcsRaKZILc5XFPPsOLTMF9dHCRp4ZExfkUol7cOM3_TXdTTkmaqcdTlaafj66uT-C7CpCDkNCOVm7tyhfeEm8X3Yp_PxPo9ahCCXyWvsajlehi2ODnOVlozykmGfDVPZVhn6vFXxCLDJxKzaN1rM"/>
</div>
</div>
</header>
<!-- SideNavBar -->
<aside class="hidden lg:flex flex-col fixed left-0 top-0 py-6 h-screen w-64 border-r border-slate-200 bg-slate-50 z-40">
<div class="px-6 mb-8 mt-16">
<h2 class="font-headline font-extrabold text-slate-900">The Ethical Archive</h2>
<p class="text-[10px] uppercase tracking-widest text-slate-500 font-label">Institutional Portal</p>
</div>
<nav class="space-y-1 px-3 flex-1">
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-medium text-sm">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">account_balance</span>
<span class="font-medium text-sm">Associations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 bg-white text-slate-900 shadow-sm rounded-lg" href="#">
<span class="material-symbols-outlined text-amber-600">layers</span>
<span class="font-medium text-sm">Project Ledger</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">verified_user</span>
<span class="font-medium text-sm">KYC Verification</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 text-slate-600 hover:bg-slate-100 rounded-lg transition-transform duration-200 hover:translate-x-1" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-medium text-sm">System Settings</span>
</a>
</nav>
<div class="px-4 mt-auto">
<button class="w-full py-3 bg-primary-container text-white rounded-xl font-semibold flex items-center justify-center gap-2 hover:scale-[1.02] active:scale-[0.98] transition-transform">
<span class="material-symbols-outlined">add</span>
                New Project
            </button>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="lg:ml-64 pt-24 pb-20 px-8 min-h-screen">
<div class="max-w-6xl mx-auto">
<!-- Hero Section / Header -->
<div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="max-w-2xl">
<span class="text-secondary font-label text-xs font-bold tracking-[0.15em] uppercase mb-3 block">Portail de l'Association</span>
<h1 class="text-4xl md:text-5xl font-headline font-extrabold text-primary-container leading-tight">Gestion des Projets Expirés</h1>
<p class="mt-4 text-on-surface-variant text-lg leading-relaxed">
                        Ces projets ont atteint leur date limite sans atteindre l'objectif financier initial. Veuillez décider de la marche à suivre pour chaque initiative.
                    </p>
</div>
<div class="flex items-center gap-3 bg-surface-container-low p-4 rounded-2xl border border-outline-variant/20">
<span class="material-symbols-outlined text-amber-600 text-3xl">hourglass_empty</span>
<div>
<p class="text-2xl font-bold font-headline">04</p>
<p class="text-xs font-label uppercase text-on-surface-variant">Projets en attente</p>
</div>
</div>
</div>
<!-- Transparency Warning Banner -->
<div class="mb-10 p-6 bg-tertiary-container/5 border-l-4 border-on-tertiary-container rounded-r-xl flex items-start gap-4">
<span class="material-symbols-outlined text-on-tertiary-container mt-1" style="font-variation-settings: 'FILL' 1;">warning</span>
<div class="space-y-2">
<h3 class="font-headline font-bold text-on-tertiary-container">Protocole de Transparence &amp; Rapports d'Impact</h3>
<p class="text-sm text-on-surface-variant leading-relaxed">
                        Conformément à la charte Al-Khair, toute décision de <strong>Clôture et Transfert</strong> des fonds engagera l'association à fournir un <strong>Rapport d'Impact</strong> détaillé. Même si l'objectif total n'est pas atteint, les donateurs doivent être informés de l'utilisation exacte de leurs contributions partielles.
                    </p>
</div>
</div>
<!-- Asymmetric Grid of Expired Projects -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
<!-- Project Card 1 -->
<div class="group bg-surface-container-lowest rounded-3xl overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-xl transition-all duration-300 border border-outline-variant/10">
<div class="md:w-2/5 relative h-48 md:h-auto overflow-hidden">
<img alt="Puits d'eau potable" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Traditional water well in a rural village setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKTRt9FHTKIIG0YVMWJy0cqgeUmV0i5p3AVPQDFTPL1cLBcX6cuWo8HwpJZ-UFOYDrMs-Ql6VmK_K9s0JzQfEpCF05bS5Enpba94LDHFayleFKkaJ1dzGHcHpRnByxiEN75ybXbAadXwAuwVJCa3DuCYQPjuKuv4sdW3VxXeXYT8X_XEtVC8OBWbsVtHvRKwZxgyTXZaFZDHN9KfdCV1D4kR4UDTME8PXtIkfx9IjR9t0NxpCsxwDskNDIVtkj3u3X-uMSVPcLvBw"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
<span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Expiré le 12/10</span>
</div>
</div>
<div class="md:w-3/5 p-6 flex flex-col justify-between">
<div>
<h3 class="font-headline font-bold text-xl text-primary-container mb-2">Puits Communautaire Atlas</h3>
<p class="text-xs text-on-surface-variant mb-4 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">location_on</span> Province d'Al Haouz, Maroc
                            </p>
<div class="space-y-2 mb-6">
<div class="flex justify-between text-xs font-label">
<span class="font-semibold text-primary">4 250 € collectés</span>
<span class="text-on-surface-variant">Objectif : 8 000 €</span>
</div>
<div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container" style="width: 53%"></div>
</div>
<p class="text-[10px] text-on-surface-variant text-right italic">53% de l'objectif atteint</p>
</div>
</div>
<div class="flex flex-col gap-2">
<button class="w-full py-2.5 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-transform">
                                Prolonger le délai
                            </button>
<button class="w-full py-2.5 border border-outline text-primary-container rounded-lg font-bold text-sm hover:bg-surface-container-low transition-colors">
                                Clôturer et Transférer
                            </button>
</div>
</div>
</div>
<!-- Project Card 2 -->
<div class="group bg-surface-container-lowest rounded-3xl overflow-hidden flex flex-col md:flex-row shadow-sm hover:shadow-xl transition-all duration-300 border border-outline-variant/10">
<div class="md:w-2/5 relative h-48 md:h-auto overflow-hidden">
<img alt="Distribution alimentaire" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Community food distribution program with volunteers" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDFdnhTejvhQDwIE25zwSD1qhXk5f1MxQhmNLdd3mNZYMDieK9Q2OwXQBUDttYKP5GessoqhvWzOU8A0t7i6f0KPbSWdS4jLt1rClVIy7RPDbjSDbpdLhSTP-T6FjTsN-5QW4BrwSGrYiaPKkxGF4xZD1X5oBE6PBl9zshu_wmRgxbL_nLEu1NbeTGbVYmVi-nwYXp1MVz6BTAkbynAcfwySVyXZwrW01UexU6aPaDdAIrOgSPyWPOevw_LaujzzqY5-hS0_mhKoFc"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
<span class="bg-amber-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider">Expiré le 05/10</span>
</div>
</div>
<div class="md:w-3/5 p-6 flex flex-col justify-between">
<div>
<h3 class="font-headline font-bold text-xl text-primary-container mb-2">Paniers Hiver Solidaire</h3>
<p class="text-xs text-on-surface-variant mb-4 flex items-center gap-1">
<span class="material-symbols-outlined text-[14px]">location_on</span> Casablanca &amp; Périphérie
                            </p>
<div class="space-y-2 mb-6">
<div class="flex justify-between text-xs font-label">
<span class="font-semibold text-primary">12 800 € collectés</span>
<span class="text-on-surface-variant">Objectif : 15 000 €</span>
</div>
<div class="h-2 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container" style="width: 85%"></div>
</div>
<p class="text-[10px] text-on-surface-variant text-right italic">85% de l'objectif atteint</p>
</div>
</div>
<div class="flex flex-col gap-2">
<button class="w-full py-2.5 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-sm hover:scale-[1.02] active:scale-[0.98] transition-transform">
                                Prolonger le délai
                            </button>
<button class="w-full py-2.5 border border-outline text-primary-container rounded-lg font-bold text-sm hover:bg-surface-container-low transition-colors">
                                Clôturer et Transférer
                            </button>
</div>
</div>
</div>
<!-- Project Card 3 (Bento Style Variation) -->
<div class="group bg-surface-container-lowest rounded-3xl overflow-hidden flex flex-col shadow-sm hover:shadow-xl transition-all duration-300 border border-outline-variant/10 xl:col-span-2">
<div class="flex flex-col md:flex-row">
<div class="md:w-1/3 relative h-64 md:h-auto overflow-hidden">
<img alt="Équipement scolaire" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Classroom with colorful school supplies and desks" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDV_oTECi8C81TbiSGgbGiSY4cY5QmO3LQFEvrCX8inxGarxznh6xnxRjq5IbOZihZvA13J3Oc41Xi7a9L3Nh0IFBu1vYeIcBcZB20OY3Ta7_vU7WlywKFvakKzXZZB_VUfldOMweYXb4fKejonj2JU8DB1v7CzMf_EhTlisFp22WKptiq_IEtLHlqMV9cH_pEZJ9dN9K3QgWFyqyEXiPtuoYvD7Fl0Ac0AlEVDXM6pljnXTpJRgjBI6QEHCRhkgs5c1cQbgA0SlAQ"/>
<div class="absolute inset-4 top-auto">
<span class="bg-amber-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">Expiré il y a 2 jours</span>
</div>
</div>
<div class="md:w-2/3 p-8 flex flex-col justify-between">
<div class="grid md:grid-cols-2 gap-8">
<div>
<h3 class="font-headline font-bold text-2xl text-primary-container mb-3">École Numérique rurale</h3>
<p class="text-sm text-on-surface-variant leading-relaxed mb-6">
                                        Projet d'équipement de 5 salles de classe avec des tablettes et connexion satellite. L'objectif n'a pas été atteint, rendant l'achat en gros impossible au tarif initial.
                                    </p>
<div class="flex items-center gap-4 text-xs font-label text-on-surface-variant uppercase tracking-tighter">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                            Démarré le 01/08
                                        </div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined text-[18px]">groups</span>
                                            142 Donateurs
                                        </div>
</div>
</div>
<div class="bg-surface p-6 rounded-2xl flex flex-col justify-center">
<div class="flex justify-between items-end mb-2">
<span class="text-3xl font-headline font-extrabold text-primary">3 100 €</span>
<span class="text-sm text-on-surface-variant font-label">Sur 10 000 €</span>
</div>
<div class="h-3 bg-surface-container-high rounded-full overflow-hidden mb-3">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container" style="width: 31%"></div>
</div>
<p class="text-xs text-on-tertiary-container font-semibold flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">info</span>
                                        Nécessite une décision prioritaire
                                    </p>
</div>
</div>
<div class="mt-8 flex flex-col sm:flex-row gap-4">
<button class="flex-1 py-4 bg-secondary-container text-on-secondary-container rounded-xl font-bold hover:scale-[1.02] active:scale-[0.98] transition-transform flex items-center justify-center gap-2">
<span class="material-symbols-outlined">update</span>
                                    Prolonger le délai (30 jours max)
                                </button>
<button class="flex-1 py-4 border-2 border-primary-container text-primary-container rounded-xl font-bold hover:bg-primary-container hover:text-white transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined">swap_horiz</span>
                                    Clôturer et Transférer vers Fonds Éducation
                                </button>
</div>
</div>
</div>
</div>
</div>
<!-- Empty State / Footer Call to Action -->
<div class="mt-20 pt-12 border-t border-slate-100 text-center">
<p class="text-on-surface-variant font-medium">Vous avez traité tous vos projets ?</p>
<button class="mt-4 text-secondary font-bold hover:underline underline-offset-8 transition-all">
                    Retourner au Tableau de Bord
                </button>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full py-8 border-t border-slate-100 bg-slate-50">
<div class="flex flex-col items-center justify-center space-y-4 max-w-screen-2xl mx-auto px-8">
<div class="flex gap-8">
<a class="text-slate-400 hover:text-slate-600 font-label text-xs tracking-wide uppercase transition-all underline underline-offset-4" href="#">Transparency Report</a>
<a class="text-slate-400 hover:text-slate-600 font-label text-xs tracking-wide uppercase transition-all underline underline-offset-4" href="#">Privacy Protocol</a>
<a class="text-slate-400 hover:text-slate-600 font-label text-xs tracking-wide uppercase transition-all underline underline-offset-4" href="#">Terms of Service</a>
</div>
<p class="text-slate-400 font-label text-[10px] tracking-wide uppercase text-center">
                © 2024 Al-Khair Humanitarian Institution. All records secured via The Ethical Archive.
            </p>
</div>
</footer>
</body></html>