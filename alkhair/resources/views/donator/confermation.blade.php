<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
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
        .bg-mesh-gradient {
            background-color: #f8f9fb;
            background-image: radial-gradient(at 0% 0%, rgba(254, 183, 0, 0.05) 0px, transparent 50%), 
                              radial-gradient(at 100% 0%, rgba(2, 28, 54, 0.05) 0px, transparent 50%);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased min-h-screen">
<main class="flex flex-col lg:flex-row min-h-screen">
<!-- Left Side: Hero Impact Visual -->
<section class="lg:w-1/2 relative min-h-[400px] lg:min-h-screen flex items-center justify-center overflow-hidden">
<img alt="High Atlas Mountains impact" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFrc1ffU2UI50TmTHwRJInOOkWPO4US4P_dDaEDcVsDJbu6YwFg2gacWiSPgr0jPojFN9sqgnrYR4q0TyOlTnDBbZP6F7o_8ul4ry2vu7MOgK38y1tfEA120XhbmWEYuyHTpa2paULiJcpSlz4P_rDvXlMLpc5Bd4XAqWvcXdYJyWCKkYJExO1oCD8irzobnEJ64aiYVNW2iCI8AYlm-1ojutoWpjnmGoWGsuzd1N0TVgmlc4AwC3m3kdOv-OD-pBnMmmf_Bl02K0"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary-container/80 via-primary-container/20 to-transparent"></div>
<div class="relative z-10 text-center px-8 max-w-xl">
<div class="inline-flex items-center justify-center w-20 h-20 mb-8 bg-secondary-container rounded-full shadow-2xl animate-bounce">
<span class="material-symbols-outlined text-4xl text-on-secondary-container" data-icon="favorite" style="font-variation-settings: 'FILL' 1;">favorite</span>
</div>
<h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-white mb-6">
                Merci pour votre générosité
            </h1>
<p class="text-xl text-white/90 leading-relaxed font-medium">
                Votre don est un phare d'espoir pour les communautés du Haut Atlas.
            </p>
</div>
</section>
<!-- Right Side: Content & Details -->
<section class="lg:w-1/2 bg-surface-bright flex flex-col p-8 md:p-12 lg:p-20 overflow-y-auto">
<div class="max-w-xl mx-auto w-full space-y-10">
<!-- Donation Summary Card -->
<div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl shadow-primary-container/5 border border-outline-variant/20">
<div class="flex justify-between items-start mb-10 pb-6 border-b border-surface-container">
<div>
<span class="font-label text-xs font-bold tracking-widest text-secondary uppercase mb-2 block">Donation Receipt</span>
<h2 class="font-headline text-3xl font-bold text-primary-container">Summary</h2>
</div>
<div class="text-right">
<span class="text-on-surface-variant text-xs block uppercase tracking-wider">Date</span>
<span class="font-semibold text-sm">October 24, 2023</span>
</div>
</div>
<div class="space-y-6 mb-10">
<div class="flex items-center justify-between">
<span class="text-on-surface-variant">Amount Contributed</span>
<span class="font-headline text-3xl font-extrabold text-primary-container">500 DH</span>
</div>
<div class="flex items-center justify-between">
<span class="text-on-surface-variant">Project Supported</span>
<span class="font-semibold text-right text-primary-container">Aide hivernale</span>
</div>
</div>
<!-- Impact Timeline (The Ethical Archive) -->
<div class="space-y-6 pt-8 border-t border-surface-container">
<h3 class="font-headline text-lg font-bold text-primary-container flex items-center gap-2 mb-4">
<span class="material-symbols-outlined text-secondary" data-icon="history_edu">history_edu</span>
                        The Ethical Archive
                    </h3>
<div class="space-y-6">
<div class="flex gap-4">
<div class="flex flex-col items-center">
<div class="w-3 h-3 rounded-full bg-secondary border-4 border-secondary-container"></div>
<div class="w-0.5 h-full bg-surface-container-highest"></div>
</div>
<div>
<h4 class="font-bold text-primary-container text-sm">Real-time Deployment</h4>
<p class="text-xs text-on-surface-variant mt-1">Our field teams are notified of funding allocation immediately.</p>
</div>
</div>
<div class="flex gap-4">
<div class="flex flex-col items-center">
<div class="w-3 h-3 rounded-full bg-outline-variant"></div>
<div class="w-0.5 h-full bg-surface-container-highest"></div>
</div>
<div>
<h4 class="font-bold text-primary-container text-sm">Visual Verification</h4>
<p class="text-xs text-on-surface-variant mt-1">Receive GPS-tagged photos from the field as aid is distributed.</p>
</div>
</div>
<div class="flex gap-4">
<div class="flex flex-col items-center">
<div class="w-3 h-3 rounded-full bg-outline-variant"></div>
</div>
<div>
<h4 class="font-bold text-primary-container text-sm">Impact Reporting</h4>
<p class="text-xs text-on-surface-variant mt-1">Comprehensive transparency report sent within 45 days.</p>
</div>
</div>
</div>
</div>
<!-- Social Sharing -->
<div class="mt-10 flex items-center justify-between p-6 bg-primary-container rounded-xl text-white">
<span class="font-semibold text-sm">Amplify Impact</span>
<div class="flex gap-3">
<button class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition-colors">
<span class="material-symbols-outlined text-xl" data-icon="share">share</span>
</button>
<button class="flex items-center gap-2 px-4 py-2 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-xs hover:scale-105 transition-transform">
<span class="material-symbols-outlined text-sm" data-icon="hub">hub</span>
                            Share Impact
                        </button>
</div>
</div>
</div>
<!-- Secondary Actions -->
<div class="flex flex-col sm:flex-row gap-4 pt-6">
<a class="flex-1 px-8 py-4 bg-primary-container text-white font-bold rounded-xl text-center hover:shadow-lg transition-all active:scale-95 text-sm" href="#">
                    Retour à l'accueil
                </a>
<a class="flex-1 px-8 py-4 border-2 border-secondary-container text-secondary font-bold rounded-xl text-center hover:bg-secondary-container/10 transition-all active:scale-95 text-sm" href="#">
                    Explorer d'autres projets
                </a>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface-container-low py-12 px-8 border-t border-outline-variant/10">
<div class="max-w-screen-xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
<div class="flex items-center gap-4">
<span class="font-headline font-extrabold text-xl text-primary-container">Al-Khair</span>
<div class="h-4 w-px bg-outline-variant hidden md:block"></div>
<p class="text-xs text-on-surface-variant">Registered Charity No. 1126808</p>
</div>
<div class="flex gap-8 text-xs font-semibold text-on-surface-variant">
<a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="hover:text-primary transition-colors" href="#">Contact Us</a>
</div>
<p class="text-xs text-on-surface-variant">© 2024 Al-Khair Foundation</p>
</div>
</footer>
</body></html>