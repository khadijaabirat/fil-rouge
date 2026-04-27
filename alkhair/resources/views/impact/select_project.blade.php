<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sélectionner un Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { vertical-align: middle; }
    </style>
</head>
<body class="bg-slate-50">
    <div class="min-h-screen py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('association.dashboard') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-[#0A1128] mb-4 font-bold text-sm">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    Retour au tableau de bord
                </a>
                <h1 class="text-4xl font-black text-[#0A1128] mb-3">Publier un Rapport d'Impact</h1>
                <p class="text-slate-600">Sélectionnez le projet pour lequel vous souhaitez publier un rapport d'impact</p>
            </div>

            @if($projectsNeedingReport->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($projectsNeedingReport as $project)
                        @php
                            $hasReceived = $project->donations->where('status', 'RECEIVED')->isNotEmpty();
                            $isCompleted = $project->status === 'COMPLETED';
                            $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                            $percentage = min($percentage, 100);
                        @endphp

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-lg transition-all">
                            <!-- Project Image -->
                            <div class="h-40 relative overflow-hidden bg-slate-100">
                                @if($project->image)
                                    <img src="{{ asset('storage/' . str_replace(' ', '%20', $project->image)) }}" class="w-full h-full object-cover" alt="{{ $project->title }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#0A1128]/20 to-[#F5A623]/20 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-[#0A1128]/30">image</span>
                                    </div>
                                @endif

                                <!-- Badge -->
                                @if($hasReceived)
                                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-lg">
                                        <span class="material-symbols-outlined text-[14px] align-middle mr-1">warning</span>
                                        Fonds reçus
                                    </div>
                                @elseif($isCompleted)
                                    <div class="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-lg">
                                        <span class="material-symbols-outlined text-[14px] align-middle mr-1">check_circle</span>
                                        Complété
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-black text-[#0A1128] mb-2 line-clamp-1">{{ $project->title }}</h3>
                                <p class="text-sm text-slate-500 mb-4 line-clamp-2">{{ $project->description }}</p>

                                <!-- Progress -->
                                <div class="mb-4 bg-slate-50 rounded-xl p-3 border border-slate-100">
                                    <div class="flex justify-between text-xs font-bold mb-2">
                                        <span class="text-[#0A1128]">{{ number_format($project->currentAmount, 0) }} DH</span>
                                        <span class="text-[#F5A623]">{{ number_format($percentage, 0) }}%</span>
                                    </div>
                                    <div class="h-2 w-full bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-[#F5A623] to-[#FFD085]" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="flex items-center justify-between mb-4 text-xs text-slate-500">
                                    <span>Objectif: <strong class="text-[#0A1128]">{{ number_format($project->goalAmount, 0) }} DH</strong></span>
                                    <span>Dons: <strong class="text-[#0A1128]">{{ $project->donations->count() }}</strong></span>
                                </div>

                                <!-- Action -->
                                <a href="{{ route('impact.create', $project->id) }}" class="w-full block text-center bg-[#0A1128] text-white py-3 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-md">
                                    <span class="material-symbols-outlined text-[18px] align-middle mr-2">add_circle</span>
                                    Publier le rapport
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-sm border-2 border-dashed border-slate-200 p-16 text-center">
                    <div class="w-20 h-20 mx-auto bg-emerald-50 rounded-3xl flex items-center justify-center mb-6 border border-emerald-100">
                        <span class="material-symbols-outlined text-4xl text-emerald-600">check_circle</span>
                    </div>
                    <h3 class="text-2xl font-black text-[#0A1128] mb-3">Aucun rapport en attente</h3>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto">Tous vos projets complétés ont déjà leur rapport d'impact publié. Excellent travail !</p>
                    <a href="{{ route('association.dashboard') }}" class="inline-flex items-center gap-2 bg-[#0A1128] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-md">
                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        Retour au tableau de bord
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
