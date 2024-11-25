@extends('layout')

@section('title','choix du moyen de payement')

@section('content')

    <div class="card m-auto my-4">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white flex m-auto justify-center">Modifier les informations </h5>

        <div class=" grid grid-cols-12 gap-4 mb-4">
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Ville Depart') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full"  disabled value="{{ $ticket->villeDepart()->name }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Ville Arriver') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" disabled value="{{ $ticket->villeArriver()->name }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>

        <div class=" grid grid-cols-12 gap-4 mb-4">
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Gare Depart') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" autofocus  value="{{ $ticket->gareDepart()->name }}"/>
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Gare Arriver') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" autofocus value="{{ $ticket->gareArriver()->name }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>

        <div class=" grid grid-cols-12 gap-4 mb-4">
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Heure Depart') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" autofocus value="{{ $ticket->heureDepart() }}" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Heure Arriver') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" autofocus  value="{{ $ticket->heureArriver() }}"/>
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>

    </div>

@endsection
