@extends('layout')

@section('title',' Payer par Orange')

@section('content')

    <div class="card m-auto">
       <div class=" flex justify-center my-4">
            <img src="{{ asset('images/choix_payement_logo/Orange-Money-logo.jpg') }}" class=" w-28  m-auto" alt="">
       </div>

        <div>
            tapez ce code et fournisser l'otp obtenue par SMS :
            <div class="text-xl text-red-600 font-bold flex justify-center items-center">
                code *146*4*6*{{$ticket->voyage->getPrix($ticket->type)}}#
            </div>
        </div>

       <form action="{{ route('payement.orange.payer',$ticket) }}" method="post">
            @csrf
            <div class="w-full">
                <div class="mt-4">
                    <x-label for="numero" value="Numero" />
                    <x-input id="numero" class="block mt-1 w-full" type="tel" name="numero" required  />
                </div>

                <div class="mt-4">
                    <x-label for="otp" value="Code OTP" />
                    <x-input id="otp" class="block mt-1 w-full" type="tel" name="otp" required />
                </div>

                <div class="mt-4 flex justify-between">
                    <button class="btn-secondary" type="reset">Annuler</button>
                    <button class="btn-primary" type="submit">Payer</button>
                </div>
        </div>
       </form>

    </div>

@endsection
