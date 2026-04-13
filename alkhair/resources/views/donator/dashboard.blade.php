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
<div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-8">
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

        <a href="{{ url()->current() }}" class="bg-gray-100 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-200 transition text-center">
            Réinitialiser
        </a>
    </form>
</div>
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
<h2 class="text-2xl font-bold text-gray-800 mt-12 mb-6">Mon Historique de Dons</h2>

        @if(isset($myDonations) && $myDonations->count() > 0)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700">
                                <th class="p-4 border-b">Date</th>
                                <th class="p-4 border-b">Projet</th>
                                <th class="p-4 border-b">Montant</th>
                                <th class="p-4 border-b">Type</th>
                                <th class="p-4 border-b">Statut du don</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myDonations as $donation)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 border-b text-sm text-gray-600">
                                        {{ $donation->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="p-4 border-b font-medium text-gray-800">
                                        {{ $donation->project->title ?? 'Projet supprimé' }}
                                    </td>
                                    <td class="p-4 border-b font-bold text-green-600">
                                        {{ $donation->amount }} DH
                                    </td>
                                    <td class="p-4 border-b text-sm">
                                        @if($donation->payment && strtoupper($donation->payment->paymentMethod) === 'ONLINE')
                                            <span class="text-blue-600 font-medium flex items-center gap-1">
                                                  En ligne (Stripe)
                                            </span>
                                        @else
                                            <span class="text-gray-600 font-medium flex items-center gap-1">
                                                 Manuel (Virement)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 border-b text-sm font-bold">
                                        @if($donation->status === 'PENDING')
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">En attente (Validation)</span>
                                        @elseif($donation->status === 'VALIDATED')
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Validé</span>
                                        @elseif($donation->status === 'PROCESSING')
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">Transfert en cours</span>
                                        @elseif($donation->status === 'RECEIVED')
                                            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded">Reçu par l'association</span>
                                        @elseif($donation->status === 'IMPACT')
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded border border-purple-300">🌟 Impact Réalisé</span>
                                        @elseif($donation->status === 'FAILED')
                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded">Refusé / Échoué</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200 text-center mb-10">
                <p class="text-gray-500 text-lg">Vous n'avez pas encore fait de don. Explorez les projets ci-dessus !</p>
            </div>
        @endif
    </div>

</body>
</html>
