<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier le Rapport d'Impact - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-green-500">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Rapport d'Impact</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:underline">Retour</a>
        </div>

        <p class="mb-6 text-gray-600">Projet : <strong>{{ $project->title }}</strong></p>

        <form action="{{ route('impact.store', $project->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="completionDate" class="block text-gray-700 font-medium mb-2">Date de réalisation *</label>
                <input type="date" id="completionDate" name="completionDate" required class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description des réalisations *</label>
                <textarea id="description" name="description" rows="5" required placeholder="Expliquez comment les fonds ont été utilisés..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500"></textarea>
            </div>

            <div class="mb-6">
                <label for="videoLink" class="block text-gray-700 font-medium mb-2">Lien de la vidéo (Optionnel)</label>
                <input type="url" id="videoLink" name="videoLink" placeholder="Lien YouTube ou autre..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition">
                    Publier le Rapport
                </button>
            </div>
        </form>
    </div>

</body>
</html>
