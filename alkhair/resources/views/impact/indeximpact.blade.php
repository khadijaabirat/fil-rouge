<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>L'Archive Éthique - Rapports d'Impact | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e8ecf3 0%, #f5f7fc 50%, #ffffff 100%); }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }

        /* Neumorphism Cards with colored shadows */
        .neu-card {
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow:
                0 2px 4px rgba(10, 17, 40, 0.04),
                0 8px 24px rgba(10, 17, 40, 0.08),
                0 16px 48px rgba(245, 166, 35, 0.04);
            border: 1px solid rgba(245, 166, 35, 0.08);
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .neu-card:hover {
            box-shadow:
                0 4px 8px rgba(10, 17, 40, 0.06),
                0 20px 48px rgba(10, 17, 40, 0.12),
                0 32px 80px rgba(245, 166, 35, 0.12);
            transform: translateY(-8px);
        }

        .neu-card-static {
            background: #ffffff;
            border-radius: 1.5rem;
            box-shadow:
                0 2px 4px rgba(10, 17, 40, 0.04),
                0 8px 24px rgba(10, 17, 40, 0.08),
                0 16px 48px rgba(245, 166, 35, 0.04);
            border: 1px solid rgba(245, 166, 35, 0.08);
        }

        /* Enhanced Glassmorphism */
        .glass-nav {
            background: rgba(10, 17, 40, 0.75);
            backdrop-filter: blur(32px);
            -webkit-backdrop-filter: blur(32px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(10, 17, 40, 0.1);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(245, 166, 35, 0.3);
            box-shadow: 0 0 24px rgba(245, 166, 35, 0.15);
        }

        /* Scroll Reveal Animations */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Staggered reveals */
        .reveal:nth-child(1) { transition-delay: 0ms; }
        .reveal:nth-child(2) { transition-delay: 80ms; }
        .reveal:nth-child(3) { transition-delay: 160ms; }
        .reveal:nth-child(n+4) { transition-delay: 240ms; }

        /* Enhanced button states */
        .btn-modern {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s;
        }

        .btn-modern:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Gradient text animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .gradient-text {
            background: linear-gradient(90deg, #F5A623, #FFD085, #F5A623);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Icon pulse animation */
        @keyframes pulse-icon {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .pulse-icon {
            animation: pulse-icon 2s ease-in-out infinite;
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 antialiased selection:bg-[#F5A623] selection:text-white">

    @include('partials.navbar')

    <main>
        <!-- Hero Section -->
        <section class="relative pt-32 pb-24 md:pt-48 md:pb-32 overflow-hidden bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0f1a35]">
            <div class="absolute inset-0 z-0 pointer-events-none">
                <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#F5A623]/15 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                <div class="absolute top-1/2 right-0 w-96 h-96 bg-[#FFD085]/5 rounded-full blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#F5A623]/15 border border-[#F5A623]/30 text-[#F5A623] rounded-full text-[10px] font-black mb-6 uppercase tracking-widest reveal backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px] pulse-icon">verified_user</span>
                    L'Archive Éthique
                </div>

                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight tracking-tight mb-6 reveal" style="transition-delay: 80ms;">
                    La finalité de <span class="gradient-text">chaque dirham</span> donné.
                </h1>

                <p class="text-sm md:text-base text-white/70 max-w-2xl mx-auto leading-relaxed mb-10 reveal" style="transition-delay: 160ms;">
                    Explorez la bibliothèque immuable des projets réalisés. Une transparence totale, soutenue par des preuves visuelles et des rapports certifiés.
                </p>

                <div class="max-w-2xl mx-auto relative reveal" style="transition-delay: 240ms;">
                    <form action="{{ route('impact.index') }}" method="GET">
                        <div class="relative flex items-center glass-input rounded-2xl p-2 shadow-2xl shadow-[#F5A623]/10">
                            <span class="material-symbols-outlined absolute left-5 text-white/50 text-xl">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une association, un projet..."
                                   class="w-full bg-transparent border-none text-white placeholder-white/40 py-3 pl-12 pr-32 focus:ring-0 outline-none text-sm font-medium transition-all duration-300">
                            <button type="submit" class="absolute right-2 top-2 bottom-2 bg-[#F5A623] text-[#0A1128] px-6 rounded-xl font-black text-xs uppercase tracking-wider hover:bg-white transition-all shadow-md hover:shadow-xl hover:shadow-[#F5A623]/30">
                                Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="max-w-7xl mx-auto px-6 -mt-12 relative z-20 reveal">
            <div class="bg-white rounded-3xl shadow-xl shadow-[#F5A623]/10 border border-slate-100 p-8 grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-slate-100 backdrop-blur-sm">
                <div class="text-center md:px-4">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-[#F5A623]">library_books</span>
                        Rapports Publiés
                    </p>
                    <p class="text-5xl font-black text-[#0A1128] tracking-tight">{{ $impactReports->total() ?? '142' }}</p>
                </div>
                <div class="text-center md:px-4 pt-8 md:pt-0">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-emerald-500">verified_circle</span>
                        Taux de Réussite
                    </p>
                    <p class="text-5xl font-black text-[#0A1128] tracking-tight">100<span class="text-2xl text-[#F5A623]">%</span></p>
                </div>
                <div class="text-center md:px-4 pt-8 md:pt-0">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-blue-500">people</span>
                        Vies Impactées (Est.)
                    </p>
                    <p class="text-5xl font-black text-[#0A1128] tracking-tight">+{{ number_format(($impactReports->total() ?? 142) * 150, 0, ',', ' ') }}</p>
                </div>
            </div>
        </section>

        <!-- Impact Reports Grid -->
        <section class="max-w-7xl mx-auto px-6 py-24">

            @if(isset($impactReports) && $impactReports->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($impactReports as $report)
                        @php $project = $report->project; @endphp

                        <div class="neu-card overflow-hidden flex flex-col group reveal hover:shadow-2xl hover:shadow-[#F5A623]/15">
                            <div class="relative h-64 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-50">
                                @if($report->image)
                                    <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"/>
                                @elseif($project->image)
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"/>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20"><span class="text-[#0A1128]/30 text-5xl font-black">AK</span></div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/95 via-[#0A1128]/50 to-transparent"></div>

                                <div class="absolute top-4 left-4">
                                    <span class="bg-emerald-500/90 backdrop-blur-sm text-white text-[10px] font-black px-3 py-1.5 rounded-lg uppercase tracking-widest flex items-center gap-1 shadow-md shadow-emerald-500/20 border border-emerald-400/20">
                                        <span class="material-symbols-outlined text-[14px]">verified</span> Impact Confirmé
                                    </span>
                                </div>

                                <div class="absolute bottom-5 left-6 right-6 text-white">
                                    <p class="text-[10px] text-[#FFD085] font-black uppercase tracking-widest mb-1">{{ $project->association->name ?? 'Association' }}</p>
                                    <h3 class="font-black text-xl leading-tight line-clamp-2 drop-shadow-md">{{ $project->title }}</h3>
                                </div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col">
                                <p class="text-sm text-slate-500 line-clamp-3 mb-6 flex-grow leading-relaxed">
                                    {{ $report->description ?? 'Rapport d\'impact détaillé attestant de la finalisation et du succès de ce projet solidaire.' }}
                                </p>

                                <div class="bg-gradient-to-br from-slate-50 to-slate-100 p-4 rounded-xl border border-slate-200 mb-6 space-y-2 shadow-sm shadow-[#F5A623]/5">
                                    <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-wider">
                                        <span class="text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">paid</span>
                                            Fonds Déployés
                                        </span>
                                        <span class="text-[#0A1128] text-sm font-black">{{ number_format($project->currentAmount ?? 0, 0, ',', ' ') }} DH</span>
                                    </div>
                                    <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-wider">
                                        <span class="text-slate-400 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                                            Date clôture
                                        </span>
                                        <span class="text-[#0A1128] font-semibold">{{ \Carbon\Carbon::parse($report->completionDate)->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('impact.show', $report->id) }}" class="w-full py-3.5 bg-gradient-to-r from-[#0A1128] to-[#162040] text-white font-black text-[10px] uppercase tracking-widest text-center rounded-xl hover:shadow-lg hover:shadow-[#0A1128]/30 transition-all flex items-center justify-center gap-2 group/btn">
                                    Lire le rapport
                                    <span class="material-symbols-outlined text-[16px] group-hover/btn:translate-x-1 transition-transform duration-300">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16 flex justify-center reveal">
                    {{ $impactReports->links() }}
                </div>
            @else
                <div class="neu-card p-16 text-center border-2 border-dashed border-slate-200 max-w-2xl mx-auto reveal">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-br from-slate-50 to-slate-100 rounded-3xl flex items-center justify-center mb-6 border border-slate-100 shadow-sm shadow-[#F5A623]/10">
                        <span class="material-symbols-outlined text-4xl text-slate-300">history_edu</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-2">Aucun rapport trouvé</h3>
                    <p class="text-slate-500 mb-8 text-sm">Les rapports d'impact publiés par les associations apparaîtront ici.</p>
                    <a href="{{ route('impact.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#0A1128] text-white font-bold rounded-xl hover:bg-[#F5A623] hover:text-[#0A1128] transition-all text-sm shadow-md hover:shadow-lg shadow-[#0A1128]/20">
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        Voir tous les rapports
                    </a>
                </div>
            @endif
        </section>

        <!-- CTA Section -->
        <section class="py-24 bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0f1a35] text-white relative overflow-hidden reveal">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#F5A623]/12 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#FFD085]/8 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-4xl mx-auto text-center relative z-10 px-6">
                <span class="material-symbols-outlined text-[#F5A623] text-5xl mb-6 inline-block pulse-icon" style="font-variation-settings: 'FILL' 1;">public</span>
                <h2 class="text-3xl md:text-5xl font-black mb-4 tracking-tight">Devenez acteur du changement.</h2>
                <p class="text-sm text-white/60 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Vous avez vu la preuve de notre engagement. Rejoignez des milliers de donateurs qui construisent un Maroc plus solidaire, en toute transparence.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('projects.index') }}" class="px-8 py-4 bg-[#F5A623] text-[#0A1128] font-black rounded-xl hover:bg-white transition-all shadow-xl shadow-[#F5A623]/30 flex items-center gap-2 uppercase tracking-wider text-sm hover:shadow-2xl hover:-translate-y-1 duration-300">
                        Soutenir un projet <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    @include('partials.footer')

    <script>
        // Reveal animation on scroll with improved easing
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -100px 0px',
                threshold: [0, 0.1]
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        requestAnimationFrame(() => {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target);
                        });
                    }
                });
            }, observerOptions);

            reveals.forEach(reveal => revealObserver.observe(reveal));
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
