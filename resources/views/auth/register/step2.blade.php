@extends('auth.register.register-layoute')


@section('formulaire')

    <form method="POST">
        @csrf

        <div class="grid grid-cols-6">
            <div class="md:flex gap-4 items-center col-span-2">
                <div class="w-full">
                    <x-label for="numero_identifiant"> Identifiant: </x-label>
                    <select id="numero_identifiant"
                            name="numero_identifiant"
                            class="bg-gray-50 border border-e-0 border-gray-300 text-gray-900 text-sm rounded-s-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach(\App\Models\Ville\Pays::all() as $pays)
                            <option @selected($pays=== auth()?->user()?->numero_identifiant) value="{{ $pays->identity_number  }}">{{$pays->identity_number}} ({{$pays->iso2}})</option>
                        @endforeach
                    </select>
                    <x-input-error for="numero_identifiant"  />
                </div>
            </div>
            <div class="md:flex gap-4 items-center col-span-4">
                <div class="w-full">
                    <x-label for="numero"> Numero: </x-label>
                    <input  type="text"
                              id="numero"
                              name="numero"
                              value="{{ old('numero') }}"
                              class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                            {{--pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"--}}
                            pattern="[0-9]{8,12}"
                              placeholder="70707070"
                              required  />
                    <x-input-error for="numero" />
                </div>
            </div>
        </div>

        <div class="md:flex gap-4 items-center">
            <div class="w-full">
                <x-label for="email"> email(facultaif):  </x-label>
                <x-input  type="email"  id="email" name="email" value="{{ old('email') }}" class="w-full" />
                <x-input-error for="email" />
            </div>
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
