<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border-t-4 border-green-500">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Mon Profil Association</h1>
            <a href="{{ route('association.dashboard') }}" class="text-green-600 hover:underline font-medium">Retour au Dashboard</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-6">{{ session('success') }}</div>
        @endif

       <form action="{{ route('association.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-8 flex items-center space-x-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                <div class="shrink-0">
                    @if($association->profilePhoto)
                        <img class="h-24 w-24 object-cover rounded-full border-4 border-green-500 shadow-sm" src="{{ asset('storage/' . $association->profilePhoto) }}" alt="Photo de profil">
                    @else
                        <div class="h-24 w-24 rounded-full bg-green-100 flex items-center justify-center border-4 border-green-500 text-green-600 font-bold text-xl">
                            {{ substr($association->name, 0, 2) }}
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-2">Logo / Photo de profil</label>
                    <input type="file" name="profilePhoto" accept="image/jpeg, image/png, image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                    <p class="text-xs text-gray-500 mt-2">Formats acceptés : JPG, PNG. Taille max : 2MB.</p>
                    @error('profilePhoto') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nom de l'association *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $association->name) }}" required class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>

                <div>
                    <label for="rib" class="block text-gray-700 font-medium mb-2">RIB Bancaire (24 chiffres)</label>
                    <input type="text" id="rib" name="rib" value="{{ old('rib', $association->rib) }}" placeholder="Ex: 011810000000000000000000" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 font-mono text-blue-700">
                    @error('rib') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="ville" class="block text-gray-700 font-medium mb-2">Ville</label>
                    <input type="text" id="ville" name="ville" value="{{ old('ville', $association->ville) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Téléphone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $association->phone) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
                </div>
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-700 font-medium mb-2">Adresse complète</label>
                <input type="text" id="address" name="address" value="{{ old('address', $association->address) }}" class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">
            </div>

            <div class="mb-8">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description / Présentation de l'association</label>
                <textarea id="description" name="description" rows="4" placeholder="Parlez-nous de vos objectifs et de vos actions sur le terrain..." class="w-full border-gray-300 rounded-md p-2 border focus:ring-green-500 focus:border-green-500 bg-white">{{ old('description', $association->description) }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-bold shadow-sm">
                    Mettre à jour le profil
                </button>
            </div>
        </form>
    </div>

</body>
</html>
