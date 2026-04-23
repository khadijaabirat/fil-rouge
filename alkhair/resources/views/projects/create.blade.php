<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Projet - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Créer un nouveau projet</h1>
            <a href="{{ route('association.dashboard') }}" class="text-gray-500 hover:text-gray-700 underline">Retour au tableau de bord</a>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
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
                <label class="block text-gray-700 font-medium mb-2">Localisation du projet sur la carte *</label>
                <p class="text-sm text-gray-500 mb-2">Cliquez sur la carte pour sélectionner l'emplacement exact du projet.</p>
                
                <div id="map" class="w-full h-64 rounded-md border border-gray-300 shadow-sm z-0 relative mb-2"></div>
                
                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">
                
                @error('latitude') <span class="text-red-500 text-sm">Veuillez sélectionner un emplacement sur la carte.</span> @enderror
            </div>

            <div class="mb-6">
                <label for="videoUrl" class="block text-gray-700 font-medium mb-2">Lien Vidéo (Optionnel)</label>
                <input type="url" id="videoUrl" name="videoUrl" value="{{ old('videoUrl') }}" placeholder="https://youtube.com/..." class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                @error('videoUrl') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Image du Projet (Optionnel)</label>
                <div class="flex items-center gap-4">
                    <input type="file" id="image" name="image" accept="image/jpeg,image/jpg,image/png,image/webp" class="w-full border-gray-300 rounded-md shadow-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
                </div>
                <p class="text-xs text-gray-500 mt-1">Formats acceptés: JPG, PNG, WEBP (Max: 5 Mo)</p>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div id="imagePreview" class="mt-3 hidden">
                    <img id="preview" class="w-full h-48 object-cover rounded-lg border border-gray-200" alt="Aperçu">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium transition duration-200">
                    Publier le Projet
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
 
        var map = L.map('map').setView([31.7917, -7.0926], 6);

        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

         var oldLat = document.getElementById('latitude').value;
        var oldLng = document.getElementById('longitude').value;
        
        if(oldLat && oldLng) {
            marker = L.marker([oldLat, oldLng]).addTo(map);
            map.setView([oldLat, oldLng], 10); 
        }

         map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

             if (marker) {
                map.removeLayer(marker);
            }

             marker = L.marker([lat, lng]).addTo(map);

                 document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
        });
    </script>
</body>
</html>
