<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Donateur - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Espace Donateur : Bonjour {{ $donator->name }}</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline">Se déconnecter</button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Projets solidaires en cours</h2>

        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                    <div class="border rounded-lg p-5 shadow-sm hover:shadow-md transition">
                        <h3 class="text-lg font-bold text-blue-600 mb-2">{{ $project->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">Par : <strong>{{ $project->association->name ?? 'Association' }}</strong></p>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">{{ $project->description }}</p>

                        <div class="mb-2">
                            <div class="flex justify-between text-xs text-gray-600 mb-1">
                                <span>Collecté : {{ $project->currentAmount }} DH</span>
                                <span>Objectif : {{ $project->goalAmount }} DH</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                @php
                                    $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                    $percentage = min($percentage, 100);
                                @endphp
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('donations.create', $project->id) }}" class="inline-block w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Faire un don
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 p-6 rounded text-center text-gray-500">
                Aucun projet n'est ouvert aux dons pour le moment.
            </div>
        @endif

    </div>

</body>
</html>
