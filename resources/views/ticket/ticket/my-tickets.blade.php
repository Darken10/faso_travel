@extends('layout')

@section('title','Mes Tickets')

@section('content')

    @forelse ($tickets as $ticket)

        <x-ticket.my-ticket-item :$ticket />

    @empty
        <div class=" align-middle flex justify-center font-bold uppercase text-3xl text-gray-500 my-4 py-4">
            Aucun ticket n'est disponible
        </div>
    @endforelse

@endsection
