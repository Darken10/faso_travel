<?php

namespace App\Livewire\Voyage;


use App\Helper\VoyageHelper;
use App\Models\Ticket\AutrePersonne;
use App\Models\Voyage\Voyage;
use App\Services\Ticket\TicketCommandService;
use App\Enums\TypeTicket;
use App\Models\Voyage\VoyageInstance;
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




    public function mount(Voyage $voyage, $autre_personne = null): void
    {
        $this->voyage = $voyage;
        if ($autre_personne ) {
            $this->autre_personne = $autre_personne;
            $this->is_my_ticket = false;
        }
        $this->voyage_instance_choise = $voyage->voyage_instances->first()->id ;

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
         $voyageInstance = VoyageInstance::findOrFail($this->voyage_instance_choise);
         $type = ($data['type'] ?? 'aller_simple') === 'aller_retour' ? TypeTicket::AllerRetour : TypeTicket::AllerSimple;
         $ticketCommandService = resolve(TicketCommandService::class);
         $res = $ticketCommandService->createFromVoyageInstance($voyageInstance, $type, $this->is_my_ticket, $this->autre_personne);

         if (!$res['created']) {
             return to_route('ticket.goto-payment',[
                 'ticket' => $res['ticket'],
             ])->with("success","Un ticket non payé existe déjà à votre nom pour le même trajet à la même date");
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
