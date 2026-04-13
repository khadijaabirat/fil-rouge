<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AL-KHAIR - Plateforme de Dons Solidaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-green-600">AL-KHAIR</span>
            </div>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-green-600 font-medium">Mon Espace</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium mr-4">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 transition">S'inscrire</a>
                @endauth
            </div>
        </div>
    </header>

    <section class="bg-green-50 py-20 border-b border-green-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Chaque don compte, <span class="text-green-600">chaque action transforme des vies.</span>
            </h1>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                AL-KHAIR est une plateforme marocaine de financement participatif solidaire. Soutenez des projets d'associations vérifiées et suivez l'impact de vos dons en toute transparence.
            </p>
            <a href="#projets" class="bg-green-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-green-700 transition shadow-lg">
                Découvrir les projets
            </a>
        </div>
    </section>

    <section id="projets" class="py-16 max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Projets Solidaires en Cours</h2>
        <p class="text-gray-500 text-center mb-10">Choisissez une cause qui vous tient à cœur et faites un don.</p>

        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-8 max-w-4xl mx-auto">
            <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un projet par nom..." class="w-full border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <div class="w-full md:w-48">
                    <select name="category" class="w-full border-gray-300 rounded-md p-2 focus:ring-green-500 focus:border-green-500">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-medium">
                    Filtrer
                </button>

                <a href="{{ url()->current() }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-200 transition text-center border">
                    Réinitialiser
                </a>
            </form>
        </div>
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                        <div class="p-6">
                            <span class="text-xs font-bold bg-green-100 text-green-800 px-2 py-1 rounded mb-4 inline-block">Ouvert aux dons</span>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-500 mb-4">Par : <strong>{{ $project->association->name ?? 'Association' }}</strong></p>
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3">{{ $project->description }}</p>

                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1 font-medium">
                                    <span>{{ $project->currentAmount }} DH</span>
                                    <span>Objectif : {{ $project->goalAmount }} DH</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $percentage = ($project->goalAmount > 0) ? ($project->currentAmount / $project->goalAmount) * 100 : 0;
                                        $percentage = min($percentage, 100);
                                    @endphp
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>

                            @auth
                                @if(Auth::user()->role === 'donator')
                                    <a href="{{ route('donations.create', $project->id) }}" class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Faire un don</a>
                                @else
                                    <button disabled class="block w-full text-center bg-gray-300 text-gray-500 px-4 py-2 rounded cursor-not-allowed">Connectez-vous comme Donateur</button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full text-center border-2 border-green-600 text-green-600 px-4 py-2 rounded hover:bg-green-50 transition font-medium">Connectez-vous pour donner</a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-10 bg-white rounded-lg shadow-sm mt-4">
                <p class="text-gray-500 text-lg">Aucun projet ne correspond à votre recherche pour le moment.</p>
            </div>
        @endif
    </section>

    <footer class="bg-gray-900 text-gray-400 py-8 text-center mt-12">
        <p>&copy; 2026 AL-KHAIR - Projet YouCode Fil Rouge par Khadija.</p>
    </footer>

</body>
</html>
