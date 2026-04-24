<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">
<!-- SideNavBar Component -->
<aside class="h-screen w-64 fixed left-0 top-0 z-50 bg-slate-50 dark:bg-slate-900 flex flex-col p-4 gap-2">
<div class="mb-8 px-4 py-2">
<h1 class="font-['Manrope'] font-extrabold text-lg text-slate-900 dark:text-white">Al-Khair Admin</h1>
<p class="font-['Inter'] text-xs font-medium text-slate-500 uppercase tracking-widest">Humanitarian Portal</p>
</div>
<nav class="flex flex-col gap-1">
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-['Inter'] text-sm font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-500/10 text-amber-700 dark:text-amber-400 font-bold transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">account_balance</span>
<span class="font-['Inter'] text-sm font-medium">Associations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">assignment</span>
<span class="font-['Inter'] text-sm font-medium">Projects</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">volunteer_activism</span>
<span class="font-['Inter'] text-sm font-medium">Donations</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">group</span>
<span class="font-['Inter'] text-sm font-medium">Users</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">assessment</span>
<span class="font-['Inter'] text-sm font-medium">Reports</span>
</a>
<a class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-800 transition-transform duration-200 active:translate-x-1" href="#">
<span class="material-symbols-outlined">settings</span>
<span class="font-['Inter'] text-sm font-medium">Settings</span>
</a>
</nav>
<div class="mt-auto p-4 rounded-xl bg-surface-container-low">
<div class="flex items-center gap-2 mb-1">
<div class="w-2 h-2 rounded-full bg-emerald-500"></div>
<span class="text-[10px] font-bold uppercase tracking-tighter text-on-surface-variant">System Status: Active</span>
</div>
<p class="text-[10px] text-on-surface-variant/60">v4.2.1 Institutional Core</p>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="ml-64 min-h-screen">
<!-- TopAppBar Component -->
<header class="w-full sticky top-0 z-40 bg-white/80 dark:bg-slate-950/80 backdrop-blur-lg border-b border-slate-200/50 dark:border-slate-800/50 shadow-sm flex justify-between items-center px-10 h-20">
<div class="flex items-center gap-8">
<h2 class="font-['Manrope'] font-bold text-2xl tracking-tight text-slate-950 dark:text-white">Validation Hub</h2>
<div class="hidden md:flex items-center gap-6">
<a class="font-['Inter'] text-sm font-semibold border-b-2 border-amber-500 text-black dark:text-white py-2" href="#">Associations</a>
<a class="font-['Inter'] text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-amber-600 transition-colors py-2" href="#">Projects Review</a>
<a class="font-['Inter'] text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-amber-600 transition-colors py-2" href="#">KYC Queue</a>
</div>
</div>
<div class="flex items-center gap-4">
<button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined">notifications</span>
</button>
<button class="p-2 text-slate-500 hover:bg-slate-100 rounded-full transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
<div class="h-10 w-10 rounded-full bg-primary-container flex items-center justify-center overflow-hidden border border-outline-variant/20">
<img alt="Admin Profile Avatar" class="w-full h-full object-cover" data-alt="Portrait of an professional administrator" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6Nf1PjzmhfPA9ujOV3nkOgwYYoHa461fL0pb2XaDJFF3OX408LOsURYv1lrTvEplEemdbXcSSsZfZI6SEmv06vhlnIBFQlo-5BffF_9WZC7f_0Rb8hvPGpbACubawlpfzP1wOxAcKPbw3muCB8HGwyb21u0suRdI6tNqNcKHdSV60gkXy__BX7oNLnn7ZiiIG8J4T-yVLkFmUpIp0u-hM0dM_-3j1NYDiTsWCZoFoe0gcSFgY9lfK_gtld0GM7js166wzTfC4y_w"/>
</div>
</div>
</header>
<div class="p-10 max-w-7xl mx-auto space-y-12">
<!-- Dashboard Stats & Filters -->
<section class="flex flex-col md:flex-row justify-between items-end gap-6">
<div>
<span class="text-xs font-bold text-secondary uppercase tracking-[0.2em] mb-2 block">Pending Review</span>
<h3 class="text-4xl font-extrabold text-on-surface tracking-tight">System Moderation</h3>
</div>
<div class="flex p-1 bg-surface-container-high rounded-lg">
<button class="px-6 py-2 rounded-md bg-surface-container-lowest shadow-sm text-sm font-semibold text-primary">All Requests</button>
<button class="px-6 py-2 rounded-md text-sm font-medium text-on-surface-variant hover:bg-surface-container-low transition-colors">Pending (12)</button>
<button class="px-6 py-2 rounded-md text-sm font-medium text-on-surface-variant hover:bg-surface-container-low transition-colors">Approved</button>
<button class="px-6 py-2 rounded-md text-sm font-medium text-on-surface-variant hover:bg-surface-container-low transition-colors">Rejected</button>
</div>
</section>
<!-- New Associations Submission -->
<section class="space-y-6">
<div class="flex items-center justify-between">
<h4 class="text-xl font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-amber-600">domain_verification</span>
                        New Association Submissions
                    </h4>
