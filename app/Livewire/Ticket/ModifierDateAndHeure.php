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
    public ?int $dateIndex = null;
    #[Validate('required ')]
    public ?string $heure_depart = null;
    #[Validate('required')]
    public ?int $numero_chaise = null;
    #[Validate('required')]
    public ?int $voyageId = null;
    #[Validate('required')]
    public ?StatutTicket $statut = null;

    public Collection|array $voyages = [];
    public Collection|array $dateDispo = [];
    public Collection|array $chaiseDispo = [];
    public Collection|array $dates = [];


    public function mount(Ticket $ticket){
        $this->ticket = $ticket;
        $this->heure_depart = $ticket->heureDepart()->format('h:i:s');
        $this->numero_chaise = (int)$ticket->numero_chaise;
        $this->voyages = $this->updateHeure()->get();
        $this->chaiseDispo = $this->getChaiseDisponibles();
        $this->voyageId = $this->ticket->voyage_id;
        $this->statut = $this->ticket->statut;

        $this->getDateDisponibles();

        if (collect($this->dateDispo)->isNotEmpty()){
            $this->dateIndex = 0;
            $this->handlerHeureOnChange();
        }

        $this->handlerDateOnChange();
    }

    /**
     * @throws \Throwable
     */
    public function save()
    {
        $data = $this->validate();
        try {

            \DB::beginTransaction();
            $this->ticket->date = Carbon::parse($this->dates[$data["dateIndex"]]);
            $this->ticket->numero_chaise = $data["numero_chaise"];
            $this->ticket->voyage_id = $data["voyageId"];
            $this->ticket->statut = $data["statut"] ;
            $this->ticket->save();
            $response = TicketHelpers::regenerateTicket($this->ticket);
            if ($response){
                PayementEffectuerEvent::dispatch($this->ticket);
                SendClientTicketByMailEvent::dispatch($this->ticket);
                \DB::commit();
                \Auth::user()->notify(new TicketNotification($this->ticket,TypeNotification::UpdateTicket,"Reactivation de ticket","Vous avez reactiver le ticket avec success"));
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

    public function handlerDateOnChange(): void
    {

        $allVoyagesOfDaySelected = VoyageHelper::getVoyagesByDay($this->dates[$this->dateIndex]);
        if($allVoyagesOfDaySelected->isNotEmpty()){
            $this->voyages = $allVoyagesOfDaySelected
                ->where('compagnie_id',$this->ticket->voyage->compagnie->id)
                ->where('trajet_id',$this->ticket->voyage->trajet->id)
                ->where('classe_id',$this->ticket->voyage->classe->id);
            $this->chaiseDispo = $this->getChaiseDisponibles();
        }

       // TODO: je doit revoir comment je gere les heures. le system qui est la presentemnet ne permet pas de prendre en compte les date care les heures peuvent etre diferent les differente jours
    }

    public function handlerHeureOnChange(): void
    {
        $this->chaiseDispo = $this->getChaiseDisponibles();
        // TODO: je doit revoir comment je gere les heures. le system qui est la presentemnet ne permet pas de prendre en compte les date care les heures peuvent etre diferent les differente jours
    }


    private function updateHeure(): \Illuminate\Database\Eloquent\Builder|Voyage
    {
        $voy = Voyage::find($this->voyageId) ?? $this->ticket->voyage;
        $voyages = Voyage::query()
            ->whereBelongsTo($this->ticket->voyage->compagnie)
            ->whereBelongsTo($this->ticket->voyage->trajet)
            ->whereBelongsTo($this->ticket->voyage->classe);


        return $voyages;
    }

    private function getDateDisponibles()
    {
        $res = VoyageHelper::getDateDisponiblesWithTicket($this->ticket);
        $this->dateDispo = $res['datesDisponiblesAndDays'];
        $this->dates = $res['datesDisponibles'];
    }


    private function getChaiseDisponibles(): array|Collection
    {
        if ($this->dateIndex === null) {
            return [];
        }
        return VoyageHelper::getChaiseDisponibles(Voyage::findOrFail($this->voyageId),$this->dates[$this->dateIndex]);

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
