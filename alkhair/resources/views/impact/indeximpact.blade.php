<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "surface-dim": "#d8dadc",
              "inverse-surface": "#2d3133",
              "secondary": "#7c5800",
              "on-surface": "#191c1e",
              "secondary-container": "#feb700",
              "on-tertiary-fixed-variant": "#7f2b00",
              "on-tertiary-container": "#e05814",
              "on-primary": "#ffffff",
              "primary": "#000000",
              "inverse-on-surface": "#eff1f3",
              "on-secondary-fixed-variant": "#5e4200",
              "surface-container-lowest": "#ffffff",
              "on-primary-fixed-variant": "#324863",
              "inverse-primary": "#b1c8e9",
              "tertiary-fixed": "#ffdbce",
              "surface-container": "#eceef0",
              "primary-fixed-dim": "#b1c8e9",
              "secondary-fixed": "#ffdea8",
              "surface-tint": "#4a607c",
              "surface": "#f8f9fb",
              "on-secondary-fixed": "#271900",
              "error-container": "#ffdad6",
              "primary-container": "#021c36",
              "error": "#ba1a1a",
              "on-primary-fixed": "#021c36",
              "surface-container-high": "#e6e8ea",
              "on-background": "#191c1e",
              "surface-container-low": "#f2f4f6",
              "primary-fixed": "#d2e4ff",
              "outline-variant": "#c4c6ce",
              "on-error-container": "#93000a",
              "tertiary": "#000000",
              "on-tertiary-fixed": "#370e00",
              "on-tertiary": "#ffffff",
              "on-secondary": "#ffffff",
              "tertiary-container": "#370e00",
              "on-primary-container": "#6f85a3",
              "surface-variant": "#e0e3e5",
              "background": "#f8f9fb",
              "tertiary-fixed-dim": "#ffb599",
              "secondary-fixed-dim": "#ffba20",
              "outline": "#74777e",
              "surface-bright": "#f8f9fb",
              "surface-container-highest": "#e0e3e5",
              "on-error": "#ffffff",
              "on-surface-variant": "#43474d",
              "on-secondary-container": "#6b4b00"
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
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }
        .glass-header {
            background: rgba(0, 26, 51, 0.95);
            backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- Top Navigation Bar (Shared Component) -->
<nav class="fixed top-0 w-full z-50 glass-header no-border bg-opacity-95 backdrop-blur-md shadow-xl shadow-blue-900/20 h-20 px-8 flex justify-between items-center max-w-none">
<div class="flex items-center gap-12">
<span class="text-2xl font-bold tracking-tighter text-white uppercase font-headline">Al-Khair</span>
<div class="hidden md:flex gap-8 items-center font-headline antialiased text-sm font-medium tracking-tight">
<a class="text-slate-300 hover:text-white transition-colors hover:scale-105 transition-transform duration-200" href="#">Programs</a>
<a class="text-amber-500 border-b-2 border-amber-500 pb-1 hover:scale-105 transition-transform duration-200" href="#">Impact</a>
<a class="text-slate-300 hover:text-white transition-colors hover:scale-105 transition-transform duration-200" href="#">Transparency</a>
<a class="text-slate-300 hover:text-white transition-colors hover:scale-105 transition-transform duration-200" href="#">About</a>
</div>
</div>
<div class="flex items-center gap-6">
<div class="hidden lg:block relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
<input class="bg-slate-800/50 border-none rounded-full py-2 pl-10 pr-4 text-sm text-white focus:ring-2 focus:ring-secondary w-64" placeholder="Rechercher un rapport..." type="text"/>
</div>
<button class="bg-secondary-container text-on-secondary-container px-6 py-2.5 rounded-full font-bold text-sm uppercase tracking-wider hover:scale-105 transition-transform duration-200 shadow-lg shadow-amber-900/20">
                Donate Now
            </button>
</div>
</nav>
<!-- Side Navigation (Shared Component) -->
<aside class="h-screen w-72 fixed left-0 top-20 bg-slate-50 border-r-0 flex flex-col gap-2 p-6 z-40 hidden xl:flex">
<div class="mb-8 px-3">
<p class="font-headline text-xs font-bold uppercase tracking-widest text-slate-400">Admin Portal</p>
<p class="text-[10px] text-slate-500 uppercase tracking-tighter">Institutional Access</p>
</div>
<div class="space-y-1">
<a class="flex items-center gap-3 text-slate-500 p-3 hover:bg-slate-200 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-headline text-xs font-semibold uppercase tracking-widest">Dashboard</span>
</a>
<a class="flex items-center gap-3 bg-white text-primary-container rounded-lg p-3 shadow-sm hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined">diversity_3</span>
<span class="font-headline text-xs font-semibold uppercase tracking-widest">Donor Relations</span>
</a>
<a class="flex items-center gap-3 text-slate-500 p-3 hover:bg-slate-200 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined">account_balance_wallet</span>
<span class="font-headline text-xs font-semibold uppercase tracking-widest">Grant Management</span>
</a>
<a class="flex items-center gap-3 text-slate-500 p-3 hover:bg-slate-200 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined">description</span>
<span class="font-headline text-xs font-semibold uppercase tracking-widest">Field Reports</span>
</a>
<a class="flex items-center gap-3 text-slate-500 p-3 hover:bg-slate-200 rounded-lg hover:translate-x-1 transition-transform duration-200" href="#">
<span class="material-symbols-outlined">payments</span>
<span class="font-headline text-xs font-semibold uppercase tracking-widest">Financials</span>
</a>
</div>
<div class="mt-auto space-y-4 pt-6 border-t border-slate-200">
<button class="w-full bg-primary-container text-white p-3 rounded-lg font-headline text-[10px] font-bold uppercase tracking-[0.2em] shadow-lg shadow-blue-900/20">
                Generate Report
            </button>
<div class="flex flex-col gap-1">
<a class="flex items-center gap-3 text-slate-400 p-2 text-xs" href="#">
<span class="material-symbols-outlined text-sm">help_outline</span>
                    Support
                </a>
<a class="flex items-center gap-3 text-slate-400 p-2 text-xs" href="#">
<span class="material-symbols-outlined text-sm">logout</span>
                    Logout
                </a>
</div>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="xl:ml-72 pt-20">
<!-- Hero Section -->
<section class="relative min-h-[614px] flex items-center px-8 lg:px-20 py-24 overflow-hidden bg-primary-container">
<div class="absolute inset-0 z-0 opacity-40">
<img class="w-full h-full object-cover" data-alt="Snow covered Moroccan mountains in Azilal region" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8pBbUjFz2zGegbBi2M7ZpXLuY74XLRALJ4MQe6aCx7gyoEvd9bDsssBQuefKtkWUsRNl-hLZG4MAOg8PuP6tn3L1vHG3thTkyiIAiJBuFwvhVGox7hneHlLRSw9xV5G8GnOa88py35bjAgSTgQMPcYU8NIIWe7UIhzrI5-JPOdg4FAFJUl_-Mw1jTlHwhhU1igPs01Dg0ZduVlN6OaQ9EQCqyB7ZzAvyK5XYXWuY5clwlUtN0Gr4UkF5w0Ld3m1uekLSkgrfsE9Y"/>
<div class="absolute inset-0 bg-gradient-to-r from-primary-container via-primary-container/80 to-transparent"></div>
</div>
<div class="relative z-10 max-w-4xl">
<div class="inline-flex items-center gap-2 bg-secondary/20 border border-secondary/30 text-secondary-container px-4 py-1.5 rounded-full mb-8 backdrop-blur-md">
<span class="material-symbols-outlined text-sm">verified</span>
<span class="font-label text-xs font-bold uppercase tracking-widest">Rapport Validé</span>
</div>
<h1 class="font-headline text-5xl md:text-7xl font-extrabold text-white leading-tight mb-6">
                    Rapport d'Impact : <br/>
<span class="text-secondary-container underline decoration-amber-500/30 decoration-8 underline-offset-8">Aide Hivernale (Azilal)</span>
</h1>
<p class="text-slate-300 text-xl max-w-2xl font-body leading-relaxed mb-10">
                    Une intervention d'urgence déployée dans les sommets du Haut Atlas pour protéger les familles isolées contre les vagues de froid extrêmes de 2024.
                </p>
<div class="flex flex-wrap gap-8">
<div class="flex flex-col">
<span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-1">Date de Distribution</span>
<span class="text-white font-headline text-lg font-bold">Nov 30, 2024</span>
</div>
<div class="w-px h-12 bg-white/10 hidden sm:block"></div>
<div class="flex flex-col">
<span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-1">Localisation</span>
<span class="text-white font-headline text-lg font-bold">Azilal, Maroc</span>
</div>
</div>
</div>
</section>
<!-- Impact Metrics Bento -->
<section class="px-8 lg:px-20 -mt-16 relative z-20 pb-24">
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
<!-- Main KPI -->
<div class="md:col-span-2 lg:col-span-2 bg-surface-container-lowest p-8 rounded-xl shadow-2xl shadow-blue-900/5 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-6">
<h3 class="font-headline text-sm font-bold uppercase tracking-widest text-primary-container">Total des Fonds Utilisés</h3>
<span class="material-symbols-outlined text-secondary text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
</div>
<div class="flex items-baseline gap-2">
<span class="text-5xl font-extrabold text-primary-container font-headline">142,500</span>
<span class="text-2xl font-bold text-slate-400 uppercase">MAD</span>
</div>
</div>
<div class="mt-8 space-y-3">
<div class="flex justify-between font-label text-[10px] uppercase font-bold tracking-wider">
<span class="text-slate-500">Execution de l'objectif</span>
<span class="text-secondary">100%</span>
</div>
<div class="w-full h-2 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container w-full"></div>
</div>
</div>
</div>
<!-- Beneficiaries -->
<div class="bg-primary-container p-8 rounded-xl shadow-xl flex flex-col justify-center text-center">
<span class="font-label text-[10px] text-slate-400 uppercase tracking-widest mb-4">Familles Soutenues</span>
<span class="text-6xl font-extrabold text-white font-headline mb-2">450+</span>
<span class="text-secondary-container text-xs font-bold">Impact direct</span>
</div>
<!-- Winter Kits -->
<div class="bg-surface-container-low p-8 rounded-xl shadow-sm flex flex-col justify-center">
<div class="flex items-center gap-4 mb-4">
<div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center text-primary-container">
<span class="material-symbols-outlined">ac_unit</span>
</div>
<span class="font-headline text-sm font-bold uppercase tracking-tight text-primary-container leading-tight">Kits d'Hiver<br/>Distribués</span>
</div>
<span class="text-4xl font-extrabold text-primary-container font-headline">1,800</span>
<p class="text-slate-500 text-xs mt-2 font-medium">Couvertures &amp; denrées</p>
</div>
</div>
</section>
<!-- Project Success Description -->
<section class="px-8 lg:px-20 pb-24 grid lg:grid-cols-12 gap-16">
<div class="lg:col-span-7">
<h2 class="font-headline text-3xl font-extrabold text-primary-container mb-8">Un succès logistique au cœur de l'Atlas</h2>
<div class="space-y-6 text-on-surface-variant font-body leading-relaxed text-lg">
<p>
                        L'opération <strong>"Aide Hivernale Azilal 2024"</strong> s'est achevée avec un succès sans précédent. Malgré des conditions météorologiques difficiles et des routes d'accès partiellement obstruées, nos équipes locales ont réussi à atteindre les douars les plus reculés de la province.
                    </p>
<p>
                        L'intervention a consisté en la distribution de kits de survie complets, comprenant des couvertures de haute densité thermique, des denrées alimentaires non périssables et du combustible pour le chauffage. Cette transparence totale dans l'allocation des ressources a permis d'optimiser chaque centime de vos dons.
                    </p>
<div class="bg-surface-container-low p-6 rounded-lg border-l-4 border-secondary mt-10 italic text-primary-container">
                        "Nous n'avons pas seulement apporté de l'aide matérielle, nous avons apporté la preuve que ces familles ne sont pas oubliées. Vos dons ont sauvé des vies lors du pic de gel de fin novembre."
                    </div>
</div>
</div>
<div class="lg:col-span-5">
<div class="bg-surface-container-lowest p-8 rounded-xl shadow-xl shadow-blue-900/5 sticky top-28">
<h3 class="font-headline text-xl font-bold text-primary-container mb-6">Répartition Budgétaire</h3>
<div class="space-y-6">
<div class="flex items-center gap-4">
<div class="w-2 h-12 bg-secondary rounded-full"></div>
<div class="flex-1">
<div class="flex justify-between mb-1">
<span class="text-sm font-bold text-primary-container">Produits Alimentaires</span>
<span class="text-sm font-bold text-slate-500">45%</span>
</div>
<div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-secondary w-[45%]"></div>
</div>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-2 h-12 bg-secondary-container rounded-full"></div>
<div class="flex-1">
<div class="flex justify-between mb-1">
<span class="text-sm font-bold text-primary-container">Équipement Thermique</span>
<span class="text-sm font-bold text-slate-500">35%</span>
</div>
<div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-secondary-container w-[35%]"></div>
</div>
</div>
</div>
<div class="flex items-center gap-4">
<div class="w-2 h-12 bg-on-tertiary-container rounded-full"></div>
<div class="flex-1">
<div class="flex justify-between mb-1">
<span class="text-sm font-bold text-primary-container">Logistique &amp; Transport</span>
<span class="text-sm font-bold text-slate-500">20%</span>
</div>
<div class="w-full h-1.5 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-on-tertiary-container w-[20%]"></div>
</div>
</div>
</div>
</div>
<button class="w-full mt-10 py-4 bg-primary-container text-white rounded-lg font-headline text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm">download</span>
                        Télécharger le rapport détaillé (PDF)
                    </button>
</div>
</div>
</section>
<!-- Visual Proofs (Masonry-like) -->
<section class="bg-surface-container-low px-8 lg:px-20 py-24">
<div class="flex justify-between items-end mb-12">
<div>
<span class="font-label text-xs font-bold uppercase tracking-[0.2em] text-secondary">Transparence Totale</span>
<h2 class="font-headline text-3xl font-extrabold text-primary-container mt-2">Preuves Visuelles du Terrain</h2>
</div>
<div class="flex gap-2">
<button class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-primary-container shadow-sm hover:bg-slate-50 transition-colors">
<span class="material-symbols-outlined">arrow_back</span>
</button>
<button class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-primary-container shadow-sm hover:bg-slate-50 transition-colors">
<span class="material-symbols-outlined">arrow_forward</span>
</button>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-[700px]">
<div class="md:col-span-2 md:row-span-2 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Truck being loaded with food aid kits in Morocco" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpGb-UWkrR3mj70Vh22U4Jjb3i7Wu8LiJNZn1XoDDileLovTXzMQE16Kee4BZNhrea16qCOxs2pY1Q8Kv6R95SXAljuINzhR9eTrnFb5adxEOYdstzZKj13-hGon2LKPIaW7ATOuKBeJKhE_ZR5SbxabwoK9FXVMMCJK_eOadQNzHJSJu6ipRTzVpStK11mqyRQAOvwejkANchlXzgAcCwqialtAy4jEZELF9HILWchlynG0XerkJG9Yv7RJpQZLiydk16dUpRf8k"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
<p class="text-white font-bold">Chargement des convois</p>
<p class="text-slate-300 text-xs">Centre logistique Al-Khair</p>
</div>
<div class="absolute top-4 left-4 bg-secondary text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
<span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                        Vidéo
                    </div>
</div>
<div class="md:col-span-1 md:row-span-1 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Volunteer handing a heavy blanket to an elderly man" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDB4ypWUPg2S6h35uoaxmvtOrJ99Hb9EpIfQa9-TLN65DCEK-f-9F6nGq3DAuFcY8bb8XZUV93gRt0nRfQ9geZwN5L_5YPv7fPX34SHLtDH-cjcv4A23hFei9-UQzWxdNUI-MH21soluTd4azLV46CCCLUEdlq2i1V8HLsJxcdOi-h3ZrUSEb9XCgpsxG2VQO0D9aTw60UrAvdErH7jV9Y0_Ix7MAndoSC9SYEBwoyWZlh6zKaNlQF7isLDhpzUqgtqrWBUkkDurNI"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
<p class="text-white font-bold text-sm">Remise directe</p>
</div>
</div>
<div class="md:col-span-1 md:row-span-1 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Local community gathered for aid distribution" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8-WUEgvZj6edrQ20iSCnGxy0bjM-PHhmm0d7-p61qsrK0kWPYcDJ2ctK-Jvx1DCSbRrcaxafcEgIfIOzpahko1BAa8V_IDVwG-SuimtSMRMiAUISamtNJGZPsdrJ771DWkngXU6AsKc2Pu0Z9vaPN71u4nHRWIQmM0ufUbJDpYpi9rXsMESUztK3Sw_SZlkqm6E5LV68o6PGipPRlHZ7Fy52pyMKMghFfJVNNcmpS3g3-oOAg9F1wMTXG7gPlp8vJYo7cNKhjyvQ"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
<p class="text-white font-bold text-sm">Douar Ait-Oumdis</p>
</div>
</div>
<div class="md:col-span-2 md:row-span-1 relative rounded-xl overflow-hidden group">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Boxes of aid neatly stacked in a mountain village square" src="https://lh3.googleusercontent.com/aida-public/AB6AXuANmcu0bm-EoD2Nq0XrseTX4wSL3RycgPQlVJ8Pgg4WhlJ8ZavlkuRnUyIFGZ705Ddx5C4GAAAPth41VG9laPSYFwiwWM2jpGZcVU4N_pKLbmlbk-aAxtrslsRM8h2sH7PPx-pnQxh_d3ERUt6o8mbNIfFaeFQGrTw_VOQvRmqi97E8RBr87FleF1ZQ5-spGpuiEemkJwQhKZYyLcPaLn6NwgLLOzePg9eROdqdWfeepz-5AT5DfL7T7ouFcsHbh0FdTdPO_R5cVBg"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-6 flex flex-col justify-end">
<p class="text-white font-bold">Organisation logistique</p>
</div>
</div>
</div>
</section>
<!-- Certificates & Compliance -->
<section class="px-8 lg:px-20 py-24">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-16">
<h2 class="font-headline text-3xl font-extrabold text-primary-container">Certificats de Conformité</h2>
<p class="text-slate-500 mt-4 max-w-2xl mx-auto">Chaque étape de notre processus est auditée par des tiers indépendants pour garantir une transparence institutionnelle totale.</p>
</div>
<div class="grid md:grid-cols-3 gap-8">
<!-- Certificate 1 -->
<div class="border border-surface-container-high rounded-xl p-6 flex flex-col items-center text-center hover:border-secondary transition-colors group">
<div class="w-20 h-24 bg-surface-container-low rounded-lg flex items-center justify-center mb-6 group-hover:bg-secondary-container/10 transition-colors">
<span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-secondary transition-colors">description</span>
</div>
<h4 class="font-headline text-sm font-bold text-primary-container mb-2">Audit Financier Azilal '24</h4>
<p class="text-xs text-slate-400 mb-6">Certifié par Bureau Veritas</p>
<a class="text-secondary font-label text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:underline" href="#">
                            Voir Document
                            <span class="material-symbols-outlined text-xs">open_in_new</span>
</a>
</div>
<!-- Certificate 2 -->
<div class="border border-surface-container-high rounded-xl p-6 flex flex-col items-center text-center hover:border-secondary transition-colors group">
<div class="w-20 h-24 bg-surface-container-low rounded-lg flex items-center justify-center mb-6 group-hover:bg-secondary-container/10 transition-colors">
<span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-secondary transition-colors">verified_user</span>
</div>
<h4 class="font-headline text-sm font-bold text-primary-container mb-2">Attestation d'Impact Local</h4>
<p class="text-xs text-slate-400 mb-6">Signé par les autorités régionales</p>
<a class="text-secondary font-label text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:underline" href="#">
                            Voir Document
                            <span class="material-symbols-outlined text-xs">open_in_new</span>
</a>
</div>
<!-- Certificate 3 -->
<div class="border border-surface-container-high rounded-xl p-6 flex flex-col items-center text-center hover:border-secondary transition-colors group">
<div class="w-20 h-24 bg-surface-container-low rounded-lg flex items-center justify-center mb-6 group-hover:bg-secondary-container/10 transition-colors">
<span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-secondary transition-colors">fact_check</span>
</div>
<h4 class="font-headline text-sm font-bold text-primary-container mb-2">Rapport d'Audit Interne</h4>
<p class="text-xs text-slate-400 mb-6">Standard Ethical Archive</p>
<a class="text-secondary font-label text-[10px] font-bold uppercase tracking-widest flex items-center gap-1 hover:underline" href="#">
                            Voir Document
                            <span class="material-symbols-outlined text-xs">open_in_new</span>
</a>
</div>
</div>
</div>
</section>
<!-- Donor Gratitude List -->
<section class="bg-primary-container text-white py-24 px-8 lg:px-20 overflow-hidden relative">
<div class="absolute -right-20 -bottom-20 w-96 h-96 bg-secondary/10 rounded-full blur-3xl"></div>
<div class="absolute -left-20 -top-20 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
<div class="max-w-4xl mx-auto text-center relative z-10">
<span class="font-label text-xs font-bold uppercase tracking-[0.3em] text-secondary-container mb-4 block">Unité &amp; Générosité</span>
<h2 class="font-headline text-4xl md:text-5xl font-extrabold mb-12">Merci à nos Donateurs</h2>
<div class="grid grid-cols-2 md:grid-cols-4 gap-y-10 gap-x-8 text-left border-y border-white/10 py-16">
<div>
<p class="text-slate-400 font-label text-[10px] uppercase tracking-widest mb-4">Fondations</p>
<ul class="space-y-3 font-headline text-sm font-medium">
<li>Fondation OCP</li>
<li>Attijari Trust</li>
<li>Atlas Initiatives</li>
</ul>
</div>
<div>
<p class="text-slate-400 font-label text-[10px] uppercase tracking-widest mb-4">Entreprises</p>
<ul class="space-y-3 font-headline text-sm font-medium">
<li>Maroc Telecom</li>
<li>BIM Morocco</li>
<li>Inwi Hope</li>
</ul>
</div>
<div class="col-span-2">
<p class="text-slate-400 font-label text-[10px] uppercase tracking-widest mb-4">Cercle de Bienfaisance Or (Donateurs Privés)</p>
<div class="grid grid-cols-2 gap-3 font-headline text-sm font-medium">
<p>Famille Bennani</p>
<p>S. El Alami</p>
<p>K. Mansouri</p>
<p>M. Tazi</p>
<p>L. Chraibi</p>
<p>J. Amrani</p>
</div>
</div>
</div>
<div class="mt-16 bg-white/5 p-8 rounded-xl backdrop-blur-md border border-white/10">
<p class="text-xl font-body italic text-slate-300 leading-relaxed">
                        "Au nom de toutes les familles d'Azilal, nous exprimons notre gratitude éternelle. Votre confiance est le moteur de notre mission de transparence."
                    </p>
<div class="mt-6 flex items-center justify-center gap-4">
<div class="w-12 h-12 rounded-full border-2 border-secondary overflow-hidden">
<img class="w-full h-full object-cover" data-alt="CEO Portrait of Al-Khair" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3ISbKlPzhKy6zHqR0P_rWpxOMqb0aXyd8YrAEBnF1lFDv8FF3urAeyFqEusIBsDTQAC_FQE3NMYKcJQC-XpheTS7oDTTwFkWzpCvEQxpvfiX2C7v7PK6v9Y4LNNCjc24MTc6_hwl4RBGrr_cjCH1PqJolbJlsxhe8fftMXdGum2aoT3rz2c2wtJzr4l5iYL67Z52XXzNxo7cFYFYYDd62qFMdC6PH9MSG5QFaFFZ8cvFuGz9yiPjry11WwLIFuvKXufWiPkWSkgk"/>
</div>
<div class="text-left">
<p class="font-headline font-bold text-white text-sm">Directeur Général</p>
<p class="text-slate-400 text-xs uppercase tracking-widest font-label">Fondation Al-Khair</p>
</div>
</div>
</div>
</div>
</section>
<!-- Footer -->
<footer class="bg-surface py-12 px-8 lg:px-20 border-t border-surface-container">
<div class="flex flex-col md:flex-row justify-between items-center gap-8">
<span class="text-xl font-bold tracking-tighter text-primary-container uppercase font-headline">Al-Khair</span>
<div class="flex gap-8 text-xs font-label uppercase tracking-widest font-bold text-slate-400">
<a class="hover:text-primary-container transition-colors" href="#">Confidentialité</a>
<a class="hover:text-primary-container transition-colors" href="#">Termes</a>
<a class="hover:text-primary-container transition-colors" href="#">Contact</a>
</div>
<p class="text-[10px] text-slate-400 font-label uppercase tracking-widest">© 2024 Al-Khair Foundation. All rights reserved.</p>
</div>
</footer>
</main>
<!-- FAB for Donation (Suppressed on Impact page as per mandate, but user might want interaction for quick report navigation) -->
<!-- Suppression logic applied: Focused task page (Report) hides global FAB to avoid distraction from content -->
</body></html>