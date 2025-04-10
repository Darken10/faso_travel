<?php

namespace App\Livewire\Voyage;

use App\Models\Compagnie\Compagnie;
use App\Models\Voyage\VoyageInstance;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchVoyageInstanceComponent extends Component
{

    public $compagnie ;
    public $date ;
    public $villeDepart;
    public $villeArrivee;
    public $nbPlace;


    public Collection|array $compagnies = [];

    public Collection|array $allCompagnies = [];
    public  $voyageInstances ;

    public function mount(): void
    {
        $this->allCompagnies = Compagnie::actives()->get();
        $this->voyageInstances = VoyageInstance::avenir()->with('voyage')->get();
    }

    function updateVoyageInstanceListe()
    {
        $Vquery =VoyageInstance::avenir();
        $compagnieId = $this->compagnie ?? null;
        if ($compagnieId !== null){
            $Vquery->whereHas('voyage', function ($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })->get();
        }
        if ($this->date !== null){
            $Vquery->where('date', $this->date);
        }
        if ($this->villeDepart !== null){
            $Vquery->whereHas('voyage.trajet.depart', function ($query) {
                $query->where('name','like', "%{$this->villeDepart}%");
            });
        }
        if ($this->villeArrivee !== null){
            $Vquery->whereHas('voyage.trajet.arriver', function ($query) {
                $query->where('name','like', "%{$this->villeArrivee}%" );
            });
        }

        $this->voyageInstances = $Vquery->get();

    }
    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.voyage.search-voyage-instance-component');
    }
}
