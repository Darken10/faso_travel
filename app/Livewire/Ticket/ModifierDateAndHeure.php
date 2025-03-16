<?php

namespace App\Livewire\Ticket;

use App\Enums\StatutTicket;
use App\Enums\TypeNotification;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\TicketHelpers;
use App\Helper\VoyageHelper;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use App\Notifications\Ticket\TicketNotification;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function Symfony\Component\String\s;

class ModifierDateAndHeure extends Component
{
    public Ticket $ticket;

    #[Validate('required')]
    public ?int $numero_chaise = null;
    #[Validate('required')]
    public ?string $voyageInstanceId = null;

    #[Validate('required')]
    public ?StatutTicket $statut = null;
    public Collection|array $chaiseDispo = [];
    public Collection|array $voyageInstances = [];


    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;
        $this->numero_chaise = (int)$ticket->numero_chaise;
        $this->voyageInstances = $this->updateHeure()->get();
        $this->chaiseDispo = $this->getChaiseDisponibles();
        $this->voyageInstanceId = $this->voyageInstances->first()->id;
        $this->statut = $this->ticket->statut;
    }

    /**
     * @throws \Throwable
     */
    public function save()
    {
        $data = $this->validate();
        try {
            \DB::beginTransaction();
            $this->ticket->numero_chaise = $data["numero_chaise"];
            $this->ticket->voyage_instance_id = $data["voyageInstanceId"];
            $this->ticket->statut = $data["statut"] ;
            $this->ticket->save();
            $response = TicketHelpers::regenerateTicket($this->ticket);
            if ($response){
                PayementEffectuerEvent::dispatch($this->ticket);
                SendClientTicketByMailEvent::dispatch($this->ticket,TypeNotification::TICKET_UPDATED);
                \DB::commit();
                return to_route('ticket.show-ticket',['ticket' => $this->ticket])
                    ->with('success',"Votre Ticket a bien ete modifier");
            }
            else{
                \DB::rollback();
            }
        }
        catch (\Exception $e){
            \DB::rollback();
            \Session::now("error","Une erreur est survenue");
        }
        return false;

    }

    private function updateHeure(): \Illuminate\Database\Eloquent\Builder|VoyageInstance
    {
        $voyageInstances = VoyageInstance::query()
            ->whereHas("voyage", function($query){
                $query->where('trajet_id',$this->ticket->voyageInstance->voyage->trajet->id)
                ->where('classe_id',$this->ticket->voyageInstance->classe->id ?? $this->ticket->voyageInstance->voyage->classe->id)
                ->where('compagnie_id',$this->ticket->voyageInstance->voyage->compagnie->id);
            });

        return $voyageInstances;
    }


    private function getChaiseDisponibles(): array|Collection
    {
        return VoyageHelper::getChaiseDisponiblesWithVoyageInstances($this->voyageInstanceId ?? $this->updateHeure()->get()->first()->id);
    }

    private function verificationVoyage(Voyage $voyage) : array
    {
        $verificationTraget = $voyage->trajet_id == $this->ticket->voyage->trajet;
        $verificationCompagnie = $voyage->compagnie_id == $this->ticket->voyage->compagnie_id;
        $verificationClasse = $voyage->classe_id == $this->ticket->voyage->classe_id;
        $verificationDepart = $voyage->depart_id == $this->ticket->voyage->depart_id;
        $verificationArrive = $voyage->arrive_id == $this->ticket->voyage->arrive_id;
        $message = [];
        $verify = false;
        if ($verificationCompagnie){
            if ($verificationTraget){
                if ($verificationClasse){
                    if ($verificationDepart and  $verificationArrive){
                        $verify = true;
                    } else {
                        $message[] = "La ville de depart ou la ville d'arriver peut pas etre changer";
                    }
                } else {
                    $message[] = "La Classe  peut pas etre changer";
                }
            } else {
                $message[] = "Le Traget  peut pas etre changer";
            }
        } else {
            $message[] = "La compagnie peut pas etre changer";
        }

        return [
            'verify' => $verify,
            "message" => $message
        ];
    }


    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.ticket.modifier-date-and-heure');
    }

}
