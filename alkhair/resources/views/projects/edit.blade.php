<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 min-h-screen flex justify-center items-center">

    <div class="max-w-3xl w-full bg-white p-8 rounded-2xl shadow-lg border-t-4 border-blue-500">

        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Modifier le projet</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-blue-600 font-medium transition flex items-center gap-1">
                &larr; Retour au Dashboard
            </a>
        </div>

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-md mb-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-800 font-bold">Politique de transparence AL-KHAIR</p>
                    <p class="text-sm text-blue-700 mt-1">
                        Pour des raisons de sécurité et de confiance envers vos donateurs, l'objectif financier <strong>({{ $project->goalAmount }} DH)</strong> et la catégorie ne peuvent plus être modifiés après la publication. Vous pouvez uniquement mettre à jour le contenu de la campagne.
                    </p>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-md mb-6 border border-red-200">
                <ul class="list-disc pl-5 font-medium text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Titre du projet <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">
            </div>

            <div class="mb-6">
                <label for="videoUrl" class="block text-gray-700 font-bold mb-2">Lien de la vidéo de campagne (Optionnel)</label>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl', $project->videoUrl) }}" placeholder="https://youtube.com/..." class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm text-blue-600">
                <p class="text-xs text-gray-500 mt-2 font-medium">Ajouter une vidéo augmente vos chances de recevoir des dons.</p>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-bold mb-2">Image du Projet (Optionnel)</label>
                @if($project->image)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Image actuelle" class="w-full h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                @endif
                <div class="flex items-center gap-4">
                    <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">
                </div>
                <p class="text-xs text-gray-500 mt-2 font-medium">Formats acceptés: JPG, PNG, WEBP (Max: 5 Mo)</p>
                <div id="imagePreview" class="mt-3 hidden">
                    <p class="text-sm text-gray-600 mb-2">Nouvelle image:</p>
                    <img id="preview" class="w-full h-48 object-cover rounded-lg border border-gray-200" alt="Aperçu">
                </div>
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description détaillée <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="6" required class="w-full border-gray-300 rounded-lg p-3 border focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition shadow-sm">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="flex items-center justify-between border-t pt-6">
                <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-gray-800 font-bold px-4 py-2 transition">
                    Annuler
                </a>
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Enregistrer les modifications
                </button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
