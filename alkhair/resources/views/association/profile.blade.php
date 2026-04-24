<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Mon Profil | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-container": "#021c36",
              "secondary-container": "#feb700",
              "on-secondary-container": "#6b4b00",
              "surface": "#f8f9fb",
              "on-surface": "#191c1e",
              "on-surface-variant": "#43474d",
              "surface-container-lowest": "#ffffff",
              "surface-container-low": "#f2f4f6",
              "surface-container-high": "#e6e8ea",
              "surface-container-highest": "#e0e3e5",
              "outline-variant": "#c4c6ce",
              "secondary": "#7c5800",
              "error": "#ba1a1a",
              "error-container": "#ffdad6",
              "on-error-container": "#93000a",
            },
            fontFamily: {
              "headline": ["Manrope", "sans-serif"],
              "body": ["Inter", "sans-serif"],
              "label": ["Inter", "sans-serif"]
            },
            borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px"},
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        /* Style for file input button */
        input[type=file]::file-selector-button {
            background-color: #021c36;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        input[type=file]::file-selector-button:hover {
            background-color: #011124;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased overflow-x-hidden">

<nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-xl shadow-sm flex justify-between items-center px-6 md:px-8 py-4 border-b border-outline-variant/10">
    <div class="flex items-center gap-8">
        <span class="text-2xl font-extrabold tracking-tighter text-primary-container font-headline">AL-KHAIR</span>
        <span class="hidden md:inline-block px-3 py-1 bg-surface-container-high rounded-full text-[10px] font-label font-bold tracking-widest text-on-surface-variant uppercase">
            Espace Association
        </span>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{ route('association.dashboard') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary-container transition-colors font-bold text-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Retour au Dashboard
        </a>
    </div>
</nav>

<div class="flex pt-16 min-h-screen">
    
    <aside class="hidden md:flex h-screen w-64 fixed left-0 top-0 pt-24 flex-col gap-2 p-4 bg-surface-container-lowest border-r border-outline-variant/10">
        <nav class="flex flex-col gap-2 flex-grow">
            <a href="{{ route('association.dashboard') }}" class="flex items-center gap-3 text-on-surface-variant px-4 py-3 hover:text-primary-container hover:bg-surface-container-low rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-body text-sm font-semibold tracking-wide">Vue d'ensemble</span>
            </a>
            <a href="#" class="flex items-center gap-3 bg-primary-container text-white rounded-xl px-4 py-3 shadow-sm transition-transform translate-x-1 mt-4">
                <span class="material-symbols-outlined text-secondary-container">manage_accounts</span>
                <span class="font-body text-sm font-semibold tracking-wide">Mon Profil</span>
            </a>
        </nav>

        <div class="mt-auto mb-4 space-y-2">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 text-error px-4 py-3 hover:bg-error-container/50 rounded-xl transition-all duration-200">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-body text-sm font-semibold tracking-wide">Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 md:ml-64 p-6 md:p-10 bg-surface">
        
        <div class="max-w-4xl mx-auto">
            
            @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-8 p-4 rounded-xl bg-error-container text-on-error-container text-sm font-medium border border-error/20 flex items-start gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-error">error</span>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <section class="mb-8">
                <div class="relative h-48 rounded-2xl overflow-hidden mb-[-4rem] bg-gradient-to-r from-primary-container to-surface-tint">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                </div>
                
                <div class="flex flex-col md:flex-row items-end gap-6 px-8 relative z-10">
                    <div class="w-32 h-32 rounded-full bg-white p-1.5 shadow-lg flex-shrink-0 relative group">
                        @if($association->profilePhoto)
                            <img class="w-full h-full object-cover rounded-full border-4 border-surface-container-lowest" src="{{ asset('storage/' . $association->profilePhoto) }}" alt="Logo Association">
                        @else
                            <div class="w-full h-full rounded-full bg-primary-container/10 flex items-center justify-center border-4 border-surface-container-lowest text-primary-container font-headline font-black text-4xl">
                                {{ strtoupper(substr($association->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1 pb-2 w-full md:w-auto text-center md:text-left mt-12 md:mt-0">
                        <div class="flex items-center justify-center md:justify-start gap-3 mb-1">
                            <h1 class="text-3xl font-headline font-extrabold text-on-surface">{{ $association->name }}</h1>
                            @if($association->status === 'ACTIVE')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-[10px] font-label font-bold uppercase tracking-wider flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    Vérifié
                                </span>
                            @endif
                        </div>
                        <p class="text-on-surface-variant font-medium flex items-center justify-center md:justify-start gap-1">
                            <span class="material-symbols-outlined text-sm">mail</span>
                            {{ $association->email }}
                        </p>
                    </div>
                </div>
            </section>

            <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/20 overflow-hidden">
                
                <div class="bg-surface-container-low/50 px-8 py-5 border-b border-outline-variant/20 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary-container">edit_document</span>
                    <h2 class="text-xl font-headline font-bold text-primary-container">Modifier les informations</h2>
                </div>

                <form action="{{ route('association.updateProfile') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-6 bg-surface-container-low rounded-xl border border-outline-variant/30">
                            <div class="flex-1">
                                <label class="block text-primary-container font-bold mb-2">Logo / Photo de profil</label>
                                <input type="file" name="profilePhoto" accept="image/jpeg, image/png, image/jpg" class="block w-full text-sm text-on-surface-variant">
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-2 font-bold">Formats acceptés : JPG, PNG. Taille max : 2MB.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Nom de l'association *</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-outline-variant">foundation</span>
                                    </div>
                                    <input type="text" id="name" name="name" value="{{ old('name', $association->name) }}" required 
                                           class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="ville" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Ville</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-outline-variant">location_city</span>
                                    </div>
                                    <input type="text" id="ville" name="ville" value="{{ old('ville', $association->ville) }}" 
                                           class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Téléphone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-outline-variant">call</span>
                                    </div>
                                    <input type="text" id="phone" name="phone" value="{{ old('phone', $association->phone) }}" 
                                           class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="rib" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">RIB Bancaire (24 chiffres)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="material-symbols-outlined text-outline-variant">account_balance</span>
                                    </div>
                                    <input type="text" id="rib" name="rib" value="{{ old('rib', $association->rib) }}" placeholder="Ex: 011810000000000000000000" 
                                           class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all font-mono text-sm font-bold text-primary-container tracking-widest">
                                </div>
                                <p class="text-[10px] text-on-surface-variant px-1">Nécessaire pour recevoir les virements des dons.</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Adresse complète</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="material-symbols-outlined text-outline-variant">location_on</span>
                                </div>
                                <input type="text" id="address" name="address" value="{{ old('address', $association->address) }}" 
                                       class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant px-1">Présentation de l'association</label>
                            <div class="relative">
                                <textarea id="description" name="description" rows="4" placeholder="Parlez-nous de vos objectifs et de vos actions sur le terrain..." 
                                          class="w-full bg-surface border-outline-variant/30 rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary-container focus:border-transparent transition-all resize-y">{{ old('description', $association->description) }}</textarea>
                            </div>
                            <p class="text-[10px] text-on-surface-variant px-1">Cette description sera visible publiquement par les donateurs.</p>
                        </div>
                        
                    </div>

                    <div class="mt-10 pt-6 border-t border-outline-variant/20 flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-secondary-container text-on-secondary-container rounded-xl font-headline font-extrabold hover:bg-yellow-500 shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Mettre à jour le profil
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </main>
</div>

</body>
</html>