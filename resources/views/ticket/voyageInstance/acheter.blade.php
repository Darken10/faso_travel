@extends('layout')

@section('content')
    <div class=" flex justify-center my-4 w-full">
        {{--@livewire('voyage.acheter-ticket-form',['voyage'=>$voyage,'autre_personne'=>$autre_personne])--}}
        @livewire('voyage.acheter-ticket-form-with-voyage-instance',['voyage'=>$voyageInstance->voyage,'autre_personne'=>$autre_personne])
    </div>
@endsection
