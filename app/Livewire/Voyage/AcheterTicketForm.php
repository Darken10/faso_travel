<?php

namespace App\Livewire\Voyage;

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
    public $options = [
        ['id' => 1, 'name' => 'Option 1', 'image' => 'https://via.placeholder.com/40'],
        ['id' => 2, 'name' => 'Option 2', 'image' => 'https://via.placeholder.com/40'],
        ['id' => 3, 'name' => 'Option 3', 'image' => 'https://via.placeholder.com/40'],
    ];

    public function mount(Voyage $voyage)
    {
        // Initialize with one empty item
        $this->items = [['selectedOption' => null, 'number' => null]];
        $this->voyage = $voyage;
    }


    public function addItem()
    {

        $this->items[] = ['selectedOption' => null, 'number' => null];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]); // Supprimer un élément par index
        $this->items = array_values($this->items); // Réindexer l'array
    }
    /*public function submit()
    {

        dd($this->avoir_bagage,$this->date,$this->type_ticket,$this->items);
    }*/



    public function render()
    {
        return view('livewire.voyage.acheter-ticket-form');
    }
}
