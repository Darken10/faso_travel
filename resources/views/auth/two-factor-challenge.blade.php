<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-6">
                <div class="w-14 h-14 bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Vérification en deux étapes</h2>
                <p class="mt-2 text-sm text-surface-500 dark:text-surface-400 leading-relaxed" x-show="! recovery">
                    Entrez le code d'authentification fourni par votre application.
                </p>
                <p class="mt-2 text-sm text-surface-500 dark:text-surface-400 leading-relaxed" x-cloak x-show="recovery">
                    Entrez un de vos codes de récupération d'urgence.
                </p>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5">
                @csrf

                <div x-show="! recovery">
                    <x-label for="code" value="Code d'authentification" />
                    <x-input id="code" class="block mt-1 w-full text-center tracking-[0.5em] text-lg" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" placeholder="000000" />
                </div>

                <div x-cloak x-show="recovery">
                    <x-label for="recovery_code" value="Code de récupération" />
                    <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <x-button class="w-full justify-center">
                    Vérifier
                </x-button>

                <div class="text-center">
                    <button type="button"
                            class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 transition-colors cursor-pointer"
                            x-show="! recovery"
                            x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">
                        Utiliser un code de récupération
                    </button>
                    <button type="button"
                            class="text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 transition-colors cursor-pointer"
                            x-cloak
                            x-show="recovery"
                            x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">
                        Utiliser un code d'authentification
                    </button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
