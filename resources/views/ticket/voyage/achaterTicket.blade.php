@extends('layout')

@section('content')
    <div class=" flex justify-center my-4 w-full">
        @livewire('voyage.acheter-ticket-form',['voyage'=>$voyage,'autre_personne'=>$autre_personne?? null,])
   </div>
@endsection
