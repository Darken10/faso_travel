<div class="p-6 ">
    <h5 class="text-2xl font-bold text-gray-900 mb-4 text-center ">Acheter le Ticket</h5>

    <!-- Sélection de la chaise -->
    <div class="mb-4">
        <x-label for="numero_chaise" value="Numéro de la Chaise" class="block mb-2 font-semibold text-gray-900" />
        <select wire:model="numero_chaise" id="numero_chaise" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="">Sélectionner une chaise</option>
            @forelse($chaiseDispo as $chaise)
                <option value="{{ $chaise }}">Chaise N° {{ $chaise }}</option>
            @empty
                <option value="">Pas de place disponible</option>
            @endforelse
        </select>
        <x-input-error for="numero_chaise" />
    </div>

    <!-- Sélection du type de voyage -->
    <div class="mb-4">
        <x-label value="Type de voyage" class="block mb-2 font-semibold text-gray-900" />
        <div class="flex space-x-4">
            <label><input type="radio" wire:model="voyageType" value="aller_simple" class="mr-2"> Aller Simple</label>
            <label><input type="radio" wire:model="voyageType" value="aller_retour" class="mr-2"> Aller-Retour</label>
        </div>
        <x-input-error for="voyageType" />
    </div>

    <!-- Sélection des bagages -->
    {{--<div class="mb-4">
        <x-label value="Bagages" class="block mb-2 text-sm font-medium text-gray-900" />
        <div class="flex flex-wrap gap-2">
            @foreach($bagageOptions as $bagage)
                <label class="flex items-center">
                    <input type="checkbox" wire:model="bagages" value="{{ $bagage }}" class="mr-2">
                    {{ $bagage }}
                </label>
            @endforeach
        </div>
        <x-input-error for="bagages" />
    </div>--}}

    <!-- Boutons radio pour la sélection -->
    <div class="mb-4">
        <label class="block mb-2 font-semibold">Achetez-vous le ticket pour :</label>
        <div class="flex space-x-4">
            <label>
                <input type="radio" wire:model.live="buyFor" value="self" class="mr-2"> Vous-même
            </label>
            <label>
                <input type="radio" wire:model.live="buyFor" value="other" class="mr-2"> Une autre personne
            </label>
        </div>
    </div>

    <!-- Formulaire pour une autre personne -->
    @if ($buyFor === 'other')
        <div class="p-4 border rounded bg-gray-50 space-y-4">
            <div>
                <x-label for="first_name">Nom :</x-label>
                <x-input wire:model.defer="otherPerson.first_name" id="first_name" class="w-full" />
                <x-input-error for="otherPerson.first_name" />
            </div>

            <div>
                <x-label for="last_name">Prénom :</x-label>
                <x-input wire:model.defer="otherPerson.last_name" id="last_name" class="w-full" />
                <x-input-error for="otherPerson.last_name" />
            </div>

            <div class="flex gap-4">
                <label><input type="radio" wire:model="otherPerson.sexe" value="Homme" class="mr-2"> Homme</label>
                <label><input type="radio" wire:model="otherPerson.sexe" value="Femme" class="mr-2"> Femme</label>
                <label><input type="radio" wire:model="otherPerson.sexe" value="Autre" class="mr-2"> Autre</label>
                <x-input-error for="otherPerson.sexe" />
            </div>

            <div>
                <x-label for="numero_identifiant">Identifiant :</x-label>
                <x-input wire:model.defer="otherPerson.numero_identifiant" id="numero_identifiant" class="w-full" />
                <x-input-error for="otherPerson.numero_identifiant" />
            </div>

            <div>
                <x-label for="numero">Numéro :</x-label>
                <x-input wire:model.defer="otherPerson.numero" id="numero" class="w-full" />
                <x-input-error for="otherPerson.numero" />
            </div>

            <div>
                <x-label for="email">Email (facultatif) :</x-label>
                <x-input wire:model.defer="otherPerson.email" id="email" class="w-full" />
                <x-input-error for="otherPerson.email" />
            </div>

            <div>
                <x-label for="lien_relation">Lien de relation :</x-label>
                <select wire:model.defer="otherPerson.lien_relation" id="lien_relation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Sélectionner</option>
                    @foreach($liens as $lien)
                        <option value="{{ $lien }}">{{ $lien }}</option>
                    @endforeach
                </select>
                <x-input-error for="otherPerson.lien_relation" />
            </div>
        </div>
    @endif

    <button wire:click="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Valider l'achat</button>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif
</div>
