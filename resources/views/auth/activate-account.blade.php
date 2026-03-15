<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-slot name="registre">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300 transition-colors">
                Se connecter
            </a>
        </x-slot>

        {{-- Form header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Activez votre compte</h2>
            <p class="mt-1 text-sm text-surface-500 dark:text-surface-400">
                Bienvenue <strong>{{ $user->first_name }}</strong>, vous avez été invité(e) à rejoindre <strong>{{ $companyName }}</strong>.
            </p>
        </div>

        {{-- User info card --}}
        <div class="mb-6 p-4 rounded-xl bg-surface-50 dark:bg-surface-800 border border-surface-200 dark:border-surface-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <span class="text-sm font-bold text-primary-600 dark:text-primary-400">{{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="text-sm font-semibold text-surface-900 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</p>
                    <p class="text-xs text-surface-500 dark:text-surface-400">{{ $user->email }}</p>
                </div>
            </div>
            @if($user->roles->isNotEmpty())
                <div class="mt-3 flex flex-wrap gap-1.5">
                    @foreach($user->roles as $role)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400">
                            {{ $role->label ?? $role->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('account.activate.post', ['token' => $token]) }}" class="space-y-5">
            @csrf

            <div>
                <x-label for="password" value="Mot de passe" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Choisissez un mot de passe sécurisé" />
                <p class="mt-1 text-xs text-surface-400 dark:text-surface-500">Minimum 8 caractères</p>
            </div>

            <div>
                <x-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez votre mot de passe" />
            </div>

            <x-button class="w-full justify-center">
                Activer mon compte
            </x-button>
        </form>

    </x-authentication-card>
</x-guest-layout>
