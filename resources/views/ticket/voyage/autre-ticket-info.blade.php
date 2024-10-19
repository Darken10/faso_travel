@extends('layout')

@section('content')
    <div class=" flex justify-center my-4 w-full">
        <div >
            <div class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                <form class="space-y-6" method="POST" >
                    @csrf
                    <h5 class="text-xl font-medium text-gray-900 dark:text-white">Information pour une autre personne</h5>

                    <div class="md:flex gap-4 items-center">
                        <div class="w-full">
                            <x-label for="first_name"> Nom: </x-label>
                            <x-input  type="text"  id="first_name" name="first_name" value="{{ old('first_name') }}" class="w-full"/>
                            <x-input-error for="first_name" />
                        </div>
                    </div>
                    <div class="md:flex gap-4 items-center">
                        <div class="w-full">
                            <x-label for="last_name"> Prenom: </x-label>
                            <x-input  type="text"  id="last_name" name="last_name" value="{{ old('last_name') }}" class="w-full" required/>
                            <x-input-error for="last_name" />
                        </div>
                    </div>


                    <div>
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

                    <div class="grid grid-cols-6">
                        <div class="md:flex gap-4 items-center col-span-2">
                            <div class="w-full">
                                <x-label for="numero_identifiant"> Identifiant: </x-label>
                                <select id="numero_identifiant"
                                        name="numero_identifiant"
                                        class="bg-gray-50 border border-e-0 border-gray-300 text-gray-900 text-sm rounded-s-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach(\App\Models\Ville\Pays::all() as $pays)
                                        <option @selected($pays=== auth()->user()->numero_identifiant) value="{{ $pays->identity_number  }}">{{$pays->identity_number}} ({{$pays->iso2}})</option>
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

                    <div class="md:flex gap-4 items-center">
                        <div class="w-full">
                            <x-label for="lien_relation"> Identifiant: </x-label>
                            <select id="lien_relation"
                                    name="lien_relation"
                                    class="bg-gray-50 border border-e-0 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach( \App\Enums\LienRelationAutrePersonneTicket::values() as $lien)
                                    <option  value="{{ $lien  }}">{{$lien}} </option>
                                @endforeach
                            </select>
                            <x-input-error for="lien_relation"  />
                        </div>
                    </div>





                    <div>
                        <div class="flex items-start">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="accepter" type="checkbox"  name="accepter"
                                           class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                           required/>
                                </div>
                                <label for="accepter" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    <a href="#" class="text-blue-700 hover:underline dark:text-blue-500  " >J'accepte les conditions</a>
                                </label>
                            </div>
                        </div>
                        <x-input-error for="accepter"/>
                    </div>

                    <button type="submit" class="w-full flex justify-center items-center gap-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Payer
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                        </svg>
                    </button>

                </form>
            </div>




        </div>
    </div>

@endsection
