<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Créer un nouveau projet</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-gray-700 underline">Retour au tableau de bord</a>
        </div>

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Titre du projet *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-700 font-medium mb-2">Catégorie *</label>
                <select id="category_id" name="category_id" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description détaillée *</label>
                <textarea id="description" name="description" rows="5" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="goalAmount" class="block text-gray-700 font-medium mb-2">Objectif financier (en DH) *</label>
                <input type="number" id="goalAmount" name="goalAmount" min="1" step="0.01" value="{{ old('goalAmount') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('goalAmount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="startDate" class="block text-gray-700 font-medium mb-2">Date de début *</label>
                    <input type="date" id="startDate" name="startDate"  min="{{ date('Y-m-d') }}" value="{{ old('startDate') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('startDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="endDate" class="block text-gray-700 font-medium mb-2">Date de fin *</label>
                    <input type="date" id="endDate" name="endDate" value="{{ old('endDate') }}" required class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                    @error('endDate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="videoUrl" class="block text-gray-700 font-medium mb-2">Lien Vidéo (Optionnel)</label>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl') }}" placeholder="https://youtube.com/..." class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('videoUrl') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium transition duration-200">
                    Publier le Projet
                </button>
            </div>
        </form>
    </div>

</body>
</html>
