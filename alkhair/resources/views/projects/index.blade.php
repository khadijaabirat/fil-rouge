<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Découvrir les Projets - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-green-600">AL-KHAIR</a>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium">Connexion</a>
                <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">S'inscrire</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Projets Solidaires</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explorez les initiatives locales et contribuez à faire la différence. Chaque don compte.</p>
        </div>

        @if(session('success'))
            <div class="max-w-4xl mx-auto bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 flex flex-col">

                    <div class="h-48 bg-gray-200 relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                            {{ $project->category->name ?? 'Général' }}
                        </span>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $project->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $project->description }}
                        </p>

                        <div class="mt-auto">
                            <div class="flex justify-between text-xs font-bold text-gray-500 mb-1">
                                <span>{{ number_format($project->currentAmount, 0) }} DH</span>
                                <span>Objectif: {{ number_format($project->goalAmount, 0) }} DH</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden mb-4">
                                @php
                                    $percent = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                    $percent = min($percent, 100);
                                @endphp
                                <div class="bg-green-500 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>

                            <a href="{{ route('projects.show', $project->id) }}" class="block text-center w-full border-2 border-green-600 text-green-600 font-bold py-2 rounded-xl hover:bg-green-600 hover:text-white transition duration-200">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
                    <p class="text-gray-500 text-xl italic">Aucun projet disponible pour le moment. Revenez bientôt !</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $projects->links() }}
        </div>

    </main>

    <footer class="bg-white border-t py-8 mt-20">
        <div class="text-center text-gray-500 text-sm">
            &copy; 2026 AL-KHAIR. Plateforme de solidarité au Maroc.
        </div>
    </footer>

</body>
</html>
