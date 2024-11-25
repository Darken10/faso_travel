@extends('layout')

@section('title','choix du moyen de payement')

@section('content')

    <div class="card m-auto my-4">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white flex m-auto justify-center">Choix du Moyen de payment </h5>

        @livewire('ticket.choix-moyen-payement', ['ticket' => $ticket], key(1))

    </div>

@endsection
