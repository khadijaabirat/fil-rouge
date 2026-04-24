<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "secondary-fixed": "#ffdea8",
              "on-tertiary-fixed": "#370e00",
              "outline-variant": "#c4c6ce",
              "surface-container-low": "#f2f4f6",
              "surface-bright": "#f8f9fb",
              "on-tertiary-fixed-variant": "#7f2b00",
              "on-primary": "#ffffff",
              "tertiary-container": "#370e00",
              "secondary-fixed-dim": "#ffba20",
              "surface-variant": "#e0e3e5",
              "surface-container-highest": "#e0e3e5",
              "on-primary-container": "#6f85a3",
              "primary-fixed-dim": "#b1c8e9",
              "on-tertiary": "#ffffff",
              "surface-tint": "#4a607c",
              "on-secondary-fixed-variant": "#5e4200",
              "inverse-on-surface": "#eff1f3",
              "on-primary-fixed": "#021c36",
              "inverse-primary": "#b1c8e9",
              "secondary": "#7c5800",
              "primary-container": "#021c36",
              "primary": "#000000",
              "inverse-surface": "#2d3133",
              "surface": "#f8f9fb",
              "tertiary-fixed-dim": "#ffb599",
              "on-secondary-container": "#6b4b00",
              "outline": "#74777e",
              "surface-container-lowest": "#ffffff",
              "error-container": "#ffdad6",
              "surface-dim": "#d8dadc",
              "primary-fixed": "#d2e4ff",
              "on-surface-variant": "#43474d",
              "on-background": "#191c1e",
              "on-surface": "#191c1e",
              "on-secondary": "#ffffff",
              "background": "#f8f9fb",
              "error": "#ba1a1a",
              "surface-container": "#eceef0",
              "tertiary": "#000000",
              "secondary-container": "#feb700",
              "tertiary-fixed": "#ffdbce",
              "on-error-container": "#93000a",
              "on-error": "#ffffff",
              "on-secondary-fixed": "#271900",
              "on-primary-fixed-variant": "#324863",
              "surface-container-high": "#e6e8ea",
              "on-tertiary-container": "#e05814"
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
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-surface font-body text-on-surface antialiased">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-md flex justify-between items-center px-6 h-16 w-full shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container overflow-hidden">
<img class="w-full h-full object-cover" data-alt="User profile photo avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyN1ah51gEs8OvfHvm2V4XL7ZQD_mt1VXcQSBOMI5k4lbULX0s0XSKtbjDG-aNP4_Gy-M0m5Pmeo9V2oWuByr4ba7DYzW-CDE1spb2zmsRBQnibJC6FuDSDEwZL6LoMqbthzasG3dcX0ErhB5A3zckzp0qR9FevdjZ8PPYBrL5Vtx2SKmSw0h1rEVQxn-NNHKMleQTPtAXSAP9ZrZ0YGetZQRpsUvg4Ynm2R_GSKlnKyh9tvf140uKNr4b6eX9zerZ-7IKZRRBf_s"/>
</div>
<h1 class="font-manrope font-extrabold text-xl text-slate-900 dark:text-white uppercase tracking-wider">Al-Khair</h1>
</div>
<button class="text-slate-500 hover:opacity-80 transition-opacity">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
</header>
<main class="pt-20 pb-28 px-6 max-w-md mx-auto">
<!-- Profile Identity -->
<section class="mt-8 mb-10 text-center">
<div class="inline-block relative">
<div class="w-28 h-28 rounded-full p-1 bg-gradient-to-tr from-secondary to-secondary-container shadow-xl">
<img class="w-full h-full object-cover rounded-full border-4 border-white" data-alt="Detailed user profile portrait" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCTfBAJTLhxNVAdkdLz2Hw4xsy6UfYX6Pj-5xad5klC0kTovjIRco9Rd29LMdsSYWiaVnN5Bpg7Q00EQsIO0MpQsney8yr8s6gnEvFhTJjOedSt3KzYzHUFJ9DdOPo1HGe0gDuDzpBMn_f9CYBcdHul74bgfwHc131gRqrLsh1IqgTJpPHPpLvv8knEf2ZJP3nceQZye6-Cz5Y9toxHibkG-_kdlMg5NHwPfERZG5XrL09E__mmPWkm8u6t4oV3dTfTOb7aQKouzo"/>
</div>
<button class="absolute bottom-0 right-0 bg-primary-container text-white p-2 rounded-full shadow-lg border-2 border-white active:scale-95 transition-transform">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
</button>
</div>
<h2 class="mt-6 font-headline font-extrabold text-2xl text-on-surface">Omar El-Fassi</h2>
<p class="text-on-surface-variant font-medium text-sm mt-1">Donateur Engagé depuis 2021</p>
<button class="mt-6 px-8 py-2.5 bg-surface-container-low text-primary-fixed-dim font-bold rounded-full text-sm border border-outline-variant/20 shadow-sm active:scale-95 transition-all">
                Modifier le profil
            </button>
</section>
<!-- Impact Bento Grid -->
<section class="grid grid-cols-2 gap-4 mb-10">
<div class="col-span-2 bg-primary-container rounded-xl p-6 relative overflow-hidden text-white shadow-lg">
<div class="relative z-10">
<p class="font-label text-xs uppercase tracking-[0.1em] opacity-80">Montant total</p>
<h3 class="font-headline font-extrabold text-4xl mt-2">12 450€</h3>
<p class="text-xs mt-4 flex items-center gap-1 font-medium bg-white/10 w-fit px-2 py-1 rounded-full">
<span class="material-symbols-outlined text-xs" data-icon="trending_up">trending_up</span>
                        Top 5% des donateurs
                    </p>
