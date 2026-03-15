<div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
    <button type="button" wire:click="orange" class="group relative flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-orange-400 hover:bg-orange-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-orange-400 dark:hover:bg-surface-700">
        <img src="{{ asset('images/choix_payement_logo/Orange-Money-logo.jpg') }}" class="w-16 h-16 object-contain rounded-lg" alt="Orange Money">
        <span class="text-xs font-semibold text-surface-600 group-hover:text-orange-600 dark:text-surface-400 dark:group-hover:text-orange-400 transition-colors">Orange Money</span>
    </button>
    <button type="button" wire:click="moov" class="group relative flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-blue-400 hover:bg-blue-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-blue-400 dark:hover:bg-surface-700">
        <img src="{{ asset('images/choix_payement_logo/moovMoney.jpg') }}" class="w-16 h-16 object-contain rounded-lg" alt="Moov Money">
        <span class="text-xs font-semibold text-surface-600 group-hover:text-blue-600 dark:text-surface-400 dark:group-hover:text-blue-400 transition-colors">Moov Money</span>
    </button>
    <form action="{{ route('controller2-payment.payment-process',['provider' => 'ligdicash','ticket' => $this->ticket]) }}" method="POST">
        @csrf
        <button type="submit" class="group relative w-full flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-green-400 hover:bg-green-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-green-400 dark:hover:bg-surface-700">
            <img src="{{ asset('images/choix_payement_logo/ligdiCash.jpeg') }}" class="w-16 h-16 object-contain rounded-lg" alt="LigdiCash">
            <span class="text-xs font-semibold text-surface-600 group-hover:text-green-600 dark:text-surface-400 dark:group-hover:text-green-400 transition-colors">LigdiCash</span>
        </button>
    </form>
    <button type="button" wire:click="wave" class="group relative flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-sky-400 hover:bg-sky-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-sky-400 dark:hover:bg-surface-700">
        <img src="{{ asset('images/choix_payement_logo/wave.png') }}" class="w-16 h-16 object-contain rounded-lg" alt="Wave">
        <span class="text-xs font-semibold text-surface-600 group-hover:text-sky-600 dark:text-surface-400 dark:group-hover:text-sky-400 transition-colors">Wave</span>
    </button>
    <button type="button" wire:click="sank" class="group relative flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-purple-400 hover:bg-purple-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-purple-400 dark:hover:bg-surface-700">
        <img src="{{ asset('images/choix_payement_logo/sankMoney.png') }}" class="w-16 h-16 object-contain rounded-lg" alt="Sank Money">
        <span class="text-xs font-semibold text-surface-600 group-hover:text-purple-600 dark:text-surface-400 dark:group-hover:text-purple-400 transition-colors">Sank Money</span>
    </button>
    <button type="button" wire:click="masterCarte" class="group relative flex flex-col items-center gap-3 p-5 rounded-xl border-2 border-surface-200 bg-white hover:border-red-400 hover:bg-red-50 hover:shadow-soft transition-all duration-200 dark:bg-surface-800 dark:border-surface-600 dark:hover:border-red-400 dark:hover:bg-surface-700">
        <img src="{{ asset('images/choix_payement_logo/MasterCard_Logo.svg_.png') }}" class="w-16 h-16 object-contain rounded-lg" alt="MasterCard">
        <span class="text-xs font-semibold text-surface-600 group-hover:text-red-600 dark:text-surface-400 dark:group-hover:text-red-400 transition-colors">Carte Bancaire</span>
    </button>
</div>
