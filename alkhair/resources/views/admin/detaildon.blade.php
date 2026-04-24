<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Donation Audit | Atlas Admin</title>
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
              "on-secondary-container": "#6b4b00",
              "secondary-container": "#feb700",
              "on-error": "#ffffff",
              "tertiary-fixed-dim": "#ffb599",
              "secondary-fixed": "#ffdea8",
              "primary-container": "#021c36",
              "on-tertiary": "#ffffff",
              "on-secondary-fixed-variant": "#5e4200",
              "on-primary": "#ffffff",
              "surface": "#f8f9fb",
              "outline-variant": "#c4c6ce",
              "surface-container-low": "#f2f4f6",
              "on-secondary-fixed": "#271900",
              "surface-bright": "#f8f9fb",
              "on-primary-fixed-variant": "#324863",
              "on-primary-container": "#6f85a3",
              "on-tertiary-fixed": "#370e00",
              "tertiary": "#000000",
              "surface-variant": "#e0e3e5",
              "secondary-fixed-dim": "#ffba20",
              "surface-container-highest": "#e0e3e5",
              "on-secondary": "#ffffff",
              "on-background": "#191c1e",
              "inverse-primary": "#b1c8e9",
              "secondary": "#7c5800",
              "surface-container-high": "#e6e8ea",
              "on-tertiary-container": "#e05814",
              "primary-fixed-dim": "#b1c8e9",
              "primary": "#000000",
              "surface-dim": "#d8dadc",
              "on-surface-variant": "#43474d",
              "on-error-container": "#93000a",
              "background": "#f8f9fb",
              "error": "#ba1a1a",
              "outline": "#74777e",
              "inverse-surface": "#2d3133",
              "tertiary-fixed": "#ffdbce",
              "primary-fixed": "#d2e4ff",
              "on-surface": "#191c1e",
              "inverse-on-surface": "#eff1f3",
              "on-tertiary-fixed-variant": "#7f2b00",
              "surface-container": "#eceef0",
              "on-primary-fixed": "#021c36",
              "error-container": "#ffdad6",
              "surface-container-lowest": "#ffffff",
              "tertiary-container": "#370e00",
              "surface-tint": "#4a607c"
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
<body class="bg-surface text-on-surface selection:bg-secondary-container selection:text-on-secondary-container">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-950/80 backdrop-blur-lg shadow-sm">
<div class="flex justify-between items-center px-6 py-4 w-full max-w-7xl mx-auto">
<div class="flex items-center gap-8">
<span class="text-xl font-extrabold text-slate-900 dark:text-white tracking-tighter">Atlas Admin</span>
<nav class="hidden md:flex items-center gap-6">
<a class="text-slate-500 dark:text-slate-400 font-medium hover:text-amber-600 transition-colors duration-200" href="#">Dashboard</a>
<a class="text-amber-600 dark:text-amber-500 font-bold border-b-2 border-amber-600" href="#">Donations</a>
<a class="text-slate-500 dark:text-slate-400 font-medium hover:text-amber-600 transition-colors duration-200" href="#">Users</a>
<a class="text-slate-500 dark:text-slate-400 font-medium hover:text-amber-600 transition-colors duration-200" href="#">Reports</a>
</nav>
</div>
<div class="flex items-center gap-4">
<div class="hidden lg:flex items-center bg-surface-container px-3 py-1.5 rounded-full">
<span class="material-symbols-outlined text-outline" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm w-48" placeholder="Search Audit ID..." type="text"/>
</div>
<button class="p-2 text-slate-500 hover:text-amber-600 transition-colors">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
<div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center text-white overflow-hidden">
<img alt="Administrator Profile" data-alt="Administrator profile picture thumbnail" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCg23UzSPfgdFG0T5OSmklfSaOUoo59Ha_5C_ET1VvZdAS2QZGHV9Sj64U5H6W7_pXROKTws3S6NAnj0SeoQtVmFeyCREzutxcGLsEvykva_K9CagH8j9U-RXUc6AQMc6lhBnmIIC34h2BvF8jjeNKp9eAgVH1y4tamt-Bsfl8Qas5Zcyzhtei_ZuEQc9ES8Sy93VtAwPnR6eIV1vMXZYUShXYofhcCp05Of1_A8WmeutIUMjUrXc3q_4WW82pNM31mhFBYmrNX3Og"/>
</div>
</div>
</div>
<div class="bg-slate-100 dark:bg-slate-900 h-px w-full"></div>
</header>
<main class="pt-24 pb-20 px-6 max-w-7xl mx-auto">
<!-- Breadcrumb & Header Actions -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
<div>
<nav class="flex items-center gap-2 text-label-md text-on-surface-variant uppercase tracking-widest mb-2 font-semibold text-[10px]">
<span>Donations</span>
<span class="material-symbols-outlined text-xs" data-icon="chevron_right">chevron_right</span>
<span class="text-primary">Audit Trail</span>
</nav>
<h1 class="text-4xl font-extrabold tracking-tight text-primary-container leading-none">Donation #AK-99284-Z</h1>
</div>
<div class="flex gap-3">
<button class="flex items-center gap-2 px-6 py-3 bg-white border border-outline-variant hover:bg-surface-container-low transition-all rounded-lg font-bold text-sm text-primary-container active:scale-95">
<span class="material-symbols-outlined text-lg" data-icon="mail">mail</span>
                    Contact Donor
                </button>
