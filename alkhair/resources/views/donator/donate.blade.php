<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Faire un don | AL-KHAIR</title>
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
                    },
                    fontFamily: {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
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
        /* إخفاء أسهم الأرقام في input type number */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container">

<header class="bg-white/80 backdrop-blur-md shadow-sm fixed w-full top-0 z-50">
    <nav class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-4">
            <a href="{{ route('projects.show', $project->id) }}" class="material-symbols-outlined text-on-surface-variant hover:text-primary-container transition-colors">arrow_back</a>
            <div class="text-2xl font-black tracking-tighter text-primary-container font-headline">AL-KHAIR</div>
        </div>
        <div class="flex items-center gap-3 bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/20">
            <span class="material-symbols-outlined text-outline-variant">person</span>
            <span class="font-semibold text-sm">{{ auth()->user()->name ?? 'Donateur' }}</span>
        </div>
    </nav>
</header>

<main class="max-w-7xl mx-auto px-6 py-24 md:py-28 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <div class="lg:col-span-5 space-y-8 sticky top-32">
            <div>
                <span class="font-label text-xs uppercase tracking-widest text-secondary-container bg-secondary-container/10 px-3 py-1 rounded-full mb-4 inline-block">Projet Solidaire</span>
                <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight leading-tight text-primary-container mb-4">
                    {{ $project->title }}
                </h1>
                <p class="text-sm font-bold text-secondary flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-[16px]">foundation</span>
                    Par : {{ $project->association->name ?? 'Association' }}
                </p>
                <p class="text-on-surface-variant text-base leading-relaxed line-clamp-4">
                    {{ $project->description }}
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="bg-surface-container-lowest p-6 rounded-xl flex items-start gap-4 shadow-sm border border-outline-variant/10">
                    <div class="bg-primary-container/10 p-3 rounded-lg text-primary-container">
                        <span class="material-symbols-outlined">visibility</span>
                    </div>
                    <div>
                        <h3 class="font-headline font-bold text-lg">100% Transparence</h3>
                        <p class="text-sm text-on-surface-variant">Suivez en temps réel l'impact de votre don sur le terrain.</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex flex-wrap gap-6 items-center opacity-70">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">verified_user</span>
                    <span class="font-label text-[10px] font-bold uppercase tracking-tighter">ONG Certifiée</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">lock</span>
                    <span class="font-label text-[10px] font-bold uppercase tracking-tighter">Paiement Sécurisé SSL</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 bg-surface-container-lowest rounded-[2rem] shadow-xl p-8 md:p-12 border border-outline-variant/10">
            
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 text-error text-sm font-medium border border-red-200">
                    <div class="flex items-center gap-2 mb-2 font-bold">
                        <span class="material-symbols-outlined">error</span>
                        Veuillez corriger les erreurs :
                    </div>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donations.store', $project->id) }}" method="POST" enctype="multipart/form-data" id="donationForm" class="space-y-10" onsubmit="disableSubmit()">
                @csrf

                <section class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-headline text-2xl font-bold tracking-tight text-primary-container">Montant du don</h2>
                        <p class="text-on-surface-variant text-sm">Sélectionnez un montant ou saisissez le vôtre.</p>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button type="button" onclick="setAmount(100, this)" class="amount-btn group flex flex-col items-center justify-center py-5 px-4 rounded-xl border-2 border-surface-container-high hover:border-secondary-container hover:bg-secondary-container/5 transition-all duration-200">
                            <span class="text-lg font-bold font-headline">100 DH</span>
                        </button>
                        <button type="button" onclick="setAmount(500, this)" class="amount-btn group flex flex-col items-center justify-center py-5 px-4 rounded-xl border-2 border-surface-container-high hover:border-secondary-container hover:bg-secondary-container/5 transition-all duration-200">
                            <span class="text-lg font-bold font-headline">500 DH</span>
                        </button>
                        <button type="button" onclick="setAmount(1000, this)" class="amount-btn group flex flex-col items-center justify-center py-5 px-4 rounded-xl border-2 border-surface-container-high hover:border-secondary-container hover:bg-secondary-container/5 transition-all duration-200">
                            <span class="text-lg font-bold font-headline">1000 DH</span>
                        </button>
                        <button type="button" onclick="setAmount(2500, this)" class="amount-btn group flex flex-col items-center justify-center py-5 px-4 rounded-xl border-2 border-surface-container-high hover:border-secondary-container hover:bg-secondary-container/5 transition-all duration-200">
                            <span class="text-lg font-bold font-headline">2500 DH</span>
                        </button>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-primary-container font-extrabold text-xl">DH</span>
                        </div>
                        <input type="number" id="amount" name="amount" min="100" required value="{{ old('amount') }}" oninput="clearButtons()"
                               class="w-full bg-surface-container-low border-0 rounded-xl py-5 pl-14 pr-4 focus:ring-2 focus:ring-secondary-container text-xl font-bold placeholder:text-on-surface-variant/40 transition-all"
                               placeholder="Minimum 100 DH..."/>
                        @error('amount') <p class="text-error text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </section>

                <hr class="border-outline-variant/20">

                <section class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-headline text-2xl font-bold tracking-tight text-primary-container">Votre Message</h2>
                        <p class="text-on-surface-variant text-sm">Laissez un mot d'encouragement pour l'association (Optionnel).</p>
                    </div>
                    
                    <textarea id="message" name="message" rows="3" placeholder="Ex: Bon courage pour ce noble projet..."
                              class="w-full bg-surface-container-low border-0 rounded-xl p-4 focus:ring-2 focus:ring-secondary-container text-sm transition-all">{{ old('message') }}</textarea>

                    <label class="flex items-center gap-3 cursor-pointer group p-4 border border-outline-variant/20 rounded-xl hover:bg-surface-container-low transition-colors">
                        <input type="checkbox" name="isAnonymous" value="1" {{ old('isAnonymous') ? 'checked' : '' }} 
                               class="w-5 h-5 rounded border-outline-variant text-primary-container focus:ring-primary-container cursor-pointer"/>
                        <div>
                            <span class="text-sm font-bold text-primary-container block">Faire un don anonyme</span>
                            <span class="text-xs text-on-surface-variant">Votre nom n'apparaîtra pas dans la liste publique des donateurs.</span>
                        </div>
                    </label>
                </section>

                <hr class="border-outline-variant/20">

                <section class="space-y-6">
                    <div class="space-y-2">
                        <h2 class="font-headline text-2xl font-bold tracking-tight text-primary-container">Méthode de paiement</h2>
                        <p class="text-on-surface-variant text-sm">Sélectionnez comment vous souhaitez régler votre don.</p>
                    </div>
                    
                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-5 rounded-xl border-2 border-surface-container-high cursor-pointer hover:bg-surface-container-low transition-colors has-[:checked]:border-primary-container has-[:checked]:bg-primary-container/5">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-primary-container text-3xl">credit_card</span>
                                <div>
                                    <p class="font-bold text-sm text-primary-container">Paiement en ligne</p>
                                    <p class="text-xs text-on-surface-variant">Carte Bancaire ou PayPal (Sécurisé)</p>
                                </div>
                            </div>
                            <input type="radio" name="paymentMethod" value="ONLINE" {{ old('paymentMethod') == 'ONLINE' ? 'checked' : '' }} required onchange="toggleReceipt()" class="text-primary-container focus:ring-primary-container h-5 w-5 cursor-pointer"/>
                        </label>
                        
                        <label class="flex items-center justify-between p-5 rounded-xl border-2 border-surface-container-high cursor-pointer hover:bg-surface-container-low transition-colors has-[:checked]:border-primary-container has-[:checked]:bg-primary-container/5">
                            <div class="flex items-center gap-4">
                                <span class="material-symbols-outlined text-primary-container text-3xl">account_balance</span>
                                <div>
                                    <p class="font-bold text-sm text-primary-container">Virement Bancaire (Manuel)</p>
                                    <p class="text-xs text-on-surface-variant">Transfert vers le compte de la fondation</p>
                                </div>
                            </div>
                            <input type="radio" name="paymentMethod" value="MANUAL" {{ old('paymentMethod') == 'MANUAL' ? 'checked' : '' }} required onchange="toggleReceipt()" class="text-primary-container focus:ring-primary-container h-5 w-5 cursor-pointer"/>
                        </label>
                    </div>

                    <div id="receipt-upload" class="hidden p-6 border-2 border-dashed border-outline-variant/50 rounded-xl bg-surface-container-low animate-fade-in">
                        <div class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-secondary-container text-3xl">upload_file</span>
                            <div class="flex-grow">
                                <label for="paymentReceipt" class="block text-primary-container font-bold mb-1">Uploader le reçu de virement *</label>
                                <p class="text-xs text-on-surface-variant mb-4">Obligatoire pour valider le paiement manuel (PDF, JPG, PNG).</p>
                                <input type="file" id="paymentReceipt" name="paymentReceipt" accept=".pdf,.jpg,.jpeg,.png" 
                                       class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-container file:text-white hover:file:bg-slate-800 transition-colors cursor-pointer"/>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="pt-4">
                    <button type="submit" id="submitBtn" class="w-full bg-secondary-container text-on-secondary-container font-headline font-extrabold text-lg py-5 rounded-xl shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        <span id="btnText">Confirmer le don</span>
                        <span class="material-symbols-outlined" id="btnIcon" style="font-variation-settings: 'wght' 700;">arrow_forward</span>
                    </button>
                    <p class="text-center text-[10px] text-on-surface-variant/60 mt-4 uppercase tracking-widest font-bold">Encrypted via 256-bit SSL connection</p>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    /* Animation simple pour l'apparition du bloc reçu */
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    // 1. Script pour les boutons de montants rapides
    function setAmount(value, btnElement) {
        document.getElementById('amount').value = value;
        
        // Remove active class from all buttons
        let buttons = document.querySelectorAll('.amount-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-secondary-container', 'bg-secondary-container/10');
            btn.classList.add('border-surface-container-high');
            btn.querySelector('span').classList.remove('text-secondary-container');
        });

        // Add active class to clicked button
        btnElement.classList.remove('border-surface-container-high');
        btnElement.classList.add('border-secondary-container', 'bg-secondary-container/10');
        btnElement.querySelector('span').classList.add('text-secondary-container');
    }

    // Clear active states if user types custom amount
    function clearButtons() {
        let buttons = document.querySelectorAll('.amount-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-secondary-container', 'bg-secondary-container/10');
            btn.classList.add('border-surface-container-high');
            btn.querySelector('span').classList.remove('text-secondary-container');
        });
    }

    // 2. Script pour afficher/masquer le champ de reçu
    function toggleReceipt() {
        const method = document.querySelector('input[name="paymentMethod"]:checked').value;
        const receiptDiv = document.getElementById('receipt-upload');
        const receiptInput = document.getElementById('paymentReceipt');

        if (method === 'MANUAL') {
            receiptDiv.classList.remove('hidden');
            receiptInput.setAttribute('required', 'required');
        } else {
            receiptDiv.classList.add('hidden');
            receiptInput.removeAttribute('required');
            receiptInput.value = ''; // Clear file if user switches back
        }
    }

    // 3. Prévenir le double clic sur le bouton Submit
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Traitement en cours...';
        document.getElementById('btnIcon').innerText = 'hourglass_empty';
    }

    // Run on load in case of validation errors returning old inputs
    document.addEventListener('DOMContentLoaded', function() {
        if(document.querySelector('input[name="paymentMethod"]:checked')) {
            toggleReceipt();
        }
    });
</script>

</body>
</html>