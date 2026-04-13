<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier le Rapport d'Impact - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 flex items-center justify-center min-h-screen">

    <div class="max-w-3xl w-full mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-green-500">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Rapport d'Impact</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-green-600 font-medium transition">Retour au Dashboard</a>
        </div>

        <p class="mb-8 text-gray-600 bg-green-50 p-3 rounded border border-green-100">
            Projet : <strong class="text-green-800">{{ $project->title }}</strong>
        </p>

        <form action="{{ route('impact.store', $project->id) }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="completionDate" class="block text-gray-700 font-medium mb-2">Date de réalisation *</label>
                <input type="date" id="completionDate" name="completionDate" value="{{ old('completionDate') }}" required class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-gray-50">
                @error('completionDate') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-5">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description des réalisations *</label>
                <textarea id="description" name="description" rows="5" required placeholder="Expliquez en détail comment les fonds ont été utilisés (Minimum 50 caractères)..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-gray-50">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="mb-8">
                <label for="videoLink" class="block text-gray-700 font-medium mb-2">Lien de la vidéo (Optionnel)</label>
                <input type="url" id="videoLink" name="videoLink" value="{{ old('videoLink') }}" placeholder="Ex: https://youtube.com/watch?v=..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-gray-50">
                @error('videoLink') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end border-t pt-5">
                <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-md hover:bg-green-700 transition font-bold shadow-sm">
                    Publier le Rapport
                </button>
            </div>
        </form>
    </div>

</body>
</html>