<button class="flex items-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container hover:shadow-lg transition-all rounded-lg font-bold text-sm active:scale-95">
<span class="material-symbols-outlined text-lg" data-icon="download">download</span>
                    Download Receipt
                </button>
</div>
</div>
<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
<!-- Left Column: Primary Details -->
<div class="lg:col-span-8 space-y-6">
<!-- Highlight Card -->
<div class="bg-surface-container-lowest rounded-xl p-8 flex flex-col md:flex-row items-center gap-12 shadow-sm border border-transparent">
<div class="text-center md:text-left">
<p class="text-[10px] uppercase tracking-[0.15em] font-bold text-on-surface-variant mb-1">Total Contribution</p>
<p class="text-5xl font-extrabold text-primary tracking-tighter">15,450.00 <span class="text-2xl font-semibold opacity-60">DH</span></p>
</div>
<div class="h-px md:h-12 w-full md:w-px bg-outline-variant/30"></div>
<div class="flex-1">
<div class="flex items-center justify-between mb-2">
<span class="text-sm font-bold text-primary-container">Current Phase: Received</span>
<span class="text-sm font-semibold text-on-surface-variant">75% to Impact</span>
</div>
<div class="w-full h-3 bg-surface-container-high rounded-full overflow-hidden">
<div class="h-full bg-gradient-to-r from-secondary to-secondary-container rounded-full" style="width: 75%"></div>
</div>
</div>
<div class="px-4 py-2 bg-secondary-fixed text-on-secondary-fixed rounded-full flex items-center gap-2 font-bold text-xs uppercase tracking-wider">
<span class="material-symbols-outlined text-sm" data-icon="check_circle" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        Validated
                    </div>
</div>
<!-- Transaction Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<!-- Donor Card -->
<div class="bg-surface-container-low p-6 rounded-xl space-y-4">
<h3 class="text-lg font-bold text-primary-container border-b border-outline-variant/20 pb-3">Donor Profile</h3>
<div class="flex items-start gap-4">
<div class="w-14 h-14 rounded-full bg-surface-container-highest overflow-hidden">
<img alt="Donor Avatar" data-alt="Portrait of a generous donor" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDS6bgShuWrvkCmQ77zld20l0Qz92aE4MoWnBatf_BhN7-W05JulfHDbg26Ak-OgBNdbsXPuaUZTAI7hm6Dza1-ej4o-XNDVIUGtKq7Y8GjuVndDP8Hf94uOme-fx8hdacO01ROt8gUme-_i1yrT4lij1OkDoDHEEHKmnDjhf8vTE6L8VA_xebc-Y2bCyGPW5YQM2N3A37era_tS5jKNU75voG7L3UdOHCj9-g4zzuIyOITSrtgh8VcGmA-9qmVbtdoVDRh70n55cM"/>
</div>
<div class="space-y-1">
<p class="font-bold text-primary">Mohammed Al-Fassi</p>
<p class="text-sm text-on-surface-variant">m.alfassi@tech-corp.ma</p>
<p class="text-xs text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="location_on">location_on</span>
                                    Casablanca, Morocco
                                </p>
