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

        @if($association->status === 'PENDING')
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4 border border-yellow-300">
                <strong>Attention :</strong> Votre compte est en cours de vérification par l'administration.
                Vous ne pourrez créer des projets qu'après validation de vos documents KYC.
            </div>

        @elseif($association->status === 'ACTIVE')
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                Votre compte est validé. Vous pouvez maintenant gérer vos projets.
            </div>

            <div class="mb-6">
                <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Créer un nouveau projet
                </a>
            </div>

            <h2 class="text-xl font-semibold mb-3">Mes Projets</h2>
            @if($projects->count() > 0)
                <ul class="list-disc pl-5">
                    @foreach($projects as $project)
                        <li class="mb-2">
                            <strong>{{ $project->title }}</strong> - Objectif : {{ $project->goalAmount }} DH
                            <span class="text-sm text-gray-500">(Statut: {{ $project->status }})</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Vous n'avez créé aucun projet pour le moment.</p>
            @endif
        @endif

        <form method="POST" action="{{ route('logout') }}" class="mt-8 border-t pt-4">
            @csrf
            <button type="submit" class="text-red-500 underline">Se déconnecter</button>
        </form>
    </div>

</body>
</html>
