<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- Form header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-surface-900 dark:text-white">Créer un compte</h2>
            <p class="mt-1 text-sm text-surface-500 dark:text-surface-400">Rejoignez Faso Travel en quelques minutes</p>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Name fields --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-label for="first_name" value="Nom" />
                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" placeholder="Nom" />
                </div>
                <div>
                    <x-label for="last_name" value="Prénom" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="name" placeholder="Prénom" />
                </div>
            </div>

            {{-- Gender --}}
            <div>
                <x-label value="Genre" />
                <div class="flex flex-wrap gap-4 mt-1.5">
                    @foreach(\App\Enums\SexeUser::cases() as $sexe)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sexe" value="{{ $sexe->value }}"
                                @checked(old('sexe') == $sexe->value)
                                class="w-4 h-4 text-primary-600 border-surface-300 focus:ring-primary-500 dark:border-surface-600 dark:bg-surface-800 dark:focus:ring-primary-400" />
                            <span class="text-sm text-surface-700 dark:text-surface-300">{{ $sexe->value }}</span>
                        </label>
                    @endforeach
                </div>
                <x-input-error for="sexe" />
            </div>

            {{-- Phone number --}}
            <div>
                <x-label value="Téléphone" />
                <div class="grid grid-cols-5 gap-2 mt-1">
                    <div class="col-span-2">
                        <select id="numero_identifiant" name="numero_identifiant"
                                class="input text-sm">
                            @foreach(\App\Models\Ville\Pays::all() as $pays)
                                <option @selected($pays === auth()?->user()?->numero_identifiant) value="{{ $pays->identity_number }}">
                                    {{ $pays->identity_number }} ({{ $pays->iso2 }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error for="numero_identifiant" />
                    </div>
                    <div class="col-span-3">
                        <input type="text" id="numero" name="numero" value="{{ old('numero') }}"
                               class="input" pattern="[0-9]{8,12}" placeholder="70 00 00 00" required />
                        <x-input-error for="numero" />
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div>
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votre@email.com" />
            </div>

            {{-- Password --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-label for="password" value="Mot de passe" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <div>
                    <x-label for="password_confirmation" value="Confirmer" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                </div>
            </div>

            {{-- Terms --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div>
                    <label for="terms" class="flex items-start gap-2 cursor-pointer">
                        <x-checkbox name="terms" id="terms" required class="mt-0.5" />
                        <span class="text-sm text-surface-600 dark:text-surface-400 leading-relaxed">
                            J'accepte les
                            <a target="_blank" href="{{ route('terms.show') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">conditions d'utilisation</a>
                            et la
                            <a target="_blank" href="{{ route('policy.show') }}" class="font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400">politique de confidentialité</a>
                        </span>
                    </label>
                </div>
            @endif

            <x-button class="w-full justify-center">
                Créer mon compte
            </x-button>

            <p class="text-center text-sm text-surface-500 dark:text-surface-400">
                Déjà inscrit ?
                <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-400 transition-colors">
                    Se connecter
                </a>
            </p>
        </form>
    </x-authentication-card>
</x-guest-layout>
