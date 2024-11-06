<?php

namespace App\Livewire\Voyage;

use App\Models\Ticket\AutrePersonne;
use App\Models\User;

use App\Models\Voyage\Voyage;
use Carbon\Carbon;
use Livewire\Component;

class AcheterTicketForm extends Component
{

    public int $avoir_bagage = 0;
    public Carbon $date ;
    public Voyage $voyage;
    public string $type_ticket;
    public $items = []; // Initialiser une liste vide d'éléments
    public AutrePersonne|null $autre_personne = null;

    public function mount(Voyage $voyage, $autre_personne=null): void
    {
        // Initialize with one empty item
        $this->items = [['selectedOption' => null, 'number' => null]];
        $this->voyage = $voyage;
        $this->autre_personne = $autre_personne;
    }


    public function addItem(): void
    {

        $this->items[] = ['selectedOption' => null, 'number' => null];
    }

    public function removeItem($index): void
    {
        unset($this->items[$index]); // Supprimer un élément par index
        $this->items = array_values($this->items); // Réindexer l'array
    }
    /*public function submit()
    {

        dd($this->avoir_bagage,$this->date,$this->type_ticket,$this->items);
    }*/



    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.voyage.acheter-ticket-form');
    }
}
