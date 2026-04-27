<nav x-data="{ open: false }" class="bg-surface border-b border-outline-variant/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10">
                            <x-application-logo class="w-10 h-10" />
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="font-body font-bold text-primary-container">
                            {{ __('Dashboard Admin') }}
                        </x-nav-link>
                    @elseif(Auth::user()->isAssociation())
                        <x-nav-link :href="route('association.dashboard')" :active="request()->routeIs('association.dashboard')" class="font-body font-bold text-primary-container">
                            {{ __('Espace Association') }}
                        </x-nav-link>
                    @elseif(Auth::user()->isDonator())
                        <x-nav-link :href="route('donator.dashboard')" :active="request()->routeIs('donator.dashboard')" class="font-body font-bold text-primary-container">
                            {{ __('Mon Espace') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-body font-bold text-primary-container">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-outline-variant/30 text-sm leading-4 font-bold rounded-full text-primary-container bg-surface-container-lowest hover:bg-surface-container-low focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div class="w-6 h-6 rounded-full bg-primary-container/10 text-primary-container flex items-center justify-center mr-2 text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <span class="material-symbols-outlined text-[18px]">expand_more</span>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-body font-semibold text-on-surface-variant hover:text-primary-container hover:bg-surface-container-low">
                            <span class="material-symbols-outlined text-[18px] align-middle mr-2">manage_accounts</span>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="font-body font-semibold text-error hover:bg-error-container/50">
                                <span class="material-symbols-outlined text-[18px] align-middle mr-2">logout</span>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-on-surface-variant hover:text-primary-container hover:bg-surface-container-low focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-surface-container-lowest border-b border-outline-variant/20 shadow-md absolute w-full">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="font-body font-bold text-primary-container">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->isAssociation())
                <x-responsive-nav-link :href="route('association.dashboard')" :active="request()->routeIs('association.dashboard')" class="font-body font-bold text-primary-container">
                    {{ __('Espace Association') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->isDonator())
                <x-responsive-nav-link :href="route('donator.dashboard')" :active="request()->routeIs('donator.dashboard')" class="font-body font-bold text-primary-container">
                    {{ __('Mon Espace') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-body font-bold text-primary-container">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-outline-variant/20">
            <div class="px-4 flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-full bg-primary-container/10 text-primary-container flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-headline font-bold text-base text-primary-container">{{ Auth::user()->name }}</div>
                    <div class="font-body font-medium text-sm text-on-surface-variant">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="font-body font-semibold text-on-surface-variant flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">manage_accounts</span> {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="font-body font-semibold text-error flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">logout</span> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>