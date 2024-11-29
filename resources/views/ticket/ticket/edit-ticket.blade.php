@extends('layout')

@section('title','choix du moyen de payement')

@section('content')

    <div class="card m-auto my-4">
        <h5 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white flex m-auto justify-center">Modifier les informations du Ticket</h5>

        <div class=" grid grid-cols-12 gap-4 mb-4">
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Ville Depart') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full"  disabled value="{{ $ticket->villeDepart()->name }}" disabled />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <x-label for="name" value="{{ __('Ville Arriver') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" disabled value="{{ $ticket->villeArriver()->name }}" disabled />
                <x-input-error for="name" class="mt-2" />
            </div>
        </div>

        <div class=" grid grid-cols-12 gap-4 mb-4">
            <div class="col-span-6 ">
                <x-label for="gare_depart" value="{{ __('Gare Depart') }}" />
                <x-input id="gare_depart" type="text" class="mt-1 block w-full" autofocus  value="{{ $ticket->gareDepart()->name }}" disabled />
                <x-input-error for="gare_depart" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <x-label for="gare_arrive" value="{{ __('Gare Arriver') }}" />
                <x-input id="gare_arrive" type="text" class="mt-1 block w-full" autofocus value="{{ $ticket->gareArriver()->name }}" disabled />
                <x-input-error for="gare_arrive" class="mt-2" />
            </div>
        </div>

        @livewire('ticket.modifier-date-and-heure',['ticket'=>$ticket])

    </div>



@endsection
