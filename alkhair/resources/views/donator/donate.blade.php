<!DOCTYPE html>
<html class="scroll-smooth light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Faire un don | AL-KHAIR</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <style>
        body { font-family: 'Inter', sans-serif; background: #e8ecf3; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        
        /* Neumorphism */
        .neu-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 24px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.04); }
        .modern-input { background: #f0f2f5; border: 1px solid transparent; border-radius: 1rem; transition: all 0.3s; font-size: 1rem; color: #0A1128; font-weight: 600; }
        .modern-input:focus { background: #ffffff; border-color: #F5A623; box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.1); outline: none; }
        
        .amount-btn { transition: all 0.25s ease; border: 2px solid #e2e8f0; border-radius: 1rem; }
        .amount-btn.active { border-color: #F5A623; background-color: rgba(245, 166, 35, 0.05); color: #F5A623; }
        .amount-btn:hover:not(.active) { border-color: #cbd5e1; background-color: #f8fafc; }

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        
        input[type=file]::file-selector-button {
            background-color: #0A1128; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.75rem;
            font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s;
        }
        input[type=file]::file-selector-button:hover { background-color: #F5A623; color: #0A1128; }
        
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-[#e8ecf3] text-slate-700 selection:bg-[#F5A623] selection:text-white">

<header class="bg-white/80 backdrop-blur-2xl border-b border-black/[0.04] fixed w-full top-0 z-50 shadow-sm">
    <nav class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
        <div class="flex items-center gap-4">
            <a href="{{ route('projects.show', $project->id) }}" class="material-symbols-outlined text-slate-400 hover:text-[#0A1128] transition-colors text-2xl bg-white p-2 rounded-xl shadow-sm border border-slate-100">arrow_back</a>
            <a href="{{ url('/') }}" class="flex items-center group">
                <x-application-logo class="w-14 h-14 text-[#0A1128] group-hover:scale-105 transition-transform" />
            </a>
        </div>
        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
            <span class="material-symbols-outlined text-slate-400">person</span>
            <span class="font-bold text-sm text-[#0A1128]">{{ auth()->user()->name ?? 'Donateur' }}</span>
        </div>
    </nav>
</header>

<main class="max-w-7xl mx-auto px-6 py-28 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- Sidebar Info -->
        <div class="lg:col-span-5 space-y-8 lg:sticky lg:top-32">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest text-[#F5A623] bg-[#F5A623]/10 px-4 py-1.5 rounded-lg mb-4 inline-block border border-[#F5A623]/20 shadow-sm">Soutenir ce projet</span>
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-[#0A1128] mb-6 leading-tight">
                    {{ $project->title }}
                </h1>
                
                <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-slate-100 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-100 overflow-hidden p-1">
                        @if($project->association && $project->association->profilePhoto)
                            <img src="{{ asset('storage/' . $project->association->profilePhoto) }}" class="w-full h-full object-cover rounded-lg">
                        @else
                            <span class="font-black text-[#0A1128] text-xl">{{ substr($project->association->name ?? 'A', 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-[#0A1128] text-sm">{{ $project->association->name ?? 'Association' }}</p>
                        <p class="text-xs text-[#F5A623] font-bold uppercase tracking-wider mt-0.5 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">verified</span> Partenaire Vérifié
                        </p>
                    </div>
                </div>

                <p class="text-slate-500 text-sm leading-relaxed line-clamp-4 font-medium mb-8">
                    {{ $project->description }}
                </p>
            </div>

            <div class="bg-gradient-to-br from-[#0A1128] to-[#1a2744] p-6 rounded-3xl shadow-xl text-white relative overflow-hidden group hover:scale-[1.02] transition-transform">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#F5A623]/20 rounded-full blur-2xl group-hover:bg-[#F5A623]/30 transition-colors"></div>
                <div class="relative z-10 flex items-start gap-4">
                    <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm border border-white/10">
                        <span class="material-symbols-outlined text-[#F5A623] text-2xl">visibility</span>
                    </div>
                    <div>
                        <h3 class="font-black text-white text-lg">100% Transparence</h3>
                        <p class="text-sm text-blue-100/70 mt-1 leading-relaxed">Les fonds sont bloqués jusqu'à la soumission du rapport d'impact par l'association.</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-6 items-center text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">verified_user</span>
                    <span class="text-xs font-black uppercase tracking-widest text-[#0A1128]">Plateforme Auditée</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">lock</span>
                    <span class="text-xs font-black uppercase tracking-widest text-[#0A1128]">SSL 256-bit</span>
                </div>
            </div>
        </div>

        <!-- Donation Form -->
        <div class="lg:col-span-7 neu-card p-8 md:p-12 relative overflow-hidden">
            <div class="absolute -top-10 -right-10 text-slate-50 opacity-50 pointer-events-none">
                <span class="material-symbols-outlined text-[200px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
            </div>
            
            <div class="relative z-10">
                @if ($errors->any())
                    <div class="mb-8 p-4 rounded-xl bg-red-50 text-red-600 text-sm font-bold border border-red-100 shadow-sm flex gap-3 items-start">
                        <span class="material-symbols-outlined">error</span>
                        <ul class="list-disc list-inside mt-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('donations.store', $project->id) }}" method="POST" enctype="multipart/form-data" id="donationForm" onsubmit="disableSubmit()">
                    @csrf

                    <!-- 1. Amount -->
                    <section class="mb-12">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-[#0A1128] text-white flex items-center justify-center font-black text-sm">1</div>
                            <h2 class="text-2xl font-black text-[#0A1128] tracking-tight">Montant du don</h2>
                        </div>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                            <button type="button" onclick="setAmount(100, this)" class="amount-btn bg-white py-4 px-4 flex flex-col items-center justify-center shadow-sm">
                                <span class="text-lg font-black text-[#0A1128]">100 DH</span>
                            </button>
                            <button type="button" onclick="setAmount(500, this)" class="amount-btn bg-white py-4 px-4 flex flex-col items-center justify-center shadow-sm">
                                <span class="text-lg font-black text-[#0A1128]">500 DH</span>
                            </button>
                            <button type="button" onclick="setAmount(1000, this)" class="amount-btn bg-white py-4 px-4 flex flex-col items-center justify-center shadow-sm">
                                <span class="text-lg font-black text-[#0A1128]">1000 DH</span>
                            </button>
                            <button type="button" onclick="setAmount(2500, this)" class="amount-btn bg-white py-4 px-4 flex flex-col items-center justify-center shadow-sm">
                                <span class="text-lg font-black text-[#0A1128]">2500 DH</span>
                            </button>
                        </div>

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                <span class="text-[#0A1128] font-black text-xl">DH</span>
                            </div>
                            <input type="number" id="amount" name="amount" min="100" required value="{{ old('amount') }}" oninput="clearButtons()"
                                   class="modern-input w-full py-5 pl-16 pr-6" placeholder="Ou saisissez un montant libre (Min 100 DH)"/>
                        </div>
                        @error('amount') <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p> @enderror
                    </section>

                    <!-- 2. Message & Privacy -->
                    <section class="mb-12">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-[#0A1128] text-white flex items-center justify-center font-black text-sm">2</div>
                            <h2 class="text-2xl font-black text-[#0A1128] tracking-tight">Votre mot de soutien</h2>
                        </div>
                        
                        <textarea id="message" name="message" rows="3" placeholder="Laissez un message d'encouragement public ou privé... (Optionnel)"
                                  class="modern-input w-full p-5 mb-5 resize-none">{{ old('message') }}</textarea>

                        <label class="flex items-start gap-4 cursor-pointer p-5 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-colors bg-white shadow-sm">
                            <div class="mt-0.5">
                                <input type="checkbox" name="isAnonymous" value="1" {{ old('isAnonymous') ? 'checked' : '' }} 
                                       class="w-5 h-5 rounded border-slate-300 text-[#0A1128] focus:ring-[#F5A623]"/>
                            </div>
                            <div>
                                <span class="text-sm font-black text-[#0A1128] block mb-1">Rendre mon don anonyme</span>
                                <span class="text-xs text-slate-500 font-medium leading-relaxed">Votre identité ne sera pas affichée sur la page du projet. L'association et l'administration pourront cependant identifier votre don.</span>
                            </div>
                        </label>
                    </section>

                    <!-- 3. Payment Method -->
                    <section class="mb-12">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-full bg-[#0A1128] text-white flex items-center justify-center font-black text-sm">3</div>
                            <h2 class="text-2xl font-black text-[#0A1128] tracking-tight">Règlement</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <label class="flex items-center justify-between p-6 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-[#F5A623] transition-colors has-[:checked]:border-[#F5A623] has-[:checked]:bg-[#F5A623]/5 bg-white shadow-sm group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-has-[:checked]:bg-[#F5A623] group-has-[:checked]:text-[#0A1128] transition-colors">
                                        <span class="material-symbols-outlined text-xl">credit_card</span>
                                    </div>
                                    <div>
                                        <p class="font-black text-sm text-[#0A1128]">Paiement en ligne</p>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 mt-1">Stripe / Carte</p>
                                    </div>
                                </div>
                                <input type="radio" name="paymentMethod" value="ONLINE" {{ old('paymentMethod') == 'ONLINE' ? 'checked' : '' }} required onchange="toggleReceipt()" class="text-[#0A1128] focus:ring-[#F5A623] h-5 w-5"/>
                            </label>
                            
                            <label class="flex items-center justify-between p-6 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-[#F5A623] transition-colors has-[:checked]:border-[#F5A623] has-[:checked]:bg-[#F5A623]/5 bg-white shadow-sm group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center group-has-[:checked]:bg-[#F5A623] group-has-[:checked]:text-[#0A1128] transition-colors">
                                        <span class="material-symbols-outlined text-xl">account_balance</span>
                                    </div>
                                    <div>
                                        <p class="font-black text-sm text-[#0A1128]">Virement</p>
                                        <p class="text-[10px] uppercase font-bold text-slate-400 mt-1">Manuel / Agence</p>
                                    </div>
                                </div>
                                <input type="radio" name="paymentMethod" value="MANUAL" {{ old('paymentMethod') == 'MANUAL' ? 'checked' : '' }} required onchange="toggleReceipt()" class="text-[#0A1128] focus:ring-[#F5A623] h-5 w-5"/>
                            </label>
                        </div>

                        <!-- Manual Payment Instructions -->
                        <div id="receipt-upload" class="hidden animate-fade-in">
                            <div class="bg-blue-50/50 border border-blue-100 rounded-2xl p-6 mb-6 flex items-start gap-4">
                                <span class="material-symbols-outlined text-blue-500 text-2xl mt-1">info</span>
                                <div>
                                    <h4 class="font-black text-[#0A1128] text-sm mb-2">Instructions pour le virement</h4>
                                    <p class="text-sm text-slate-600 font-medium mb-3">Veuillez transférer le montant sur le RIB officiel de la fondation AL-KHAIR :</p>
                                    <div class="bg-white px-4 py-3 rounded-xl border border-blue-200 font-mono text-[#0A1128] font-bold tracking-widest text-sm mb-4 inline-block">
                                        MA64 007 010 0000000000000000 12
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6 border-2 border-dashed border-slate-300 rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors">
                                <div class="flex flex-col md:flex-row items-center gap-6">
                                    <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center border border-slate-200 flex-shrink-0">
                                        <span class="material-symbols-outlined text-[#F5A623] text-3xl">upload_file</span>
                                    </div>
                                    <div class="flex-grow text-center md:text-left">
                                        <label for="paymentReceipt" class="block text-[#0A1128] font-black mb-1">Joindre la preuve de virement *</label>
                                        <p class="text-[11px] font-bold text-slate-400 mb-4 uppercase tracking-widest">Formats acceptés : PDF, JPG, PNG. Max 5MB.</p>
                                        <input type="file" id="paymentReceipt" name="paymentReceipt" accept=".pdf,.jpg,.jpeg,.png" 
                                               class="block w-full text-sm text-slate-500 mx-auto md:mx-0"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="pt-6 border-t border-slate-100">
                        <button type="submit" id="submitBtn" class="w-full bg-[#0A1128] hover:bg-[#F5A623] text-white hover:text-[#0A1128] font-black text-lg py-5 rounded-2xl transition-all flex items-center justify-center gap-3 shadow-xl active:scale-[0.98] group">
                            <span class="material-symbols-outlined group-hover:-translate-y-1 transition-transform">favorite</span>
                            <span id="btnText">Confirmer mon don solidaire</span>
                        </button>
                        <div class="flex items-center justify-center gap-2 mt-4 text-slate-400">
                            <span class="material-symbols-outlined text-sm">lock</span>
                            <p class="text-[10px] uppercase tracking-widest font-black">Paiement 100% sécurisé</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Set active amount button
    function setAmount(value, btnElement) {
        document.getElementById('amount').value = value;
        let buttons = document.querySelectorAll('.amount-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');
    }

    // Clear active state when typing custom amount
    function clearButtons() {
        let buttons = document.querySelectorAll('.amount-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
    }

    // Toggle receipt upload based on payment method
    function toggleReceipt() {
        const methodObj = document.querySelector('input[name="paymentMethod"]:checked');
        if (!methodObj) return;
        const method = methodObj.value;
        const receiptDiv = document.getElementById('receipt-upload');
        const receiptInput = document.getElementById('paymentReceipt');

        if (method === 'MANUAL') {
            receiptDiv.classList.remove('hidden');
            receiptInput.setAttribute('required', 'required');
        } else {
            receiptDiv.classList.add('hidden');
            receiptInput.removeAttribute('required');
            receiptInput.value = '';
        }
    }

    // Prevent double submission
    function disableSubmit() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        document.getElementById('btnText').innerText = 'Traitement sécurisé en cours...';
        btn.querySelector('.material-symbols-outlined').innerText = 'hourglass_empty';
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleReceipt();
    });
</script>

</body>
</html>