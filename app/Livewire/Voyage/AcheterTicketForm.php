<?php

namespace App\Livewire\Voyage;

use App\Helper\VoyageHelper;
use App\Models\Ticket\AutrePersonne;
use App\Models\User;

use App\Models\Voyage\Voyage;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AcheterTicketForm extends Component
{

    public int $avoir_bagage = 0;
    public string $date ;
    public Voyage $voyage;

    public Collection|array $dateDispo = [];
    public Collection|array $chaiseDispo = [];
    public Collection|array $dates = [];

    public string|null $date2 = null;
    public string $type_ticket;
    public $items = [];
    public AutrePersonne|null $autre_personne = null;

    public function mount(Voyage $voyage, $autre_personne=null): void
    {
        $voyage_instances = $voyage->voyage_instances;

        $this->items = [['selectedOption' => null, 'number' => null]];
        $this->voyage = $voyage;
        $this->autre_personne = $autre_personne;
        $a =  VoyageHelper::getDateDisponibles($voyage);
        $this->dateDispo = $a['datesDisponiblesAndDays'];
        $this->dates = $a['datesDisponibles'];
        $this->date= $this->dates[0];
        $this->handlerDateOnChange();
    }

    public function addItem(): void
    {

        $this->items[] = ['selectedOption' => null, 'number' => null];
    }

    public function removeItem($index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
    /*public function submit()
    {

        dd($this->avoir_bagage,$this->date,$this->type_ticket,$this->items);
    }*/

    public function handlerDateOnChange(): void
    {
        $this->chaiseDispo = VoyageHelper::getChaiseDisponibles($this->voyage,$this->date);
    }


    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.voyage.acheter-ticket-form');
    }
}
