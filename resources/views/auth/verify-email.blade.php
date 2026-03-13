<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-6">
            <div class="w-14 h-14 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Vérifiez votre email</h2>
            <p class="mt-2 text-sm text-surface-500 dark:text-surface-400 leading-relaxed">
                Nous avons envoyé un lien de vérification à votre adresse email. Cliquez sur le lien pour activer votre compte.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 p-3 rounded-xl bg-success-50 border border-success-200 text-sm text-success-700 dark:bg-success-500/10 dark:border-success-500/20 dark:text-success-400">
                Un nouveau lien de vérification a été envoyé à votre adresse email.
            </div>
        @endif

        <div class="space-y-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button type="submit" class="w-full justify-center">
                    Renvoyer l'email de vérification
                </x-button>
            </form>

            <div class="flex items-center justify-between">
                <a href="{{ route('profile.show') }}"
                   class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 transition-colors">
                    Modifier le profil
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-surface-500 hover:text-surface-700 dark:text-surface-400 dark:hover:text-surface-300 transition-colors">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
