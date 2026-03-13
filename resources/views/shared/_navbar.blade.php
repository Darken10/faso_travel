<nav x-data="{ mobileOpen: false }" class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-xl border-b border-surface-200/80 dark:bg-surface-900/80 dark:border-surface-700/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <x-logo />
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:gap-1">
                <a href="/" class="px-3 py-2 text-sm font-medium text-surface-600 rounded-lg hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-300 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    Accueil
                </a>
                <a href="{{ route('voyage.index') }}" class="px-3 py-2 text-sm font-medium text-surface-600 rounded-lg hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-300 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    Voyages
                </a>
                <a href="{{ route('ticket.myTickets') }}" class="px-3 py-2 text-sm font-medium text-surface-600 rounded-lg hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-300 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    Mes Tickets
                </a>
                <a href="{{ route('client.compagnies.index') }}" class="px-3 py-2 text-sm font-medium text-surface-600 rounded-lg hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-300 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    Compagnies
                </a>
                <a href="{{ route('divers.about-us') }}" class="px-3 py-2 text-sm font-medium text-surface-600 rounded-lg hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-300 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    À propos
                </a>
            </div>

            <!-- Right section: notifications + profile + logout -->
            <div class="flex items-center gap-2">
                <!-- Notifications -->
                <a href="{{ route('user.notifications') }}" class="relative p-2 rounded-xl text-surface-500 hover:text-primary-600 hover:bg-primary-50 transition-colors dark:text-surface-400 dark:hover:text-primary-400 dark:hover:bg-primary-900/20">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    @if(Auth::user()->unreadNotifications()->count() > 0)
                        <span class="absolute -top-0.5 -right-0.5 flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-danger-500 rounded-full ring-2 ring-white dark:ring-surface-900">
                            {{ Auth::user()->unreadNotifications()->count() }}
                        </span>
                    @endif
                </a>

                <!-- Profile -->
                <a href="{{ route('profile.show') }}" class="hidden sm:flex items-center gap-2 p-1.5 rounded-xl hover:bg-surface-100 transition-colors dark:hover:bg-surface-800">
                    <img class="h-8 w-8 rounded-full object-cover ring-2 ring-surface-200 dark:ring-surface-600"
                         src="{{ asset(Auth::user()->profileUrl ? Auth::user()->profileUrl : 'icon/user1.png') }}"
                         alt="Profile" />
                    <span class="hidden md:block text-sm font-medium text-surface-700 dark:text-surface-300">
                        {{ Auth::user()->first_name ?? '' }}
                    </span>
                </a>

                <!-- Logout (desktop) -->
                <form action="{{ route('logout') }}" method="post" class="hidden lg:block">
                    @csrf
                    <button type="submit" class="p-2 rounded-xl text-surface-500 hover:text-danger-600 hover:bg-danger-50 transition-colors dark:text-surface-400 dark:hover:text-danger-400 dark:hover:bg-danger-900/20" title="Se déconnecter">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                </form>

                <!-- Mobile hamburger -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-xl text-surface-500 hover:bg-surface-100 transition-colors dark:text-surface-400 dark:hover:bg-surface-800">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden border-t border-surface-200 dark:border-surface-700 bg-white dark:bg-surface-900">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block px-3 py-2.5 text-sm font-medium text-surface-700 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-colors dark:text-surface-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400">
                Accueil
            </a>
            <a href="{{ route('voyage.index') }}" class="block px-3 py-2.5 text-sm font-medium text-surface-700 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-colors dark:text-surface-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400">
                Voyages
            </a>
            <a href="{{ route('ticket.myTickets') }}" class="block px-3 py-2.5 text-sm font-medium text-surface-700 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-colors dark:text-surface-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400">
                Mes Tickets
            </a>
            <a href="{{ route('client.compagnies.index') }}" class="block px-3 py-2.5 text-sm font-medium text-surface-700 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-colors dark:text-surface-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400">
                Compagnies
            </a>
            <a href="{{ route('divers.about-us') }}" class="block px-3 py-2.5 text-sm font-medium text-surface-700 rounded-xl hover:bg-primary-50 hover:text-primary-600 transition-colors dark:text-surface-300 dark:hover:bg-primary-900/20 dark:hover:text-primary-400">
                À propos
            </a>

            <div class="divider my-2"></div>

            <!-- Mobile profile -->
            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-surface-100 transition-colors dark:hover:bg-surface-800">
                <img class="h-8 w-8 rounded-full object-cover ring-2 ring-surface-200 dark:ring-surface-600"
                     src="{{ asset(Auth::user()->profileUrl ? Auth::user()->profileUrl : 'icon/user1.png') }}"
                     alt="Profile" />
                <span class="text-sm font-medium text-surface-700 dark:text-surface-300">Mon profil</span>
            </a>

            <!-- Mobile logout -->
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-medium text-danger-600 rounded-xl hover:bg-danger-50 transition-colors dark:text-danger-400 dark:hover:bg-danger-900/20">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</nav>
