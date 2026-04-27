<footer class="bg-[#0A1128] text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-xl font-black mb-4 text-[#F5A623]">AL-KHAIR</h3>
                <p class="text-white/70 text-sm">Plateforme solidaire de collecte de dons pour les associations marocaines.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold mb-4">Liens Rapides</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-white/70 hover:text-[#F5A623] transition-colors">Accueil</a></li>
                    <li><a href="{{ route('projects.index') }}" class="text-white/70 hover:text-[#F5A623] transition-colors">Projets</a></li>
                    <li><a href="{{ route('impact.index') }}" class="text-white/70 hover:text-[#F5A623] transition-colors">Rapports d'Impact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('faq') }}" class="text-white/70 hover:text-[#F5A623] transition-colors">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/70 hover:text-[#F5A623] transition-colors">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="font-bold mb-4">Contact</h4>
                <ul class="space-y-2 text-sm text-white/70">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        contact@alkhair.ma
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        Casablanca, Maroc
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 mt-8 pt-8 text-center text-sm text-white/50">
            <p>&copy; {{ date('Y') }} AL-KHAIR. Tous droits réservés. Développé avec ❤️ pour le Maroc</p>
        </div>
    </div>
</footer>
