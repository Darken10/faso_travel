<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-slot name="registre">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                Créer un compte
            </a>
        </x-slot>

        {{-- Form header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Connexion</h2>
            <p class="mt-1 text-sm text-surface-500 dark:text-surface-400">Accédez à votre espace personnel</p>
        </div>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 p-3 rounded-xl bg-success-50 border border-success-200 text-sm text-success-700 dark:bg-success-500/10 dark:border-success-500/20 dark:text-success-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
            </div>

            <div>
                <x-label for="password" value="Mot de passe" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-surface-600 dark:text-surface-400">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 transition-colors" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <x-button class="w-full justify-center">
                Se connecter
            </x-button>
        </form>

    </x-authentication-card>
</x-guest-layout>
