@extends('auth.register.register-layoute')

@section('formulaire')

    <form method="POST" >
        @csrf

        <div>
            <x-label for="first_name" value="{{ __('Nom') }}" />
            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="name" />
        </div>

        <div>
            <x-label for="last_name" value="{{ __('Prenom') }}" />
            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="name" />
        </div>



        <div class="mt-4">
            <div class="md:flex gap-4 items-center">
                <div class="flex items-center mb-4">
                    <input id="{{\App\Enums\SexeUser::Homme}}" name="sexe"  type="radio"
                        value="{{\App\Enums\SexeUser::Homme}}"
                        @checked( old('sexe') == \App\Enums\SexeUser::Homme )
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{\App\Enums\SexeUser::Homme}}"
                        class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">Homme</label>
                </div>

                <div class="flex items-center mb-4">
                    <input id="{{\App\Enums\SexeUser::Femme}}" name="sexe" type="radio"
                        value="{{\App\Enums\SexeUser::Femme}}"
                        @checked( old('sexe') == \App\Enums\SexeUser::Femme )  class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{\App\Enums\SexeUser::Femme}}"
                        class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                        Femme
                    </label>
                </div>

                <div class="flex items-center mb-4">
                    <input id="{{\App\Enums\SexeUser::Autre}}" name="sexe" type="radio"
                        value="{{\App\Enums\SexeUser::Autre}}"
                        @checked( old('sexe') == \App\Enums\SexeUser::Autre )
                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{\App\Enums\SexeUser::Autre}}"  class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300"> Autre </label>
                </div>
            </div>
            <x-input-error for="sexe"/>
        </div>


        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ms-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>

@endsection
