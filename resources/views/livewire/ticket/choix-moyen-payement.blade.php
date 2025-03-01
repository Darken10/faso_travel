<div class="grid my-8   md:mb-12 md:grid-cols-2">
    <button type="button" class="choix-payement" wire:click="orange" >
        <div class="flex justify-center">
            <img src="{{ asset('images/choix_payement_logo/Orange-Money-logo.jpg') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
        </div>
    </button>
    <button type="button" class="choix-payement" wire:click="moov">
        <div class="flex justify-center">
            <img src="{{ asset('images/choix_payement_logo/moovMoney.jpg') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
        </div>
    </button>
    <form  action="{{route('controller2-payment.payment-process',['provider' => 'ligdicash','ticket' => $this->ticket])}}" method="POST">
        @csrf
        <button   type="submit" class="choix-payement w-full mx-2" >
            <div class="flex justify-center relative">
                <img src="{{ asset('images/choix_payement_logo/ligdiCash.jpeg') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
            </div>
        </button>
    </form>
    <button type="button" class="choix-payement" wire:click="wave">
        <div class="flex justify-center">
            <img src="{{ asset('images/choix_payement_logo/wave.png') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
        </div>
    </button>
    <button type="button" class="choix-payement" wire:click="sank">
        <div class="flex justify-center">
            <img src="{{ asset('images/choix_payement_logo/sankMoney.png') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
        </div>
    </button>
    <button type="button" class="choix-payement" wire:click="masterCarte">
        <div class="flex justify-center">
            <img src="{{ asset('images/choix_payement_logo/MasterCard_Logo.svg_.png') }}" class="w-24 h-24 me-2 -ms-1 " alt="Logo de Orange Money" srcset="">
        </div>
    </button>

</div>
