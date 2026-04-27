<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Merci pour votre don | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f0f2f5; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        
        .neu-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); transition: all 0.4s cubic-bezier(.4,0,.2,1); }
        .neu-card-static { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(.4,0,.2,1); }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-[#e8ecf3] text-slate-700 antialiased min-h-screen selection:bg-[#F5A623] selection:text-white">
<main class="flex flex-col lg:flex-row min-h-screen">
    
    <section class="lg:w-1/2 relative min-h-[400px] lg:min-h-screen flex items-center justify-center overflow-hidden">
        <img alt="Impact" class="absolute inset-0 w-full h-full object-cover" 
             src="{{ $donation->project->image ? asset('storage/' . $donation->project->image) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=2070&auto=format&fit=crop' }}"/>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0A1128]/90 via-[#0A1128]/60 to-transparent"></div>
        <div class="absolute inset-0 bg-[#0A1128]/30"></div>
        
        <div class="relative z-10 text-center px-8 max-w-xl">
            <div class="inline-flex items-center justify-center w-20 h-20 mb-8 bg-[#F5A623] rounded-3xl shadow-2xl shadow-[#F5A623]/30 animate-bounce">
                <span class="material-symbols-outlined text-4xl text-[#0A1128]" style="font-variation-settings: 'FILL' 1;">favorite</span>
            </div>
            <h1 class="font-black text-5xl md:text-7xl tracking-tight text-white mb-6">
                Merci pour votre générosité
            </h1>
            <p class="text-xl text-white/90 leading-relaxed font-medium">
                Votre don est un phare d'espoir pour les communautés bénéficiaires.
            </p>
        </div>
    </section>

    <section class="lg:w-1/2 bg-white flex flex-col p-8 md:p-12 lg:p-20 overflow-y-auto h-screen">
        <div class="max-w-xl mx-auto w-full space-y-10 mt-auto mb-auto">
            
            <a href="{{ url('/') }}" class="flex items-center group mb-4">
                <x-application-logo class="w-14 h-14 text-[#0A1128] group-hover:scale-105 transition-transform" />
            </a>
            
            @if($donation->status === 'PENDING')
                <div class="neu-card-static border-l-4 border-amber-500 text-amber-800 p-5 flex items-start gap-3 bg-amber-50/50 reveal active">
                    <span class="material-symbols-outlined text-amber-500 mt-0.5">hourglass_top</span>
                    <div>
                        <h4 class="font-black text-[#0A1128] text-sm uppercase tracking-wider">Don en attente de validation</h4>
                        <p class="text-xs mt-1 text-slate-600 leading-relaxed">Nous avons bien reçu votre reçu de virement. Notre équipe va le valider dans les plus brefs délais pour l'ajouter au projet.</p>
                    </div>
                </div>
            @else
                <div class="neu-card-static border-l-4 border-emerald-500 text-emerald-800 p-5 flex items-start gap-3 bg-emerald-50/50 reveal active">
                    <span class="material-symbols-outlined text-emerald-500 mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <div>
                        <h4 class="font-black text-[#0A1128] text-sm uppercase tracking-wider">Paiement réussi</h4>
                        <p class="text-xs mt-1 text-slate-600 leading-relaxed">Votre don a été traité avec succès et ajouté au total du projet.</p>
                    </div>
                </div>
            @endif

            <div class="neu-card-static p-8 md:p-10 border border-slate-100 reveal" style="animation-delay: 0.1s">
                <div class="flex justify-between items-start mb-8 pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-[10px] font-black tracking-widest text-[#F5A623] uppercase mb-1 block">Reçu Officiel</span>
                        <h2 class="text-3xl font-black text-[#0A1128]">Résumé du Don</h2>
                    </div>
                    <div class="text-right">
                        <span class="text-slate-400 text-[10px] font-bold block uppercase tracking-wider">Date</span>
                        <span class="font-bold text-sm text-[#0A1128]">{{ $donation->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                
                <div class="space-y-6 mb-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                        <span class="text-slate-500 font-bold text-sm">Montant Contribué</span>
                        <span class="text-4xl font-black text-[#0A1128]">{{ number_format($donation->amount, 0, ',', ' ') }} <span class="text-[#F5A623] text-2xl">DH</span></span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <span class="text-slate-500 font-bold text-xs">Projet Soutenu</span>
                        <span class="font-black text-right text-[#0A1128] max-w-[200px] truncate" title="{{ $donation->project->title }}">
                            {{ $donation->project->title }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between px-2">
                        <span class="text-slate-500 font-bold text-xs">N° de Suivi</span>
                        <span class="font-mono text-xs font-black text-slate-400 bg-slate-100 px-2 py-1 rounded">#DON-{{ str_pad($donation->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>

                <div class="space-y-6 pt-8 border-t border-slate-100">
                    <h3 class="text-lg font-black text-[#0A1128] flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#F5A623]">history_edu</span>
                        Transparence & Traçabilité
                    </h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-[#F5A623] shadow-sm shadow-[#F5A623]"></div>
                                <div class="w-0.5 h-full bg-slate-200"></div>
                            </div>
                            <div class="pb-2">
                                <h4 class="font-black text-[#0A1128] text-xs uppercase tracking-wider">Déploiement en temps réel</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">L'association est notifiée immédiatement de votre contribution.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-slate-300"></div>
                                <div class="w-0.5 h-full bg-slate-200"></div>
                            </div>
                            <div class="pb-2">
                                <h4 class="font-black text-[#0A1128] text-xs uppercase tracking-wider">Vérification sur le terrain</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Suivi de l'évolution du projet via votre tableau de bord.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-3 h-3 rounded-full bg-slate-300"></div>
                            </div>
                            <div>
                                <h4 class="font-black text-[#0A1128] text-xs uppercase tracking-wider">Rapport d'Impact</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Rapport de transparence envoyé à la fin du projet avec preuves.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-4 reveal" style="animation-delay: 0.2s">
                <a href="{{ route('donator.dashboard') }}" class="flex-1 px-8 py-4 bg-[#0A1128] text-white font-black rounded-xl text-center hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-lg active:scale-[0.98] text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    Tableau de bord
                </a>
                <a href="{{ route('projects.index') }}" class="flex-1 px-8 py-4 bg-white border-2 border-slate-200 text-slate-600 font-black rounded-xl text-center hover:bg-slate-50 hover:border-slate-300 hover:text-[#0A1128] transition-all shadow-sm active:scale-[0.98] text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">explore</span>
                    Explorer
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    // Scroll reveal animation
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>