<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $project->title ?? 'Rapport d\'Impact' }} | AL-KHAIR</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

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

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(90deg, #F5A623, #FFD085, #F5A623);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Pulse animation for icons */
        @keyframes pulse-icon {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .pulse-icon {
            animation: pulse-icon 2s ease-in-out infinite;
        }

        /* Enhanced button states */
        .btn-modern {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Image hover zoom */
        .image-zoom {
            overflow: hidden;
        }

        .image-zoom img {
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .image-zoom:hover img {
            transform: scale(1.08);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-[#e8ecf3] to-white text-slate-700 antialiased selection:bg-[#F5A623] selection:text-white">

    @include('partials.navbar')

    <main class="pt-20">

        <!-- Hero Section -->
        <section class="relative min-h-[614px] flex items-center px-8 lg:px-20 py-24 overflow-hidden bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0f1a35]">
            <div class="absolute inset-0 z-0 opacity-50">
                @if($impactReport->image)
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $impactReport->image) }}" alt="{{ $project->title }}"/>
                @elseif($project->image)
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"/>
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#162040]"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-[#0A1128] via-[#0A1128]/85 to-[#0A1128]/30"></div>
            </div>

            <div class="relative z-10 max-w-4xl reveal">
                <div class="inline-flex items-center gap-2 bg-[#F5A623]/20 border border-[#F5A623]/40 text-[#F5A623] px-4 py-1.5 rounded-full mb-8 backdrop-blur-sm shadow-lg shadow-[#F5A623]/10">
                    <span class="material-symbols-outlined text-[16px] pulse-icon" style="font-variation-settings: 'FILL' 1;">verified</span>
                    <span class="text-[10px] font-black uppercase tracking-widest">Rapport Validé</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6 tracking-tight">
                    Rapport d'Impact : <br/>
                    <span class="gradient-text underline decoration-amber-500/30 decoration-8 underline-offset-8">{{ $project->title }}</span>
                </h1>

                <p class="text-white/75 text-lg md:text-xl max-w-2xl leading-relaxed mb-10 line-clamp-3 font-medium">
                    {{ $impactReport->description ?? $project->description }}
                </p>

                <div class="flex flex-wrap gap-8">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-white/50 uppercase tracking-widest font-bold mb-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                            Date de Clôture
                        </span>
                        <span class="text-white text-lg font-black tracking-tight">{{ \Carbon\Carbon::parse($impactReport->completionDate)->format('d M Y') }}</span>
                    </div>
                    <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-white/50 uppercase tracking-widest font-bold mb-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">location_on</span>
                            Localisation
                        </span>
                        <span class="text-white text-lg font-black tracking-tight">{{ $project->ville ?? 'Maroc' }}</span>
                    </div>
                    <div class="w-px h-12 bg-white/10 hidden sm:block"></div>
                    <div class="flex flex-col">
                        <span class="text-[10px] text-white/50 uppercase tracking-widest font-bold mb-2 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">corporate_fare</span>
                            Association Partenaire
                        </span>
                        <span class="text-white text-lg font-black tracking-tight">{{ $project->association->name ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="px-8 lg:px-20 -mt-16 relative z-20 pb-24 reveal" style="transition-delay: 80ms;">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="md:col-span-2 lg:col-span-2 neu-card-static p-8 flex flex-col justify-between shadow-xl shadow-[#F5A623]/10 hover:shadow-2xl hover:shadow-[#F5A623]/15 transition-all duration-300">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <h3 class="text-[10px] font-black uppercase tracking-widest text-[#0A1128] flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-[#F5A623]">account_balance_wallet</span>
                                Total des Fonds Utilisés
                            </h3>
                            <span class="material-symbols-outlined text-[#F5A623] text-3xl" style="font-variation-settings: 'FILL' 1;">payments</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <span class="text-5xl font-black text-[#0A1128]">{{ number_format($project->currentAmount, 0, ',', ' ') }}</span>
                            <span class="text-2xl font-black text-slate-300 uppercase">DH</span>
                        </div>
                    </div>
                    <div class="mt-8 space-y-3">
                        @php
                            $percentage = ($project->goalAmount > 0) ? min(($project->currentAmount / $project->goalAmount) * 100, 100) : 100;
                        @endphp
                        <div class="flex justify-between text-[10px] uppercase font-black tracking-wider">
                            <span class="text-slate-400">Taux de financement</span>
                            <span class="text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden shadow-sm shadow-slate-200">
                            <div class="h-full bg-gradient-to-r from-[#F5A623] to-[#FFD085] rounded-full shadow-lg shadow-[#F5A623]/30" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-[#0A1128] to-[#162040] p-8 rounded-[1.5rem] shadow-xl shadow-[#0A1128]/30 flex flex-col justify-center text-center text-white hover:shadow-2xl hover:shadow-[#0A1128]/40 transition-all duration-300">
                    <span class="text-[10px] text-white/50 uppercase tracking-widest font-bold mb-4 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">group</span>
                        Individus Soutenus
                    </span>
                    <span class="text-6xl font-black mb-2 tracking-tight">{{ $impactReport->peopleImpacted ?? '100+' }}</span>
                    <span class="text-[#FFD085] text-[10px] font-black uppercase tracking-widest">Impact direct mesuré</span>
                </div>

                <div class="bg-slate-50 p-8 rounded-[1.5rem] border border-slate-200 flex flex-col justify-center shadow-sm shadow-[#F5A623]/10 hover:shadow-lg hover:shadow-[#F5A623]/15 transition-all duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-[#F5A623] shadow-sm shadow-[#F5A623]/20 border border-slate-200">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">volunteer_activism</span>
                        </div>
                        <span class="text-xs font-black uppercase tracking-tight text-[#0A1128] leading-tight">Donateurs<br/>Uniques</span>
                    </div>
                    <span class="text-4xl font-black text-[#0A1128]">{{ $project->donations->unique('donator_id')->count() }}</span>
                    <p class="text-slate-500 text-[10px] uppercase tracking-widest mt-2 font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[12px] text-emerald-500">check_circle</span>
                        Contributeurs vérifiés
                    </p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="px-8 lg:px-20 pb-24 grid lg:grid-cols-12 gap-16">
            <div class="lg:col-span-7 reveal">
                <div class="flex items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-[#F5A623] text-[20px]">forum</span>
                    <h2 class="text-3xl font-black text-[#0A1128] tracking-tight">La Voix de la Communauté</h2>
                </div>
                <div class="space-y-6 text-slate-600 leading-relaxed text-lg font-medium">
                    {!! nl2br(e($impactReport->description)) !!}

                    <div class="bg-slate-50 p-8 rounded-[1.5rem] border-l-4 border-[#F5A623] mt-10 shadow-sm shadow-[#F5A623]/10 relative hover:shadow-md hover:shadow-[#F5A623]/15 transition-all duration-300">
                        <span class="material-symbols-outlined absolute top-4 right-4 text-4xl text-slate-200" style="font-variation-settings: 'FILL' 1;">format_quote</span>
                        <p class="italic text-[#0A1128] font-bold mb-6 relative z-10 text-base leading-relaxed">
                            "Nous n'avons pas seulement apporté de l'aide matérielle, nous avons apporté la preuve que ces familles ne sont pas oubliées. Vos dons ont changé leur quotidien de manière durable."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-slate-200 to-slate-300 border-2 border-white shadow-sm shadow-[#F5A623]/20 flex items-center justify-center text-[#0A1128] font-black text-sm">
                                @if($project->association->profilePhoto)
                                    <img src="{{ asset('storage/' . $project->association->profilePhoto) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($project->association->name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="font-black text-[#0A1128] text-sm flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px] text-[#F5A623]">verified_user</span>
                                    {{ $project->association->name }}
                                </p>
                                <p class="text-[10px] uppercase tracking-widest font-bold text-slate-400">Association porteuse du projet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 reveal" style="transition-delay: 160ms;">
                <div class="neu-card-static p-8 sticky top-28 shadow-xl shadow-[#F5A623]/10 hover:shadow-2xl hover:shadow-[#F5A623]/15 transition-all duration-300">
                    <h3 class="text-lg font-black text-[#0A1128] mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#F5A623]" style="font-variation-settings: 'FILL' 1;">pie_chart</span>
                        Transparence Financière
                    </h3>

                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-8">
                        Coût total financé : <strong class="text-[#0A1128] text-sm">{{ number_format($project->currentAmount, 0, ',', ' ') }} DH</strong>
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-2 h-12 bg-[#F5A623] rounded-full group-hover/item:shadow-lg group-hover/item:shadow-[#F5A623]/30 transition-all duration-300"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0A1128]">Matériel & Équipements</span>
                                    <span class="text-[10px] font-black text-slate-400">60%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#F5A623] w-[60%] shadow-sm shadow-[#F5A623]/30"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-2 h-12 bg-[#0A1128] rounded-full group-hover/item:shadow-lg group-hover/item:shadow-[#0A1128]/30 transition-all duration-300"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0A1128]">Exécution & Main d'œuvre</span>
                                    <span class="text-[10px] font-black text-slate-400">25%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#0A1128] w-[25%] shadow-sm shadow-[#0A1128]/30"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group/item">
                            <div class="w-2 h-12 bg-emerald-500 rounded-full group-hover/item:shadow-lg group-hover/item:shadow-emerald-500/30 transition-all duration-300"></div>
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0A1128]">Logistique & Transport</span>
                                    <span class="text-[10px] font-black text-slate-400">15%</span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-emerald-500 w-[15%] shadow-sm shadow-emerald-500/30"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Visual Proofs Section -->
        <section class="bg-slate-50 px-8 lg:px-20 py-24 border-y border-slate-100">
            <div class="max-w-7xl mx-auto">
                <div class="mb-12 reveal">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#F5A623] mb-3 block flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">verified</span>
                        100% Vérifiable
                    </span>
                    <h2 class="text-4xl font-black text-[#0A1128] tracking-tight">Preuves Visuelles du Terrain</h2>
                </div>

                @if($project->videoUrl)
                    <div class="mb-10 rounded-[2rem] overflow-hidden shadow-2xl shadow-[#F5A623]/20 aspect-video relative border-[6px] border-white reveal group image-zoom">
                        <iframe
                            class="absolute top-0 left-0 w-full h-full"
                            src="{{ str_replace('watch?v=', 'embed/', $project->videoUrl) }}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-6 h-auto md:h-[600px] reveal">

                    <div class="md:col-span-2 md:row-span-2 relative rounded-[1.5rem] overflow-hidden group min-h-[300px] image-zoom shadow-lg shadow-[#F5A623]/20 border border-white">
                        @if($impactReport->image)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $impactReport->image) }}" alt="Preuve Terrain Principale"/>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#0A1128] to-[#162040] flex items-center justify-center text-[#F5A623]/20 font-black text-6xl">AK</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/95 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-8 flex flex-col justify-end">
                            <p class="text-white font-black text-xl">Achèvement Confirmé</p>
                            <p class="text-[#F5A623] text-[10px] font-black uppercase tracking-widest mt-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                Archive Officielle
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative rounded-[1.5rem] overflow-hidden group min-h-[200px] image-zoom shadow-lg shadow-[#F5A623]/15 border border-white">
                        @if($project->image)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $project->image) }}" alt="État Initial"/>
                        @else
                            <div class="w-full h-full bg-slate-200 flex items-center justify-center text-white font-black text-2xl">AK</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <p class="text-white font-black text-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">photo_camera</span>
                                État Initial
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:row-span-1 relative rounded-[1.5rem] overflow-hidden group min-h-[200px] image-zoom shadow-lg shadow-[#F5A623]/15 border border-white">
                        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=800&auto=format&fit=crop" alt="Solidarité"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <p class="text-white font-black text-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">groups</span>
                                Impact Communautaire
                            </p>
                        </div>
                    </div>

                    <div class="md:col-span-2 md:row-span-1 relative rounded-[1.5rem] overflow-hidden group min-h-[200px] image-zoom shadow-lg shadow-[#F5A623]/15 border border-white">
                        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=2070&auto=format&fit=crop" alt="Solidarité 2"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-6 flex flex-col justify-end">
                            <p class="text-white font-black text-sm flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">local_shipping</span>
                                Organisation Logistique
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Donators Section & CTA -->
        <section class="bg-gradient-to-br from-[#0A1128] via-[#162040] to-[#0f1a35] text-white py-24 px-8 lg:px-20 overflow-hidden relative reveal">
            <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-[#F5A623]/12 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -top-20 w-96 h-96 bg-[#FFD085]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#F5A623] mb-4 block flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">favorite</span>
                    Unité & Générosité
                </span>
                <h2 class="text-4xl md:text-5xl font-black mb-12 tracking-tight">Merci aux <span class="gradient-text">{{ $project->donations->unique('donator_id')->count() }} Héros</span></h2>

                <div class="border-y border-white/10 py-16 mb-16">
                    <p class="text-white/40 text-[10px] font-black uppercase tracking-widest mb-8 text-center flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">person</span>
                        Les Donateurs de ce Projet (Aperçu)
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach($project->donations->unique('donator_id')->take(12) as $donation)
                            <span class="bg-white/5 px-4 py-2 rounded-xl border border-white/10 text-xs font-bold text-white/90 hover:bg-white/10 hover:border-white/20 transition-all duration-300 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">verified_user</span>
                                {{ $donation->isAnonymous ? 'Donateur Anonyme' : ($donation->donator->name ?? 'Anonyme') }}
                            </span>
                        @endforeach
                        @if($project->donations->unique('donator_id')->count() > 12)
                            <span class="bg-[#F5A623] text-[#0A1128] px-4 py-2 rounded-xl text-xs font-black hover:bg-white transition-all duration-300 flex items-center gap-1 shadow-lg shadow-[#F5A623]/30">
                                <span class="material-symbols-outlined text-[14px]">add_circle</span>
                                + {{ $project->donations->unique('donator_id')->count() - 12 }} autres
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('impact.pdf', $impactReport->id) }}" class="inline-flex items-center gap-3 bg-white/10 border border-white/20 text-white font-bold text-xs uppercase tracking-wider px-8 py-4 rounded-xl hover:bg-white/20 transition-all hover:shadow-lg hover:shadow-white/10 duration-300">
                        <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                        Télécharger le Rapport
                    </a>
                    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-3 bg-[#F5A623] text-[#0A1128] font-black text-xs uppercase tracking-wider px-8 py-4 rounded-xl hover:bg-white transition-all shadow-xl shadow-[#F5A623]/30 hover:shadow-2xl hover:shadow-[#F5A623]/40 duration-300">
                        Soutenir un autre projet <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </div>
        </section>

        @include('partials.footer')

    </main>

    <script>
        // Enhanced Reveal animation on scroll with improved easing
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

        // Parallax effect for hero images
        window.addEventListener('scroll', () => {
            const hero = document.querySelector('main > section:first-child');
            if (hero) {
                const scrollY = window.scrollY;
                const bgImage = hero.querySelector('img');
                if (bgImage) {
                    bgImage.style.transform = `translateY(${scrollY * 0.5}px)`;
                }
            }
        });
    </script>
</body>
</html>
