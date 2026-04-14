<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-green-600 tracking-tight">AL-KHAIR</a>

            <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-green-600 font-medium flex items-center transition">
                &larr; Retour
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">

        <div class="mb-8">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($project->status === 'OPEN')
                    <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm"> En cours</span>
                @elseif($project->status === 'COMPLETED')
                    <span class="bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm"> Objectif Atteint</span>
                @elseif($project->status === 'CLOSED')
                    <span class="bg-gray-200 text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm"> Clôturé</span>
                @elseif($project->status === 'SUSPENDED')
                    <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm"> Suspendu</span>
                @endif
            </div>
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">{{ $project->title }}</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                @if($project->videoUrl)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                             Vidéo de présentation
                        </h2>
                        <a href="{{ $project->videoUrl }}" target="_blank" class="flex items-center justify-center w-full bg-red-50 hover:bg-red-100 text-red-700 py-4 rounded-xl transition font-bold border border-red-200 shadow-sm">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            Regarder la vidéo du projet
                        </a>
                    </div>
                @endif

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">À propos de ce projet</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line text-lg">
                        {{ $project->description }}
                    </div>
                </div>

                <div class="bg-green-50 p-6 md:p-8 rounded-2xl border border-green-100 flex flex-col sm:flex-row items-center gap-6">
                    <div class="flex-shrink-0">
                        @if(isset($project->association) && $project->association->profilePhoto)
                            <img src="{{ asset('storage/' . $project->association->profilePhoto) }}" alt="Logo" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                        @else
                            <div class="w-24 h-24 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold text-3xl border-4 border-white shadow-md">
                                {{ substr($project->association->name ?? 'A', 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="text-center sm:text-left">
                        <span class="text-sm font-bold text-green-600 uppercase tracking-wider">Porteur du projet</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $project->association->name ?? 'Association Inconnue' }}</h3>
                        <p class="text-gray-600 text-sm mt-2">{{ $project->association->description ?? 'Une association engagée pour la solidarité et le développement.' }}</p>
                        @if(isset($project->association) && $project->association->ville)
                            <p class="text-gray-500 text-sm mt-3 font-medium bg-white inline-block px-3 py-1 rounded-full border border-gray-200">
                                  Basée à {{ $project->association->ville }}
                            </p>
                        @endif
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 sticky top-24">

                    @php
                         $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                        $percentage = min($percentage, 100);

                         $endDate = \Carbon\Carbon::parse($project->endDate)->endOfDay();
                        $now = \Carbon\Carbon::now();
                        $daysLeft = $now->diffInDays($endDate, false);
                        $isExpired = $daysLeft < 0;
                    @endphp

                    <div class="mb-6">
                        <div class="flex items-baseline gap-2 mb-2">
                            <span class="text-4xl font-extrabold text-gray-900">{{ number_format($project->currentAmount, 0, ',', ' ') }} <span class="text-2xl">DH</span></span>
                        </div>
                        <p class="text-gray-500 font-medium mb-4">collectés sur un objectif de {{ number_format($project->goalAmount, 0, ',', ' ') }} DH</p>

                        <div class="w-full bg-gray-100 rounded-full h-3 mb-2 overflow-hidden shadow-inner">
                            <div class="bg-green-500 h-3 rounded-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                        </div>

                        <div class="flex justify-between text-sm font-bold text-gray-600 mt-3">
                            <span>{{ number_format($percentage, 1) }}% financé</span>
                            @if(!$isExpired && $project->status === 'OPEN')
                                <span class="text-orange-500 bg-orange-50 px-2 py-1 rounded">  {{ floor($daysLeft) }} jours restants</span>
                            @else
                                <span class="text-red-500 bg-red-50 px-2 py-1 rounded">Campagne terminée</span>
                            @endif
                        </div>
                    </div>

                    @if($project->status === 'OPEN' && !$isExpired)
                        <a href="{{ route('donations.create', $project->id) }}" class="block w-full text-center bg-blue-600 text-white text-lg font-bold py-4 rounded-xl shadow-md hover:bg-blue-700 hover:shadow-xl transition-all transform hover:-translate-y-1">
                            Soutenir ce projet
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-4 flex items-center justify-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                            Paiement 100% sécurisé (Stripe)
                        </p>
                    @elseif($project->status === 'COMPLETED')
                        <button disabled class="w-full bg-purple-100 text-purple-700 font-bold py-4 rounded-xl cursor-not-allowed border border-purple-200">
                            Objectif atteint ! Merci
                        </button>
                    @else
                        <button disabled class="w-full bg-gray-100 text-gray-500 font-bold py-4 rounded-xl cursor-not-allowed border border-gray-200">
                            Les dons sont fermés
                        </button>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="font-bold text-gray-800 text-sm mb-4 uppercase tracking-wider">La garantie AL-KHAIR</h4>
                        <ul class="space-y-3 text-sm text-gray-600 font-medium">
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 text-lg leading-none">✓</span>
                                Association légale et vérifiée
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 text-lg leading-none">✓</span>
                                Rapport d'impact obligatoire après le projet
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 text-lg leading-none">✓</span>
                                Vos dons arrivent directement à la cause
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="font-bold text-gray-800 text-sm mb-5 uppercase tracking-wider flex items-center gap-2">
                            <span>🤝</span> Derniers soutiens
                        </h4>

                        @if($project->donations->count() > 0)
                            <ul class="space-y-4">
                                @foreach($project->donations as $donation)
                                    <li class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                                        <div class="w-10 h-10 rounded-full {{ $donation->isAnonymous ? 'bg-gray-200 text-gray-500' : 'bg-blue-100 text-blue-600' }} flex items-center justify-center font-bold text-lg flex-shrink-0 shadow-sm">
                                            {{ $donation->isAnonymous ? '?' : strtoupper(substr($donation->donator->name ?? 'A', 0, 1)) }}
                                        </div>

                                        <div>
                                            <p class="text-sm font-bold text-gray-800">
                                                {{ $donation->isAnonymous ? 'Un donateur anonyme' : ($donation->donator->name ?? 'Donateur') }}
                                            </p>
                                            <p class="text-xs text-gray-500 mt-0.5">
                                                A fait un don de <span class="font-bold text-green-600">{{ $donation->amount }} DH</span>
                                            </p>
                                            <p class="text-[10px] text-gray-400 mt-0.5">
                                                il y a {{ $donation->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="bg-gray-50 p-4 rounded-xl text-center border border-dashed border-gray-300">
                                <p class="text-sm text-gray-500 font-medium">Soyez le premier à soutenir ce projet ! ❤️</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
