<footer class="bg-gradient-to-br from-gray-50 to-white pt-16 pb-8 border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div>
                <a href="{{ url('/') }}" class="inline-block mb-4">
                    <x-application-logo class="w-32 h-32 text-[#0A1128]" />
                </a>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Plateforme marocaine de dons solidaires avec transparence totale.
                </p>
            </div>

            <div>
                <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-4">Navigation</h6>
                <ul class="space-y-2 text-slate-600 text-sm">
                    <li><a href="{{ url('/') }}" class="hover:text-[#F5A623] transition-colors">Accueil</a></li>
                    <li><a href="{{ route('projects.index') }}" class="hover:text-[#F5A623] transition-colors">Projets</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-[#F5A623] transition-colors">S'inscrire</a></li>
                </ul>
            </div>

            <div>
                <h6 class="text-[#0A1128] font-black uppercase tracking-widest text-sm mb-4">Contact</h6>
                <ul class="space-y-2 text-slate-600 text-sm">
                    <li>Email: contact@alkhair.ma</li>
                    <li>Tél: +212 5 00 00 00 00</li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-200 text-center">
            <p class="text-sm text-slate-500">© 2026 Al-Khair. Conçu avec passion au Maroc 🇲🇦</p>
        </div>
    </div>
</footer>
