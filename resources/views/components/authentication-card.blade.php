<div class="min-h-screen flex">
    {{-- Left panel — Illustration / Brand --}}
    <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>
        <div class="relative z-10 flex flex-col justify-center items-center w-full px-12">
            <div class="max-w-md text-center">
                <div class="mb-8">
                    {{ $logo }}
                </div>
                <h1 class="text-3xl font-bold text-white mb-4">Bienvenue sur Liptra</h1>
                <p class="text-primary-200 text-lg leading-relaxed">
                    Réservez vos billets de transport en toute simplicité. Voyagez à travers le Burkina Faso en toute confiance.
                </p>
            </div>
            {{-- Decorative circles --}}
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-accent-500/10 rounded-full"></div>
            <div class="absolute bottom-20 right-10 w-20 h-20 bg-accent-400/20 rounded-full"></div>
        </div>
    </div>

    {{-- Right panel — Form --}}
    <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-12 bg-surface-50 dark:bg-surface-900">
        {{-- Mobile logo --}}
        <div class="lg:hidden mb-8">
            {{ $logo }}
        </div>

        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-surface-800 rounded-2xl shadow-card border border-surface-200 dark:border-surface-700 px-6 sm:px-8 py-8">
                {{ $slot }}
            </div>

            @if(isset($registre) && $registre)
                <p class="mt-6 text-center text-sm text-surface-500 dark:text-surface-400">
                    {{ $registre }}
                </p>
            @endif
        </div>
    </div>
</div>
