<?php

namespace App\Livewire\Voyage;


use App\Helper\VoyageHelper;
use App\Models\Ticket\AutrePersonne;
use App\Models\Voyage\Voyage;
use App\Services\Voyage\TicketService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class AcheterTicketFormWithVoyageInstance extends Component
{

    public Voyage $voyage;
    public AutrePersonne|null $autre_personne = null;
    public bool $is_my_ticket=true ;
    public int $avoir_bagage = 0;
    public string $voyage_instance_choise  ;
    public Collection|array $chaiseDispo = [];
    public $numero_chaise;
    public $accepter;

    public string $type_ticket;
    public $items = [];




    public function mount(Voyage $voyage, $autre_personne=null): void
    {
        $this->voyage = $voyage;
        if ($autre_personne ) {
            $this->autre_personne = $autre_personne;
            $this->is_my_ticket = false;
        }
        $this->voyage_instance_choise = $voyage->voyage_instances->first()->id;

        $this->handlerDateOnChange();

    }

    public function handleSubmite()
    {
        $data = [
            'voyage_id' => $this->voyage->id,
            'accepter' => $this->accepter,
            'type' => $this->type_ticket,
            'autre_personne_id'=>$this->autre_personne?->id
        ];
         $res = TicketService::createTicket($this->voyage_instance_choise,$data,$this->is_my_ticket);

         if ($res['create'] === false) {
             return to_route('ticket.goto-payment',[
                 'ticket' => $res['ticket'],
             ])->with("success","Un ticket non payer existe deja a votre nom pour le meme trajet a la meme date");
         }
         else{
             return to_route('ticket.goto-payment',[
                 'ticket' => $res['ticket'],
             ]);
         }


    }



    public function handlerDateOnChange(): void
    {
        $this->chaiseDispo = VoyageHelper::getChaiseDisponiblesWithVoyageInstances($this->voyage_instance_choise);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Factory|Application|View|\Illuminate\View\View
     */
    public function render(): Factory|Application|View|\Illuminate\View\View
    {

        return view('livewire.acheter-ticket-form-with-voyage-instance',[
            'voyage' => $this->voyage,
            'autre_personne' => $this->autre_personne,
        ]);
    }




}
