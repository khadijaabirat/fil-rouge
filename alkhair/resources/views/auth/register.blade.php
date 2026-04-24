<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inscription - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-container": "#021c36",
              "secondary-container": "#feb700",
              "surface": "#f8f9fb",
              "on-surface": "#191c1e",
              "on-surface-variant": "#43474d",
              "surface-container-lowest": "#ffffff",
              "surface-container-low": "#f2f4f6",
              "surface-container-high": "#e6e8ea",
              "outline-variant": "#c4c6ce",
              "secondary": "#7c5800",
              "error": "#ba1a1a",
            },
            fontFamily: {
              "headline": ["Manrope"],
              "body": ["Inter"],
              "label": ["Inter"]
            }
          },
        },
      }
    </script>
    <style>
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
      .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); }
      /* Custom Scrollbar for the right section */
      .scrollable-form::-webkit-scrollbar { width: 6px; }
      .scrollable-form::-webkit-scrollbar-thumb { background-color: #c4c6ce; border-radius: 10px; }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased h-screen overflow-hidden">
<main class="h-full flex flex-col md:flex-row">
    
    <section class="hidden md:flex md:w-5/12 bg-primary-container relative flex-col justify-between p-12 overflow-hidden h-full">
        <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-secondary-container/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <div class="text-white font-headline font-extrabold text-3xl tracking-tighter mb-16">AL-KHAIR</div>
            <h1 class="font-headline font-bold text-5xl text-white leading-tight tracking-tight mb-6">
                Rejoignez la force <br/>du <span class="text-secondary-container">bien durable</span>.
            </h1>
            <p class="text-gray-300 text-lg max-w-sm leading-relaxed">
                Une plateforme transparente dédiée à l'impact humanitaire.
            </p>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 p-6 glass-effect rounded-xl border border-white/10">
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-yellow-900">verified_user</span>
                </div>
                <div>
                    <p class="font-headline font-bold text-primary-container text-sm">Transparence Totale</p>
                    <p class="text-gray-600 text-xs font-medium">Chaque don est tracé et documenté.</p>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAz5K2nxJgzn3rEk5-TmcYB5pdcq00aqOqELwOD4JTvdPLrmygKcJEFWDHh8zdUt8KoI988Lypou9gSXX-a8Uq3V9xqEQqaVZtBcLSjUJ1STAOKhF4sToWAhMYtSsFCUObjSq1cODYuUtYhMZBXfmgiUrdcSiSMe6PAjRVWiEvKcQVpsLeou1EnzQ-jcPcJlXvC_y_TIaR8SkKganKL2rWowxj5knaGJdJbQfB3DdhkSEsp-kF83PslSVbbbRmMQM3kPmjpzoNOFhA" alt="Pattern"/>
        </div>
    </section>

    <section class="flex-1 flex flex-col items-center px-6 py-12 md:px-16 lg:px-24 bg-surface h-full overflow-y-auto scrollable-form">
        
        <div class="w-full max-w-2xl">
            <div class="md:hidden flex justify-center mb-8">
                <div class="text-primary-container font-headline font-extrabold text-2xl tracking-tighter">AL-KHAIR</div>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 text-error text-sm font-medium border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm" class="w-full pb-10">
                @csrf

                <div id="step-1" class="space-y-10 {{ $errors->any() ? 'hidden' : 'block' }}">
                    <header class="text-center md:text-left space-y-4">
                        <span class="inline-block px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-label font-bold tracking-widest text-on-surface-variant uppercase">
                            Étape 1 sur 2
                        </span>
                        <h2 class="font-headline font-bold text-3xl md:text-4xl text-primary leading-tight">
                            Comment souhaitez-vous <br/>contribuer ?
                        </h2>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="group relative cursor-pointer outline-none">
                            <input class="peer sr-only" name="role" type="radio" value="donator" {{ old('role') == 'donator' ? 'checked' : '' }} required/>
                            <div class="h-full p-8 rounded-xl bg-surface-container-lowest border-2 border-transparent transition-all peer-checked:border-secondary-container shadow-sm group-hover:scale-[1.02]">
                                <div class="w-14 h-14 mb-6 rounded-xl bg-surface-container-low flex items-center justify-center">
                                    <span class="material-symbols-outlined text-secondary text-3xl">favorite</span>
                                </div>
                                <h3 class="font-headline font-bold text-xl text-primary mb-3">Donateur</h3>
                                <p class="text-on-surface-variant text-sm">Je souhaite soutenir des projets et suivre mon impact.</p>
                                <div class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100">
                                    <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>

                        <label class="group relative cursor-pointer outline-none">
                            <input class="peer sr-only" name="role" type="radio" value="association" {{ old('role') == 'association' ? 'checked' : '' }} required/>
                            <div class="h-full p-8 rounded-xl bg-surface-container-lowest border-2 border-transparent transition-all peer-checked:border-secondary-container shadow-sm group-hover:scale-[1.02]">
                                <div class="w-14 h-14 mb-6 rounded-xl bg-surface-container-low flex items-center justify-center">
                                    <span class="material-symbols-outlined text-secondary text-3xl">foundation</span>
                                </div>
                                <h3 class="font-headline font-bold text-xl text-primary mb-3">Association</h3>
                                <p class="text-on-surface-variant text-sm">Nous cherchons à lever des fonds pour des projets concrets.</p>
                                <div class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100">
                                    <span class="material-symbols-outlined text-secondary-container text-2xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between pt-8 border-t border-surface-container-high">
                        <p class="text-sm text-on-surface-variant">Déjà inscrit ? <a href="{{ route('login') }}" class="text-secondary font-bold hover:underline">Se connecter</a></p>
                        <button type="button" onclick="nextStep()" class="px-8 py-3 bg-primary-container text-white font-bold rounded-full hover:scale-[1.02] transition-transform">
                            Continuer &rarr;
                        </button>
                    </div>
                </div>

                <div id="step-2" class="space-y-8 {{ $errors->any() ? 'block' : 'hidden' }}">
                    <header class="space-y-2">
                        <span class="inline-block px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-label font-bold tracking-widest text-on-surface-variant uppercase">
                            Étape 2 sur 2
                        </span>
                        <h2 class="font-headline font-bold text-3xl text-primary">Vos informations</h2>
                    </header>

                    <div class="space-y-4 bg-surface-container-lowest p-6 rounded-xl shadow-sm">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Nom complet / Nom de l'association *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2 focus:ring-primary-container">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2 focus:ring-primary-container">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Mot de passe *</label>
                                <input type="password" name="password" required class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2 focus:ring-primary-container">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Confirmer MDP *</label>
                                <input type="password" name="password_confirmation" required class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2 focus:ring-primary-container">
                            </div>
                        </div>
                    </div>

                    <div id="association-fields" class="space-y-4 bg-surface-container-lowest p-6 rounded-xl shadow-sm {{ old('role') == 'association' ? 'block' : 'hidden' }}">
                        <h3 class="font-headline font-bold text-lg text-primary mb-2">Dossier Institutionnel</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Ville *</label>
                                <input type="text" name="ville" id="ville" value="{{ old('ville') }}" class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Numéro d'autorisation *</label>
                                <input type="text" name="licenseNumber" id="licenseNumber" value="{{ old('licenseNumber') }}" placeholder="Ex: LIC-12345" class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Catégorie *</label>
                            <select name="category_id" id="category_id" class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2">
                                <option value="">Sélectionnez...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Description *</label>
                            <textarea name="description" id="description" rows="3" class="w-full bg-surface-container-low border-0 rounded-lg p-3 focus:ring-2">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Logo (Image) *</label>
                                <input type="file" name="profilePhoto" id="profilePhoto" accept="image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:bg-primary-container file:text-white hover:file:bg-slate-800">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase mb-1">Document KYC (PDF/Image) *</label>
                                <input type="file" name="documentKYC" id="documentKYC" accept=".pdf,image/*" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:bg-secondary-container file:text-yellow-900 hover:file:bg-yellow-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-surface-container-high">
                        <button type="button" onclick="prevStep()" class="text-on-surface-variant hover:text-primary font-medium text-sm flex items-center gap-1">
                            &larr; Retour
                        </button>
                        <button type="submit" class="px-8 py-3 bg-primary-container text-white font-bold rounded-full hover:scale-[1.02] shadow-lg transition-transform flex items-center gap-2">
                            Terminer l'inscription <span class="material-symbols-outlined text-sm">check</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </section>
</main>

<script>
    function nextStep() {
        const role = document.querySelector('input[name="role"]:checked');
        if(!role) {
            alert("Veuillez sélectionner un rôle pour continuer.");
            return;
        }
        
        // Hide Step 1, Show Step 2
        document.getElementById('step-1').classList.add('hidden');
        document.getElementById('step-2').classList.remove('hidden');

        // Logic to show/hide Association fields and make them required
        const assocFieldsDiv = document.getElementById('association-fields');
        const assocInputs = ['ville', 'licenseNumber', 'category_id', 'description', 'profilePhoto', 'documentKYC'];
        
        if(role.value === 'association') {
            assocFieldsDiv.classList.remove('hidden');
            assocFieldsDiv.classList.add('block');
            assocInputs.forEach(id => document.getElementById(id).setAttribute('required', 'true'));
        } else {
            assocFieldsDiv.classList.remove('block');
            assocFieldsDiv.classList.add('hidden');
            assocInputs.forEach(id => document.getElementById(id).removeAttribute('required'));
        }
    }

    function prevStep() {
        document.getElementById('step-2').classList.add('hidden');
        document.getElementById('step-1').classList.remove('hidden');
    }
</script>
</body>
</html>