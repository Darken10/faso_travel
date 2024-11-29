<?php

namespace App\Livewire\Ticket;

use App\Helper\TicketHelpers;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ModifierDateAndHeure extends Component
{
    public Ticket $ticket;
    #[Validate('required')]
    public ?string $date = null;
    #[Validate('required ')]
    public ?string $heure_depart = null;
    #[Validate('required')]
    public ?int $numero_chaise = null;

    public Collection|array $voyages = [];
    public Collection|array $dateDispo = [];
    public Collection|array $chaiseDispo = [];


    public function mount(Ticket $ticket){
        $this->ticket = $ticket;
        $this->date = $ticket->date->format('Y-m-d');
        $this->heure_depart = $ticket->heureDepart()->format('h:i:s');
        $this->numero_chaise = (int)$ticket->numero_chaise;
        $this->voyages = $this->updateHeure()->get();
        $this->dateDispo = $this->getDateDisponibles();
        $this->chaiseDispo = $this->getChaiseDisponibles();


    }

    /**
     * @throws \Throwable
     */
    public function save()
    {
        $this->validate();
        try {
            \DB::beginTransaction();
            $this->ticket->date = Carbon::parse($this->date);
            //$this->ticket->heureDepart = Carbon::parse($this->heure_depart);
            $this->ticket->numero_chaise = $this->numero_chaise;
            $this->ticket->save();
            \DB::commit();
        }
        catch (\Exception $e){
            \DB::rollback();
        }
    }

    public function handlerDateOnChange(): void
    {
       $this->voyages = $this->updateHeure()->get();
       // TODO: je doit revoir comment je gere les heures. le system qui est la presentemnet ne permet pas de prendre en compte les date care les heures peuvent etre diferent les differente jours
    }

    private function updateHeure(): \Illuminate\Database\Eloquent\Builder|Voyage
    {

        return Voyage::query()
            ->whereBelongsTo($this->ticket->voyage->compagnie)
            ->whereBelongsTo($this->ticket->voyage->trajet)
            ->whereBelongsTo($this->ticket->voyage->classe);
    }

    private function getDateDisponibles(): array
    {

        $joursSelectionnes = collect($this->ticket->voyage->days); // Les jours sélectionnés dans la base
        $joursSelectionnes = $joursSelectionnes->map(fn ($jour) => strtolower($jour));
        $datesDisponibles = [];

        Carbon::setLocale('fr');
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->addDays($i);
            $jourSemaine = strtolower($date->translatedFormat('l'));
            if ($joursSelectionnes->contains($jourSemaine)) {
                $datesDisponibles[] = $date->toDateString() . ' (' . $jourSemaine.')';
            }
        }
        return $datesDisponibles;
    }


    private function getChaiseDisponibles(): array|Collection
    {
        if ($this->date === null) {
            return [];
        }
        $chaiseDisponibles = TicketHelpers::getNumeroChaiseDisponible($this->ticket->voyage, $this->date);

        return collect($chaiseDisponibles);

    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.ticket.modifier-date-and-heure');
    }

}
