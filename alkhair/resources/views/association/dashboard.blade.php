<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Association - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Espace Association : {{ $association->name }}</h1>
<div class="space-x-3">
                <a href="{{ route('association.profile') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition shadow-sm">
                    Mon Profil & RIB
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Se déconnecter</button>
                </form>
            </div>
        @if($association->status === 'PENDING')
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4 border border-yellow-300">
                <strong>Attention :</strong> Votre compte est en cours de vérification par l'administration.
                Vous ne pourrez créer des projets qu'après validation de vos documents KYC.
            </div>

        @elseif($association->status === 'ACTIVE')
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                Votre compte est validé. Vous pouvez maintenant gérer vos projets.
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @php
             $hasPendingReports = \App\Models\Project::where('association_id', $association->id)
                ->whereHas('donations', function ($query) {
                    $query->where('status', 'RECEIVED');
                })->exists();
        @endphp

        <div class="mb-8">
            @if($hasPendingReports)
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 font-bold">
                                Création de projet bloquée !
                            </p>
                            <p class="text-sm text-red-600 mt-1">
                                Vous avez reçu des fonds pour un ou plusieurs projets. Vous devez obligatoirement publier leur <a href="#projets" class="underline font-bold">Rapport d'Impact</a> avant de pouvoir lancer une nouvelle campagne de collecte.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('projects.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-medium shadow-sm inline-block">
                    + Créer un nouveau projet
                </a>
            @endif
        <!-- </div> -->

<h2 id="projets" class="text-xl font-semibold mb-3">Mes Projets</h2>            @if($projects->count() > 0)
                <ul class="list-disc pl-5">
                    @foreach($projects as $project)
                        <li class="mb-4 p-4 border rounded bg-gray-50">
                            <div class="flex justify-between items-center mb-2">
                                <strong>{{ $project->title }}</strong>
                                <span class="text-sm px-2 py-1 rounded {{ $project->status === 'OPEN' ? 'bg-green-100 text-green-800' : ($project->status === 'COMPLETED' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                    Statut: {{ $project->status }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mb-2">
                                Collecté : <strong>{{ $project->currentAmount }} DH</strong> sur {{ $project->goalAmount }} DH
                            </p>
                            <p class="text-sm text-gray-600 mb-2">
                                Date de fin : <strong>{{ \Carbon\Carbon::parse($project->endDate)->format('d/m/Y') }}</strong>
                            </p>

                            @php
                                 $isExpired = \Carbon\Carbon::now()->greaterThan($project->endDate);
                                 $isFullyFunded = $project->currentAmount >= $project->goalAmount;
                            @endphp

                            @if($isExpired && !$isFullyFunded)
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-sm text-yellow-800 mb-2"> Le délai est expiré et l'objectif n'est pas atteint.</p>
                                    <form action="{{ route('projects.extend', $project->id) }}" method="POST" class="flex items-center space-x-2">
                                        @csrf
                                        <input type="date" name="newEndDate" required class="border-gray-300 rounded-md shadow-sm p-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                                        <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                            Prolonger le délai
                                        </button>
                                    </form>
                                </div>
                            @endif

                            @if($project->status === 'COMPLETED')
                                @php
                                    $hasProcessing = $project->donations()->where('status', 'PROCESSING')->exists();
                                    $hasReceived = $project->donations()->where('status', 'RECEIVED')->exists();
                                    $hasReport = \App\Models\ImpactReport::where('project_id', $project->id)->exists();
                                @endphp

                                @if($hasReport)
                                    <div class="mt-3 p-3 bg-gray-100 border border-gray-300 rounded">
                                        <p class="text-sm text-gray-700 font-bold">Mission accomplie ! Rapport d'impact publié.</p>
                                    </div>
                                @elseif($hasReceived)
                                    <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-blue-800 font-bold"> Fonds reçus ! N'oubliez pas de publier le rapport d'impact.</p>
                                        <a href="{{ route('impact.create', $project->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Publier le rapport
                                        </a>
                                    </div>
                                @elseif($hasProcessing)
                                    <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                        <p class="text-sm text-yellow-800"> Demande de retrait en cours de traitement par l'administration.</p>
                                    </div>
                                @else
                                    <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded flex justify-between items-center">
                                        <p class="text-sm text-green-800"> Objectif atteint ! Vous pouvez retirer les fonds.</p>
                                        <form action="{{ route('association.withdraw', $project->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                                                Demander les fonds
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif

                        </li>
                    @endforeach
                </ul>
            @else
                <div class="bg-white p-12 rounded-2xl text-center border-2 border-dashed border-gray-300 shadow-sm">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucun projet créé</h3>
                    <p class="text-gray-500 mb-4">Vous n'avez créé aucun projet pour le moment.</p>
                    <p class="text-sm text-gray-400">Cliquez sur le bouton ci-dessus pour lancer votre première campagne de collecte !</p>
                </div>
            @endif
        @endif


    </div>

</body>
</html>
