<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Catégories - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Gestion des Catégories</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">Retour au Dashboard</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-gray-50 p-4 rounded border mb-8">
            <h2 class="text-lg font-semibold mb-3">Ajouter une nouvelle catégorie</h2>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="flex items-center space-x-4">
                @csrf
                <div class="flex-1">
                    <input type="text" name="name" required placeholder="Ex: Santé, Éducation, Environnement..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                    Ajouter
                </button>
            </form>
        </div>

        <h2 class="text-xl font-semibold mb-3">Liste des catégories</h2>
        @if($categories->count() > 0)
            <table class="w-full text-left border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nom de la Catégorie</th>
                        <th class="p-3 border text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border text-gray-500">{{ $category->id }}</td>
                            <td class="p-3 border font-medium">{{ $category->name }}</td>
                            <td class="p-3 border text-right">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">
                                    @csrf
                                    @method('DELETE') <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Aucune catégorie n'est enregistrée pour le moment.</p>
        @endif
    </div>

</body>
</html>
