<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - AL-KHAIR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50">
    @include('layouts.navigation')

    <div class="min-h-screen py-16">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-[#0A1128] mb-4">Questions Fréquentes</h1>
                <p class="text-slate-600 max-w-2xl mx-auto">Trouvez rapidement les réponses à vos questions sur AL-KHAIR</p>
            </div>

            <!-- FAQ Categories -->
            @foreach($faqs as $category)
                <div class="mb-8">
                    <h2 class="text-2xl font-black text-[#0A1128] mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[#F5A623]">folder</span>
                        {{ $category['category'] }}
                    </h2>

                    <div class="space-y-3">
                        @foreach($category['questions'] as $index => $faq)
                            <div x-data="{ open: false }" class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition-all">
                                <button @click="open = !open" 
                                    class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                                    <span class="font-bold text-[#0A1128] pr-4">{{ $faq['question'] }}</span>
                                    <span class="material-symbols-outlined text-[#F5A623] flex-shrink-0 transition-transform" 
                                        :class="open ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                
                                <div x-show="open" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="px-6 pb-4 text-slate-600 border-t border-slate-100">
                                    <p class="pt-4">{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Contact CTA -->
            <div class="mt-12 bg-gradient-to-br from-[#0A1128] to-[#1a2744] rounded-2xl p-8 text-center text-white">
                <span class="material-symbols-outlined text-5xl text-[#F5A623] mb-4 block">support_agent</span>
                <h3 class="text-2xl font-black mb-3">Vous n'avez pas trouvé votre réponse ?</h3>
                <p class="text-white/80 mb-6">Notre équipe est là pour vous aider</p>
                <a href="{{ route('contact') }}" 
                    class="inline-flex items-center gap-2 bg-[#F5A623] text-[#0A1128] px-6 py-3 rounded-xl font-bold hover:bg-white transition-all shadow-lg">
                    <span class="material-symbols-outlined">mail</span>
                    Contactez-nous
                </a>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
