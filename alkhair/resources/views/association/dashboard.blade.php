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

            <div class="mb-6">
                <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Créer un nouveau projet
                </a>
            </div>

            <h2 class="text-xl font-semibold mb-3">Mes Projets</h2>
            @if($projects->count() > 0)
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
                <p class="text-gray-500">Vous n'avez créé aucun projet pour le moment.</p>
            @endif
        @endif

        
    </div>

</body>
</html>