<span class="text-xs font-medium px-3 py-1 bg-tertiary-container text-on-tertiary-container rounded-full uppercase tracking-wider">Urgent Review</span>
</div>
<div class="grid grid-cols-1 gap-6">
<!-- Submission Card 1 -->
<div class="group bg-surface-container-lowest rounded-xl p-8 border border-transparent hover:border-amber-500/20 transition-all duration-300 shadow-[0_32px_64px_-12px_rgba(0,0,0,0.04)]">
<div class="flex flex-col lg:flex-row gap-8">
<div class="flex-1 space-y-4">
<div class="flex items-start justify-between">
<div>
<h5 class="text-2xl font-bold text-on-surface">Atlas Care Foundation</h5>
<p class="text-sm text-on-surface-variant font-medium">Registered: Dec 12, 2023 • Marrakech, Morocco</p>
</div>
<div class="flex gap-2">
<div class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg border border-outline-variant/10">
<span class="material-symbols-outlined text-blue-500 text-lg">picture_as_pdf</span>
<span class="text-xs font-bold text-on-surface-variant">KYC_TAX_ID.pdf</span>
</div>
<div class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg border border-outline-variant/10">
<span class="material-symbols-outlined text-amber-600 text-lg">image</span>
<span class="text-xs font-bold text-on-surface-variant">MEMBER_LIST.jpg</span>
</div>
</div>
</div>
<p class="text-on-surface-variant leading-relaxed text-sm">
                                    The Atlas Care Foundation is dedicated to providing sustainable water solutions and mobile medical clinics to the remote Berber villages across the High Atlas Mountains. We have successfully completed 14 pilot programs in the past two years and are seeking formal association status to scale our impact through regional government partnerships. Our commitment is to long-term community empowerment and healthcare accessibility.
                                </p>
</div>
<div class="lg:w-72 flex flex-col justify-center gap-3">
<button class="w-full py-3 bg-primary-container text-on-primary rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform">
<span class="material-symbols-outlined text-sm">visibility</span>
                                    View Documents
                                </button>
<button class="w-full py-3 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform">
<span class="material-symbols-outlined text-sm">check_circle</span>
                                    Approve Account
                                </button>
<button class="w-full py-3 bg-surface-container-low text-on-surface-variant rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-sm">mail</span>
                                    Send Feedback
                                </button>
</div>
</div>
</div>
<!-- Submission Card 2 -->
<div class="group bg-surface-container-lowest rounded-xl p-8 border border-transparent hover:border-amber-500/20 transition-all duration-300 shadow-[0_32px_64px_-12px_rgba(0,0,0,0.04)]">
<div class="flex flex-col lg:flex-row gap-8">
<div class="flex-1 space-y-4">
<div class="flex items-start justify-between">
<div>
<h5 class="text-2xl font-bold text-on-surface">Education First Initiative</h5>
<p class="text-sm text-on-surface-variant font-medium">Registered: Jan 05, 2024 • Casablanca, Morocco</p>
</div>
<div class="flex gap-2">
<div class="flex items-center gap-2 px-3 py-1.5 bg-surface-container-low rounded-lg border border-outline-variant/10">
<span class="material-symbols-outlined text-blue-500 text-lg">picture_as_pdf</span>
<span class="text-xs font-bold text-on-surface-variant">BYLAWS_2024.pdf</span>
</div>
</div>
</div>
<p class="text-on-surface-variant leading-relaxed text-sm">
                                    Focused on digital literacy for underprivileged youth, Education First Initiative creates modern learning labs in existing community centers. We provide hardware, curated software curriculum, and trained mentors to bridge the digital divide. Our goal for the next 12 months is to establish 50 labs across the coastal regions, impacting over 5,000 students directly through hands-on technical training and mentorship programs.
                                </p>
</div>
<div class="lg:w-72 flex flex-col justify-center gap-3">
<button class="w-full py-3 bg-primary-container text-on-primary rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform">
<span class="material-symbols-outlined text-sm">visibility</span>
                                    View Documents
                                </button>
<button class="w-full py-3 bg-secondary-container text-on-secondary-container rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:scale-[1.02] transition-transform">
<span class="material-symbols-outlined text-sm">check_circle</span>
                                    Approve Account
                                </button>
<button class="w-full py-3 bg-surface-container-low text-on-surface-variant rounded-lg font-bold text-sm flex items-center justify-center gap-2 hover:bg-surface-container-high transition-colors">
<span class="material-symbols-outlined text-sm">mail</span>
                                    Send Feedback
                                </button>
