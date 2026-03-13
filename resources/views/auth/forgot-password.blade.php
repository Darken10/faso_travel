<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Mot de passe oublié</h2>
            <p class="mt-2 text-sm text-surface-500 dark:text-surface-400 leading-relaxed">
                Pas de souci ! Indiquez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>
        </div>

        @session('status')
            <div class="mb-4 p-3 rounded-xl bg-success-50 border border-success-200 text-sm text-success-700 dark:bg-success-500/10 dark:border-success-500/20 dark:text-success-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
            </div>

            <x-button class="w-full justify-center">
                Envoyer le lien de réinitialisation
            </x-button>

            <p class="text-center text-sm text-surface-500 dark:text-surface-400">
                <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 transition-colors">
                    &larr; Retour à la connexion
                </a>
            </p>
        </form>
    </x-authentication-card>
</x-guest-layout>
