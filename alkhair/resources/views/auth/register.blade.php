<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inscription - AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
      body { font-family: 'Inter', sans-serif; background: #e8ecf3; }
      h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
      .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
      @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
      .float { animation: float 6s ease-in-out infinite; }
      .scrollable-form::-webkit-scrollbar { width: 5px; }
      .scrollable-form::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
      
      .modern-input { background: #f0f2f5; border: 1px solid transparent; border-radius: 1rem; transition: all 0.3s; font-size: 0.875rem; color: #0A1128; font-weight: 600; }
      .modern-input:focus { background: #ffffff; border-color: #F5A623; box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.1); outline: none; }
      
      input[type=file]::file-selector-button {
            background-color: #0A1128; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.75rem;
            font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s;
      }
      input[type=file]::file-selector-button:hover { background-color: #F5A623; color: #0A1128; }
    </style>
</head>
<body class="bg-[#e8ecf3] text-slate-700 antialiased h-screen overflow-hidden selection:bg-[#F5A623] selection:text-white">
<main class="h-full flex flex-col md:flex-row">
    
    <!-- Left Sidebar -->
    <section class="hidden md:flex md:w-5/12 bg-gradient-to-br from-[#0A1128] to-[#162040] relative flex-col justify-between p-12 overflow-hidden h-full">
        <div class="absolute top-[-10%] right-[-10%] w-72 h-72 bg-[#F5A623]/20 rounded-full blur-[80px] float pointer-events-none"></div>
        <div class="absolute bottom-[-5%] left-[-5%] w-72 h-72 bg-blue-500/10 rounded-full blur-[80px] float pointer-events-none" style="animation-delay:3s"></div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-16">
                <div class="w-30 h-30">
                    <x-application-logo class="w-20 h-20" />
                </div>
            </div>
            <h1 class="font-black text-5xl text-white leading-tight tracking-tight mb-6">
                Rejoignez la force<br/>du <span class="text-[#F5A623]">bien durable</span>.
            </h1>
            <p class="text-blue-100/70 text-lg max-w-sm leading-relaxed font-medium">
                Une plateforme transparente dédiée à l'impact humanitaire.
            </p>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-4 p-6 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 shadow-xl">
                <div class="w-12 h-12 rounded-xl bg-[#F5A623]/20 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-[#F5A623] text-2xl" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                </div>
                <div>
                    <p class="font-black text-white text-base">Transparence Totale</p>
                    <p class="text-blue-100/50 text-sm mt-0.5">Chaque don est tracé et documenté.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Right Form Area -->
    <section class="flex-1 flex flex-col items-center px-6 py-10 md:px-14 lg:px-20 bg-white h-full overflow-y-auto scrollable-form">
        <div class="w-full max-w-2xl">
            <div class="md:hidden flex justify-center mb-10">
                <div class="w-24 h-24">
                    <x-application-logo class="w-24 h-24" />
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-8 p-4 rounded-xl bg-red-50 text-red-600 text-sm font-bold border border-red-100 flex gap-3 items-start">
                    <span class="material-symbols-outlined">error</span>
                    <ul class="list-disc list-inside mt-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm" class="w-full pb-10">
                @csrf

                <!-- Step 1: Role Selection -->
                <div id="step-1" class="space-y-10 {{ $errors->any() ? 'hidden' : 'block' }}">
                    <header class="text-center md:text-left space-y-4">
                        <span class="inline-block px-4 py-1.5 bg-[#f0f2f5] rounded-lg text-[10px] font-black tracking-widest text-slate-400 uppercase">Étape 1 sur 2</span>
                        <h2 class="font-black text-4xl text-[#0A1128] leading-tight tracking-tight">Comment souhaitez-vous contribuer ?</h2>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <label class="group relative cursor-pointer outline-none h-full">
                            <input class="peer sr-only" name="role" type="radio" value="donator" {{ old('role') == 'donator' ? 'checked' : '' }} required/>
                            <div class="h-full p-8 rounded-3xl bg-white border-2 border-slate-200 transition-all peer-checked:border-[#F5A623] peer-checked:bg-[#F5A623]/5 shadow-sm group-hover:border-slate-300">
                                <div class="w-16 h-16 mb-6 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform peer-checked:bg-[#F5A623] peer-checked:text-[#0A1128]">
                                    <span class="material-symbols-outlined text-blue-600 text-3xl peer-checked:text-[#0A1128]">favorite</span>
                                </div>
                                <h3 class="font-black text-2xl text-[#0A1128] mb-3">Donateur</h3>
                                <p class="text-slate-500 text-sm font-medium leading-relaxed">Je souhaite soutenir des projets et suivre mon impact avec transparence.</p>
                                <div class="absolute top-6 right-6 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[#F5A623] text-3xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>

                        <label class="group relative cursor-pointer outline-none h-full">
                            <input class="peer sr-only" name="role" type="radio" value="association" {{ old('role') == 'association' ? 'checked' : '' }} required/>
                            <div class="h-full p-8 rounded-3xl bg-white border-2 border-slate-200 transition-all peer-checked:border-[#F5A623] peer-checked:bg-[#F5A623]/5 shadow-sm group-hover:border-slate-300">
                                <div class="w-16 h-16 mb-6 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:scale-110 transition-transform peer-checked:bg-[#F5A623] peer-checked:text-[#0A1128]">
                                    <span class="material-symbols-outlined text-emerald-600 text-3xl peer-checked:text-[#0A1128]">foundation</span>
                                </div>
                                <h3 class="font-black text-2xl text-[#0A1128] mb-3">Association</h3>
                                <p class="text-slate-500 text-sm font-medium leading-relaxed">Nous cherchons à lever des fonds pour réaliser des projets concrets.</p>
                                <div class="absolute top-6 right-6 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-[#F5A623] text-3xl" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="flex flex-col-reverse md:flex-row items-center justify-between pt-8 border-t border-slate-100 gap-6">
                        <p class="text-sm font-bold text-slate-400">Déjà inscrit ? <a href="{{ route('login') }}" class="text-[#F5A623] hover:text-[#0A1128] transition-colors">Se connecter</a></p>
                        <button type="button" onclick="nextStep()" class="w-full md:w-auto px-8 py-4 bg-[#0A1128] hover:bg-[#F5A623] text-white hover:text-[#0A1128] font-black text-sm uppercase tracking-widest rounded-2xl transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                            Continuer <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Information -->
                <div id="step-2" class="space-y-10 {{ $errors->any() ? 'block' : 'hidden' }}">
                    <header class="space-y-4">
                        <span class="inline-block px-4 py-1.5 bg-[#f0f2f5] rounded-lg text-[10px] font-black tracking-widest text-slate-400 uppercase">Étape 2 sur 2</span>
                        <h2 class="font-black text-4xl text-[#0A1128] tracking-tight">Vos informations</h2>
                    </header>

                    <div class="space-y-5 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nom complet / Nom de l'association *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="modern-input w-full p-4">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="modern-input w-full p-4">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mot de passe *</label>
                                <input type="password" name="password" required class="modern-input w-full p-4">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Confirmer MDP *</label>
                                <input type="password" name="password_confirmation" required class="modern-input w-full p-4">
                            </div>
                        </div>
                    </div>

                    <!-- Association Specific Fields -->
                    <div id="association-fields" class="space-y-5 bg-white p-8 rounded-3xl shadow-sm border border-slate-100 {{ old('role') == 'association' ? 'block' : 'hidden' }}">
                        <h3 class="font-black text-xl text-[#0A1128] mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[#F5A623]">folder_special</span> Dossier Institutionnel
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ville *</label>
                                <input type="text" name="ville" id="ville" value="{{ old('ville') }}" class="modern-input w-full p-4">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Numéro d'autorisation *</label>
                                <input type="text" name="licenseNumber" id="licenseNumber" value="{{ old('licenseNumber') }}" placeholder="Ex: LIC-12345" class="modern-input w-full p-4">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Catégorie d'intervention *</label>
                            <select name="category_id" id="category_id" class="modern-input w-full p-4 cursor-pointer">
                                <option value="">Sélectionnez...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Description (min. 50 caractères) *</label>
                            <textarea name="description" id="description" rows="3" minlength="50" class="modern-input w-full p-4 resize-none">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4">
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100">
                                <label class="block text-[10px] font-black text-[#0A1128] uppercase tracking-widest mb-3">Logo (Image) *</label>
                                <input type="file" name="profilePhoto" id="profilePhoto" accept="image/*" class="w-full text-xs text-slate-500">
                            </div>
                            <div class="bg-amber-50 p-5 rounded-2xl border border-amber-100">
                                <label class="block text-[10px] font-black text-amber-900 uppercase tracking-widest mb-3">Document KYC (PDF/Image) *</label>
                                <input type="file" name="documentKYC" id="documentKYC" accept=".pdf,image/*" class="w-full text-xs text-slate-500 file:!bg-amber-600 hover:file:!bg-amber-700">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse md:flex-row items-center justify-between pt-8 border-t border-slate-100 gap-6">
                        <button type="button" onclick="prevStep()" class="text-slate-400 hover:text-[#0A1128] font-bold text-sm flex items-center gap-2 transition-colors">
                            <span class="material-symbols-outlined text-sm">arrow_back</span> Retour
                        </button>
                        <button type="submit" class="w-full md:w-auto px-8 py-4 bg-[#0A1128] hover:bg-[#F5A623] text-white hover:text-[#0A1128] font-black text-[10px] uppercase tracking-widest rounded-2xl transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                            Terminer l'inscription <span class="material-symbols-outlined text-lg">check_circle</span>
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
        
        // Form Animation
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
        step2.classList.add('animate-fade-in');

        // Logic to show/hide Association fields
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
        document.getElementById('step-1').classList.add('animate-fade-in');
    }
</script>
</body>
</html>