</div>
<div class="absolute -right-8 -bottom-8 opacity-10">
<span class="material-symbols-outlined text-[140px]" data-icon="volunteer_activism">volunteer_activism</span>
</div>
</div>
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-outline-variant/10">
<div class="w-10 h-10 rounded-lg bg-secondary-container/20 flex items-center justify-center mb-3">
<span class="material-symbols-outlined text-secondary" data-icon="favorite">favorite</span>
</div>
<p class="font-label text-[10px] uppercase tracking-wider text-on-surface-variant">Nombre de dons</p>
<h4 class="font-headline font-bold text-2xl mt-1">42</h4>
</div>
<div class="bg-surface-container-lowest rounded-xl p-5 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-outline-variant/10">
<div class="w-10 h-10 rounded-lg bg-on-tertiary-container/10 flex items-center justify-center mb-3">
<span class="material-symbols-outlined text-on-tertiary-container" data-icon="folder_special">folder_special</span>
</div>
<p class="font-label text-[10px] uppercase tracking-wider text-on-surface-variant">Projets soutenus</p>
<h4 class="font-headline font-bold text-2xl mt-1">18</h4>
</div>
</section>
<!-- Recent Activity / History -->
<section class="space-y-6">
<div class="flex justify-between items-end">
<h3 class="font-headline font-bold text-xl">Historique des dons</h3>
<button class="text-secondary font-bold text-xs uppercase tracking-widest">Voir tout</button>
</div>
<div class="space-y-4">
<!-- Donation Item -->
<div class="bg-surface-container-lowest p-4 rounded-xl flex items-center gap-4 shadow-sm border border-outline-variant/5">
<div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-primary-container" data-icon="water_drop">water_drop</span>
</div>
<div class="flex-grow">
<h5 class="font-bold text-sm">Puits en zone rurale</h5>
<p class="text-xs text-on-surface-variant">14 Oct. 2023 • Validé</p>
</div>
<div class="text-right">
<p class="font-bold text-secondary">250€</p>
</div>
</div>
<!-- Donation Item -->
<div class="bg-surface-container-lowest p-4 rounded-xl flex items-center gap-4 shadow-sm border border-outline-variant/5">
<div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-primary-container" data-icon="school">school</span>
</div>
<div class="flex-grow">
<h5 class="font-bold text-sm">Bourses scolaires</h5>
<p class="text-xs text-on-surface-variant">02 Sep. 2023 • Validé</p>
</div>
<div class="text-right">
<p class="font-bold text-secondary">500€</p>
</div>
</div>
<!-- Donation Item -->
<div class="bg-surface-container-lowest p-4 rounded-xl flex items-center gap-4 shadow-sm border border-outline-variant/5 opacity-80">
<div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-primary-container" data-icon="restaurant">restaurant</span>
</div>
<div class="flex-grow">
<h5 class="font-bold text-sm">Colis alimentaires</h5>
<p class="text-xs text-on-surface-variant">28 Juil. 2023 • Validé</p>
</div>
<div class="text-right">
<p class="font-bold text-secondary">120€</p>
</div>
</div>
</div>
</section>
<!-- Badge / Reward Section -->
<section class="mt-12 bg-surface-container-high/30 p-6 rounded-2xl border border-dashed border-outline-variant/50 text-center">
<div class="flex justify-center -space-x-3 mb-4">
<div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center border-2 border-white shadow-md">
<span class="material-symbols-outlined text-xs text-white" data-icon="verified" data-weight="fill">verified</span>
</div>
<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center border-2 border-white shadow-md">
<span class="material-symbols-outlined text-xs text-white" data-icon="auto_awesome" data-weight="fill">auto_awesome</span>
</div>
<div class="w-10 h-10 rounded-full bg-on-tertiary-container flex items-center justify-center border-2 border-white shadow-md">
<span class="material-symbols-outlined text-xs text-white" data-icon="workspace_premium" data-weight="fill">workspace_premium</span>
</div>
</div>
<h4 class="font-headline font-bold text-sm">Donateur Platine</h4>
<p class="text-xs text-on-surface-variant mt-2 px-4">Plus que 2 dons pour débloquer le badge "Mécène Humanitaire"</p>
</section>
</main>
<!-- BottomNavBar -->
<nav class="fixed bottom-0 left-0 w-full h-20 bg-white dark:bg-slate-900 flex justify-around items-center px-4 pb-4 z-50 rounded-t-2xl shadow-[0_-4px_20px_rgba(0,0,0,0.05)] border-t border-slate-100 dark:border-slate-800">
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 opacity-70 hover:text-amber-700 transition-all active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-inter text-[10px] font-semibold uppercase tracking-[0.05rem]">Accueil</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 opacity-70 hover:text-amber-700 transition-all active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="leaderboard">leaderboard</span>
<span class="font-inter text-[10px] font-semibold uppercase tracking-[0.05rem]">Impact</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500 opacity-70 hover:text-amber-700 transition-all active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
<span class="font-inter text-[10px] font-semibold uppercase tracking-[0.05rem]">Dons</span>
</a>
<a class="flex flex-col items-center justify-center text-amber-600 dark:text-amber-500 font-bold scale-110 transition-all active:scale-90" href="#">
<span class="material-symbols-outlined" data-icon="person" data-weight="fill">person</span>
<span class="font-inter text-[10px] font-semibold uppercase tracking-[0.05rem]">Profil</span>
</a>
</nav>
</body></html> 