</div>
</div>
<div class="pt-2">
<span class="text-[10px] bg-primary-container/10 text-primary-container px-2 py-1 rounded font-bold uppercase tracking-wider">Platinum Donor</span>
</div>
</div>
<!-- Project Card -->
<div class="bg-surface-container-low p-6 rounded-xl space-y-4">
<h3 class="text-lg font-bold text-primary-container border-b border-outline-variant/20 pb-3">Association &amp; Project</h3>
<div class="flex items-start gap-4">
<div class="w-14 h-14 rounded-lg bg-surface-container-highest flex items-center justify-center">
<span class="material-symbols-outlined text-primary-container text-3xl" data-icon="water_drop">water_drop</span>
</div>
<div class="space-y-1">
<p class="font-bold text-primary">Atlas Well Initiative</p>
<p class="text-sm text-on-surface-variant">Recipient: SOS Atlas Rural</p>
<p class="text-xs text-secondary font-bold flex items-center gap-1">
<span class="material-symbols-outlined text-xs" data-icon="verified">verified</span>
                                    Verified NGO Partner
                                </p>
</div>
</div>
</div>
</div>
<!-- Audit Trail: Vertical Timeline -->
<div class="bg-surface-container-lowest rounded-xl p-8 border border-outline-variant/10 shadow-sm">
<h3 class="text-xl font-bold text-primary-container mb-8">Transaction Audit Trail</h3>
<div class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-0.5 before:bg-outline-variant/30">
<!-- Step 1 -->
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-secondary-container border-4 border-white shadow-sm z-10"></div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
<div>
<p class="font-bold text-primary">Status Updated to: IMPACT</p>
<p class="text-sm text-on-surface-variant">Water pumps successfully installed in High Atlas region.</p>
</div>
<div class="text-right">
<p class="text-xs font-bold text-primary">Admin Sarah K.</p>
<p class="text-xs text-on-surface-variant">Oct 12, 2023 • 14:22</p>
</div>
</div>
</div>
<!-- Step 2 -->
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary-container border-4 border-white shadow-sm z-10"></div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
<div>
<p class="font-bold text-primary">Funds Disbursed to Recipient</p>
<p class="text-sm text-on-surface-variant">Transferred via Bank Al-Maghrib Transfer Ref: #TXN-9092</p>
</div>
<div class="text-right">
<p class="text-xs font-bold text-primary">System Automation</p>
<p class="text-xs text-on-surface-variant">Oct 10, 2023 • 09:15</p>
</div>
</div>
</div>
<!-- Step 3 -->
<div class="relative pl-10">
<div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-surface-dim border-4 border-white shadow-sm z-10"></div>
<div class="flex flex-col md:flex-row md:items-center justify-between gap-2">
<div>
<p class="font-bold text-primary">Donation Received &amp; Validated</p>
<p class="text-sm text-on-surface-variant">Payment confirmed via Credit Card gateway.</p>
</div>
<div class="text-right">
<p class="text-xs font-bold text-primary">Finance Desk</p>
<p class="text-xs text-on-surface-variant">Oct 08, 2023 • 18:45</p>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Right Column: Meta Info & Actions -->
<div class="lg:col-span-4 space-y-6">
<!-- Metadata Panel -->
<div class="bg-primary-container text-white rounded-xl p-6 overflow-hidden relative shadow-xl">
<div class="relative z-10 space-y-6">
<h3 class="text-sm font-bold uppercase tracking-widest opacity-60">Audit Signature</h3>
<div class="space-y-4">
<div class="flex justify-between items-center">
<span class="text-xs opacity-60">Created At</span>
<span class="text-sm font-medium">Oct 08, 2023 | 18:40:22</span>
</div>
<div class="flex justify-between items-center">
<span class="text-xs opacity-60">Payment Method</span>
<span class="text-sm font-medium">Visa •••• 4242</span>
</div>
<div class="flex justify-between items-center">
<span class="text-xs opacity-60">Gateway Reference</span>
<span class="text-sm font-medium">STR_99X_B2B</span>
</div>
<div class="flex justify-between items-center">
<span class="text-xs opacity-60">IP Address</span>
<span class="text-sm font-medium">196.200.142.11</span>
</div>
</div>
<div class="pt-6 border-t border-white/10">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-secondary-container" data-icon="security" style="font-variation-settings: 'FILL' 1;">security</span>
<p class="text-[10px] leading-relaxed opacity-80">
                                    This record is cryptographically signed and archived for compliance. 
                                    Unauthorized modification is prohibited by Al-Khair policy.
                                </p>
