@extends('layout')

@section('content')

    <div class=" flex justify-center my-4">
        <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#"  class="w-full">
                <img class="rounded-t-lg" style="width: 100%" src="{{ asset('images/tk2.jpg') }}" alt="" />
            </a>
            <div class="p-5">
                <a href="#" class=" flex justify-center mx-3 mt-4">
                    <div class="block">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $voyage->compagnie->name }}</h5>
                        <p class="mb-3 font-normal text-gray-400 dark:text-gray-400 flex justify-center italic text-sm " >'{{ $voyage->compagnie->slogant }}</p>
                    </div>
                </a>

                <div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm italic">{{ \Str::limit($voyage->compagnie->description,150) }}</p>
                </div>

                <form  method="post">
                    @csrf
                    <div class="mb-4">
                        <div class="md:flex gap-4 items-center">
                            <div class="flex items-center mb-4">
                                <input id="is_my_ticket"  name="is_my_ticket" type="radio" value="is_my_ticket" @checked( old('is_my_ticket') == 'is_my_ticket' ) class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                                <label for="is_my_ticket" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300"> Pour Moi meme </label>
                            </div>
                            <div class="flex items-center mb-4">
                                <input id="is_not_my_ticket"   name="is_my_ticket" type="radio" value="is_not_my_ticket" @checked( old('is_my_ticket') == 'is_not_my_ticket' )  class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                                <label for="is_not_my_ticket" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300"> Pour une autre Personne </label>
                            </div>
                        </div>
                        <x-input-error for="type" />
                    </div>

                    <div class="flex justify-end">
                        <button
                            type="submit"
                           class="inline-flex  items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Suivant
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>
                    </div>

                    {{--
                    <div class="flex justify-end">
                        <a href="{{ route('voyage.acheter',$voyage) }}"
                           class="inline-flex  items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Suivant
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                    --}}
                </form>
            </div>
        </div>
    </div>

@endsection
