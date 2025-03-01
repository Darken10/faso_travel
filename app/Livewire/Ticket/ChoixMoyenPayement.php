<?php

namespace App\Livewire\Ticket;

use App\Models\Ticket\Ticket;
use Livewire\Component;

class ChoixMoyenPayement extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket){
        $this->ticket = $ticket;
    }

    public function orange(){

        return to_route('payement.orange.paymentPage',['ticket' => $this->ticket]);
    }

    public function moov(){
        dd('moov');
    }

    public function ligdiCash(){
    }

    public function wave(){
        dd('wave');
    }

    public function sank(){
        dd('sank');
    }

    public function masterCarte(){
        dd('masterCarte');
    }

    public function render()
    {
        return view('livewire.ticket.choix-moyen-payement');
    }
}
