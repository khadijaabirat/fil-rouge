<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - AL-KHAIR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body class="bg-slate-50">
    @include('layouts.navigation')

    <div class="min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-[#0A1128] mb-4">Contactez-nous</h1>
                <p class="text-slate-600 max-w-2xl mx-auto">Une question ? Une suggestion ? N'hésitez pas à nous contacter. Notre équipe vous répondra dans les plus brefs délais.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[#F5A623]">mail</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#0A1128] mb-1">Email</h3>
                                <p class="text-slate-600 text-sm">contact@alkhair.ma</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[#F5A623]">phone</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#0A1128] mb-1">Téléphone</h3>
                                <p class="text-slate-600 text-sm">+212 5XX-XXXXXX</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[#F5A623]">location_on</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-[#0A1128] mb-1">Adresse</h3>
                                <p class="text-slate-600 text-sm">Casablanca, Maroc</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-[#0A1128] to-[#1a2744] rounded-2xl p-6 text-white">
                        <h3 class="font-bold mb-3">Horaires d'ouverture</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-white/70">Lundi - Vendredi</span>
                                <span class="font-bold">9h - 18h</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-white/70">Samedi</span>
                                <span class="font-bold">9h - 13h</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-white/70">Dimanche</span>
                                <span class="font-bold">Fermé</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
                        @if(session('success'))
                            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2">
                                <span class="material-symbols-outlined">check_circle</span>
                                <span class="text-sm font-bold">{{ session('success') }}</span>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
                                <span class="material-symbols-outlined">error</span>
                                <span class="text-sm font-bold">{{ session('error') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-[#0A1128] mb-2">Nom complet *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623]/20 outline-none transition-all">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-[#0A1128] mb-2">Email *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623]/20 outline-none transition-all">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-[#0A1128] mb-2">Sujet *</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623]/20 outline-none transition-all">
                                @error('subject')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-[#0A1128] mb-2">Message *</label>
                                <textarea name="message" rows="6" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[#F5A623] focus:ring-2 focus:ring-[#F5A623]/20 outline-none transition-all resize-none">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                class="w-full bg-[#0A1128] text-white py-4 rounded-xl font-bold hover:bg-[#F5A623] hover:text-[#0A1128] transition-all shadow-lg flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">send</span>
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
