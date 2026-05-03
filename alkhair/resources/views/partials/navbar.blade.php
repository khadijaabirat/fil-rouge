<header id="main-nav" class="fixed w-full top-0 z-50 transition-all duration-300 bg-transparent py-4">
    <nav class="container mx-auto px-4 flex justify-between items-center bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 shadow-lg shadow-black/5">
        <a href="{{ url('/') }}" class="flex items-center group">
            <x-application-logo class="w-14 h-14 text-white group-hover:scale-105 transition-transform" />
        </a>
        
        <!-- Hamburger Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        
        <div class="hidden md:flex items-center gap-8">
            <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ url('/') }}">Accueil</a>
            <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ route('projects.index') }}">Projets</a>
            <a class="text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ route('impact.index') }}">Impact</a>

            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Dashboard Admin</a>
                @elseif(Auth::user()->isAssociation())
                    <a href="{{ route('association.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Espace Association</a>
                @elseif(Auth::user()->isDonator())
                    <a href="{{ route('donator.dashboard') }}" class="text-[#F5A623] font-bold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-[#F5A623]">Mon Espace</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="glass hover:bg-red-500/20 text-white text-sm font-bold px-5 py-2 rounded-xl transition-all shadow-sm">Quitter</button>
                </form>
            @else
                <a class="text-white/90 font-medium hover:text-[#F5A623] transition" href="{{ route('login') }}">Connexion</a>
                <a class="bg-gradient-to-r from-[#F5A623] to-[#FFD085] hover:scale-105 text-[#0A1128] font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg shadow-[#F5A623]/30 flex items-center gap-2" href="{{ route('register') }}">
                    S'inscrire <span class="text-lg leading-none">→</span>
                </a>
            @endauth
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl mx-4 mt-2 shadow-lg shadow-black/5">
        <div class="px-4 py-4 space-y-4">
            <a class="block text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ url('/') }}">Accueil</a>
            <a class="block text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ route('projects.index') }}">Projets</a>
            <a class="block text-white/90 font-medium hover:text-[#F5A623] transition-colors" href="{{ route('impact.index') }}">Impact</a>

            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block text-[#F5A623] font-bold">Dashboard Admin</a>
                @elseif(Auth::user()->isAssociation())
                    <a href="{{ route('association.dashboard') }}" class="block text-[#F5A623] font-bold">Espace Association</a>
                @elseif(Auth::user()->isDonator())
                    <a href="{{ route('donator.dashboard') }}" class="block text-[#F5A623] font-bold">Mon Espace</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left glass hover:bg-red-500/20 text-white text-sm font-bold px-4 py-2 rounded-xl transition-all shadow-sm mt-4">Quitter</button>
                </form>
            @else
                <a class="block text-white/90 font-medium hover:text-[#F5A623] transition" href="{{ route('login') }}">Connexion</a>
                <a class="block bg-gradient-to-r from-[#F5A623] to-[#FFD085] text-[#0A1128] font-bold px-4 py-2 rounded-xl transition-all shadow-lg shadow-[#F5A623]/30 text-center mt-4" href="{{ route('register') }}">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</header>

<style>
    .glass { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('main-nav');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        // Scroll effect for navbar
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-[#0A1128]/80', 'backdrop-blur-xl', 'shadow-xl');
                navbar.classList.remove('bg-transparent', 'py-4');
                navbar.classList.add('py-2');
            } else {
                navbar.classList.remove('bg-[#0A1128]/80', 'backdrop-blur-xl', 'shadow-xl');
                navbar.classList.add('bg-transparent', 'py-4');
                navbar.classList.remove('py-2');
            }
        });
        
        // Mobile menu toggle
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navbar.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
