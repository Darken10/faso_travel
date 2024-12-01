<div >
    <div class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form class="space-y-6" action="{{ route('ticket.payer',$voyage)  }}" method="POST" >
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Acheter le Ticket</h5>

            <div class="md:flex gap-4 items-center">
                <div class="w-full">
                    <x-label for="date" value="Date du voyage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                    <x-select wire:change="handlerDateOnChange" wire:model="date"  id="date" name="date" type="text" class="mt-1 block w-full" autofocus  value="{{ old('date') }}" >
                        @foreach($dateDispo as $key=>$date)
                            <option value="{{ $dates[$key] }}">{{ $date }}</option>
                        @endforeach
                    </x-select>
                    {{--<input type="date"   wire:model="date" id="date-voyage" name="date" value="{{ old('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required />--}}
                    <x-input-error for="date" />
                </div>
            </div>

            <div class="md:flex gap-4 items-center">
                <div class="w-full">
                    <x-label for="date" value="Numero de la Chaise" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                    <x-select wire:model="numero_chaise" id="numero_chaise" name="numero_chaise" type="text" class="mt-1 block w-full" autofocus  >
                        @forelse($chaiseDispo as $key=>$chaise)
                            <option value="{{ $chaise }}">Chaise N° {{ $chaise }}</option>
                        @empty
                            <option value="{{null}}">Pas de Place Disponible</option>
                        @endforelse
                    </x-select>
                    <x-input-error for="numero_chaise" />
                </div>
            </div>


            <div>
                <div class="md:flex gap-4 items-center">
                    <div class="flex items-center mb-4">
                        <input id="aller_simple" wire:model="type_ticket" name="type" type="radio" value="aller_simple" @checked( old('a_bagage') == 'aller_simple' ) class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="aller_simple" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300"> Aller Simple </label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input id="aller_retour"  wire:model="type_ticket" name="type" type="radio" value="aller_retour" @checked( old('a_bagage') == 'aller_retour' )  class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                        <label for="aller_retour" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300"> Aller Retour </label>
                    </div>
                </div>
                <x-input-error for="type" />
            </div>

            <div x-data="{ showButton: false }">
                <!-- Case à cocher pour afficher le bouton -->
                <label class="flex items-center">
                    <input type="checkbox" name="a_bagage" @checked(old('a_bagage')) x-model="showButton" class="mr-2 w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                    @if($autre_personne instanceof \App\Models\Ticket\AutrePersonne)
                        Il a des Bagage
                    @else
                        J'ai des Bagages
                    @endif
                </label>

            </div>

           @if($autre_personne instanceof \App\Models\Ticket\AutrePersonne)

                <div class="md:flex gap-4 items-center">
                    <div class="w-full">
                        <label for="autre_peronne_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Propiertaire</label>
                        <input type="text"   disabled readonly value="{{$autre_personne->name?? 'Anonyme'}} " name="autre_peronne_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   />
                    </div>
                </div>
                <input type="number" hidden name="autre_personne_id" value="{{$autre_personne->id}}">
           @endif



           <div>
                <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="accepter" type="checkbox" wire:model="accepter"   name="accepter" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
                        </div>
                        <label for="accepter" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            J'accepte <a href="#" class="text-blue-700 hover:underline dark:text-blue-500"> les conditions</a>
                        </label>
                    </div>
                </div>
                <x-input-error for="accepter" />
           </div>

            <button type="submit" class="w-full flex justify-center items-center gap-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Payer
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                  </svg>

            </button>
        </form>
    </div>




</div>