</div>
</div>
</div>
</div>
</section>
<!-- Project Moderation Section (Bento Style) -->
<section class="space-y-6 pt-10">
<div class="flex items-center justify-between">
<h4 class="text-xl font-bold flex items-center gap-2">
<span class="material-symbols-outlined text-amber-600">article</span>
                        Project Visual &amp; Content Moderation
                    </h4>
<a class="text-sm font-bold text-on-primary-container hover:underline underline-offset-4" href="#">View All Projects</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Project Moderation Card 1 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-lg border border-outline-variant/10">
<div class="h-52 relative overflow-hidden group">
<img alt="Project Hero" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Volunteer feeding children in a community setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbsZXsSIWen8Z9Cu32hpVRSfB7O5lXoRx1VDkpYorZqQ_SUQfTH2inqAGEzIy7X4MGukQGUb4LQ4c4Hc0mI6s-hbeAnCPcrKiVguLLnGvfHNrCUkUG3NjG9A3zyJgeLuYVgz3L4xUWgfKD_Z3tgwR7DPyp7cXcWWgBSvL-Htthv2DoyPyt7YxdHgsEG0GtqPJclKkBBHOnBMbSTU0bns6slGJKfDHQlA5SdWnM6BhWpYDw4CBg3eg_0VGAc0UjPpWycNHQ6H-EUcQ"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
<div class="absolute bottom-4 left-4 right-4">
<span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest bg-black/40 backdrop-blur-md px-2 py-1 rounded">PENDING VISUALS</span>
<h6 class="text-white font-bold mt-1">Solar Wells for Erfoud</h6>
</div>
</div>
<div class="p-6 space-y-4">
<p class="text-xs text-on-surface-variant leading-relaxed line-clamp-3">
                                This project aims to install 5 solar-powered water extraction systems in the desert outskirts of Erfoud. Hero image needs verification for licensing and resolution.
                            </p>
<div class="flex gap-2">
<button class="flex-1 py-2 bg-surface-container-low text-on-surface text-[11px] font-bold uppercase rounded hover:bg-surface-container-high transition-colors">Edit Content</button>
<button class="flex-1 py-2 bg-secondary text-white text-[11px] font-bold uppercase rounded hover:bg-secondary-container transition-colors">Approve Hero</button>
</div>
</div>
</div>
<!-- Project Moderation Card 2 -->
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-lg border border-outline-variant/10">
<div class="h-52 relative overflow-hidden group">
<img alt="Project Hero" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Traditional Moroccan artisan workshop interior" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlUeg9meGVLnJ5Uu5JvDH51y5MbF5WVOGdc8A0rxonYfr6TPrVo1QcJuEyIBvHHeq30_LH75tNZrhshDCkSKkGOxIbz8Fj6iL44POkJJhnv-skMatq85IOg6Y_SxQ462COOYhHOkVMJIpNq1q9O14wXQhhiiMhY0lvpok5s_Ak4_p8yDewNTzSgY8r1TvxSqIfQv9JEPLN5w-EVwX1jN26-_g3l-ZqKL8gfvePeC6bNcUWke_Bt4ZHSPsAQFSI_EWXPpmhtAHMr7w"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
<div class="absolute bottom-4 left-4 right-4">
<span class="text-[10px] font-bold text-amber-400 uppercase tracking-widest bg-black/40 backdrop-blur-md px-2 py-1 rounded">FLAGGED DESCRIPTION</span>
<h6 class="text-white font-bold mt-1">Artisan Heritage Support</h6>
</div>
</div>
<div class="p-6 space-y-4">
<p class="text-xs text-on-surface-variant leading-relaxed line-clamp-3">
                                Description contains contact information that violates security policy. Requires manual edit before publication. Image resolution is excellent.
                            </p>
<div class="flex gap-2">
<button class="flex-1 py-2 bg-surface-container-low text-on-surface text-[11px] font-bold uppercase rounded hover:bg-surface-container-high transition-colors">Review Text</button>
<button class="flex-1 py-2 bg-tertiary-container text-on-tertiary-container text-[11px] font-bold uppercase rounded hover:opacity-90 transition-colors">Reject</button>
</div>
</div>
</div>
<!-- Project Moderation Card 3 (Empty State/Next) -->
<div class="border-2 border-dashed border-outline-variant/30 rounded-xl flex flex-col items-center justify-center p-8 text-center bg-surface-container-low/50">
<span class="material-symbols-outlined text-4xl text-outline-variant mb-4">move_to_inbox</span>
<h6 class="text-on-surface font-bold">More Projects Awaiting</h6>
<p class="text-xs text-on-surface-variant mt-2 max-w-[200px]">There are 9 more projects in the queue for visual review.</p>
<button class="mt-6 px-6 py-2 bg-primary text-white text-[11px] font-bold uppercase rounded-full hover:scale-105 transition-transform">Enter Queue</button>
</div>
</div>
</section>
</div>
</main>
<!-- Contextual FAB Suppression: FAB not rendered on Admin/Validation Interface -->
</body></html>