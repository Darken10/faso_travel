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
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $voyageInstance->compagnie()->name }}</h5>
                        <p class="mb-3 font-normal text-gray-400 dark:text-gray-400 flex justify-center italic text-sm " >'{{ $voyageInstance->compagnie()->slogant }}</p>
                    </div>
                </a>

                <div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm italic">{{ \Str::limit($voyageInstance->compagnie()->description,150) }}</p>
                </div>



                @livewire("voyage-instance.info-supplementaire-pour-achat-ticket",['voyageInstance'=>$voyageInstance])



            </div>
        </div>
    </div>

@endsection
