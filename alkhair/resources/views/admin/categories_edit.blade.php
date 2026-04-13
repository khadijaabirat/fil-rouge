<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une Catégorie - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md border-t-4 border-blue-500">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Modifier la Catégorie</h1>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nom de la Catégorie</label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="w-full border-gray-300 rounded-md p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('admin.categories.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Annuler</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

</body>
</html>