</div>
</div>
</div>
<!-- Decorative Element -->
<div class="absolute -right-12 -top-12 w-48 h-48 bg-secondary-container/10 rounded-full blur-3xl"></div>
</div>
<!-- Recipient Info -->
<div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-outline-variant/10">
<h3 class="text-sm font-bold uppercase tracking-widest text-on-surface-variant mb-4">Location Impact</h3>
<div class="rounded-lg overflow-hidden h-40 bg-surface-container mb-4">
<img alt="Impact Map" class="w-full h-full object-cover" data-alt="Map showing the location of the project in the High Atlas mountains" data-location="Oukaimeden, Morocco" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAplht-M_kMFc8y6zRGeV_-upWiIODt5o8Tpoducqr1hskq08AAjRfL8mPr9axO9E9oTvhJejmVBebHkynRNCUEDh9eU2fooQn81a6fVqXjj-a3HJ_-Lc8jUusn3YveZBhfG_tbHgNdyXqvOrk1IZbGhP4BDr7zUrJyErhCHPKyJ7hUamLQhwo4pmgJWlXGiNVhCPwW9ao308dGDjCMjPbCQq1TE3vqsB1K9y-tcoqApJ9ZyD3BPWziIki3WH_8bKn3hG8AHfY3sJM"/>
</div>
<div class="space-y-2">
<p class="text-xs text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-sm" data-icon="pin_drop">pin_drop</span>
                            Douar Ait Souka, Al-Haouz Province
                        </p>
<p class="text-xs text-on-surface-variant flex items-center gap-1">
<span class="material-symbols-outlined text-sm" data-icon="groups">groups</span>
                            Serving 120 families (approx. 600 people)
                        </p>
</div>
</div>
<!-- Quick Actions List -->
<div class="space-y-3">
<button class="w-full text-left p-4 rounded-xl border border-outline-variant/20 hover:border-secondary transition-all group flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-secondary" data-icon="history_edu">history_edu</span>
<span class="text-sm font-bold text-primary-container">View Change Log</span>
</div>
<span class="material-symbols-outlined text-outline-variant" data-icon="chevron_right">chevron_right</span>
</button>
<button class="w-full text-left p-4 rounded-xl border border-outline-variant/20 hover:border-secondary transition-all group flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-on-surface-variant group-hover:text-secondary" data-icon="print">print</span>
<span class="text-sm font-bold text-primary-container">Print Internal Report</span>
</div>
<span class="material-symbols-outlined text-outline-variant" data-icon="chevron_right">chevron_right</span>
</button>
<button class="w-full text-left p-4 rounded-xl border border-error/20 hover:bg-error/5 transition-all group flex items-center justify-between">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-error" data-icon="flag">flag</span>
<span class="text-sm font-bold text-error">Flag for Review</span>
</div>
<span class="material-symbols-outlined text-error/30" data-icon="chevron_right">chevron_right</span>
</button>
</div>
</div>
</div>
</main>
<!-- BottomNavBar (Mobile Only) -->
<nav class="md:hidden fixed bottom-0 left-0 w-full flex justify-around items-center px-4 pb-6 pt-3 bg-white shadow-[0_-4px_20px_rgba(0,0,0,0.05)] z-50 rounded-t-2xl">
<a class="flex flex-col items-center justify-center text-slate-400" href="#">
<span class="material-symbols-outlined" data-icon="home">home</span>
<span class="font-['Inter'] text-[10px] uppercase tracking-widest font-semibold mt-1">Home</span>
</a>
<a class="flex flex-col items-center justify-center text-amber-600 bg-amber-50/50 rounded-xl px-3 py-1" href="#">
<span class="material-symbols-outlined" data-icon="volunteer_activism">volunteer_activism</span>
<span class="font-['Inter'] text-[10px] uppercase tracking-widest font-semibold mt-1">Donations</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400" href="#">
<span class="material-symbols-outlined" data-icon="history">history</span>
<span class="font-['Inter'] text-[10px] uppercase tracking-widest font-semibold mt-1">Activity</span>
</a>
<a class="flex flex-col items-center justify-center text-slate-400" href="#">
<span class="material-symbols-outlined" data-icon="person">person</span>
<span class="font-['Inter'] text-[10px] uppercase tracking-widest font-semibold mt-1">Profile</span>
</a>
</nav>
</body></html>