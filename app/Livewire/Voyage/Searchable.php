<?php

namespace App\Livewire\Voyage;

use App\Models\Compagnie\Compagnie;
use App\Models\Ville\Ville;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;


class Searchable extends Component
{

    public string $compagnie = "";
    public Compagnie|string $compagnieObjet = '';
    public int $selectedIndex = 0;
    public  $compagnies = [];

    public string $depart = "";
    public int $selectedIndexDepart = 0;
    public Ville|string $dapartObjet ='';
    public $departs = [];

    public string $Arriver = "";
    public int $selectedIndexArriver = 0;
    public Ville|string $ArriverObjet ='';
    public $Arrivers = [];

    public function updatedCompagnie(): void
    {
        $mot = '%' . $this->compagnie . '%';
        if (strlen($this->compagnie) >= 2) {
            $this->compagnies = Compagnie::query()
                ->where('name', 'like', $mot)
                ->orWhere('sigle', 'like', $mot)
                ->get();
        }
    }

    public function incrementIndex()
    {
        if($this->selectedIndex === count($this->compagnies)-1) {
            $this->selectedIndex = 0;
            return true;
        }
        $this->selectedIndex ++;
    }

    public function decrementIndex()
    {
        if($this->selectedIndex === 0) {
            $this->selectedIndex = count($this->compagnies)-1;
            return true;
        }
        $this->selectedIndex --;
    }

    function  clickEnter(): void
    {
        if ($this->compagnies){
            $this->compagnie = $this->compagnies[$this->selectedIndex]->name;
            $this->compagnieObjet = $this->compagnies[$this->selectedIndex];
        }
    }

    function clickCompagnie($index)
    {
        if ($this->compagnies){
            $this->compagnie = $this->compagnies[$index]?->name;
            $this->compagnieObjet = $this->compagnies[$index];
        }
    }
    public function resetIndex(): void
    {
        $this->reset('selectedIndex');
    }


    ###############################################################################"
    public function updatedDepart(): void
    {
        $mot = '%' . $this->depart . '%';
        if (strlen($this->depart) >= 2) {
            $this->departs = Ville::query()->where('name', 'like', $mot)->get();
        }
    }

    public function incrementIndexDepart()
    {
        if($this->selectedIndexDepart === count($this->departs)-1) {
            $this->selectedIndexDepart = 0;
            return true;
        }
        $this->selectedIndexDepart ++;
    }

    public function decrementIndexDepart()
    {
        if($this->selectedIndexDepart === 0) {
            $this->selectedIndexDepart = count($this->departs)-1;
            return true;
        }
        $this->selectedIndexDepart --;
    }

    function  clickEnterDepart()
    {
        if ($this->departs){
            $this->depart = $this->departs[$this->selectedIndexDepart]?->name;
            $this->dapartObjet = $this->departs[$this->selectedIndexDepart];
            $this->search();
        }
    }

    public function resetIndexDepart()
    {
        $this->reset('selectedIndexDepart');
    }

    function clickDepart($index)
    {
        if ($this->departs){
            $this->depart = $this->departs[$index]?->name;
            $this->dapartObjet =  $this->departs[$index];
            $this->search();
        }
    }


    private function search()
    {
        $query = Voyage::query();
        
        if ($this->compagnieObjet != ''){
            $query->where('compagnie_id',$this->compagnieObjet->id);
        }
        if ($this->dapartObjet != '') {
           $tagets = Trajet::query()->where('depart_id',$this->dapartObjet->id)->get()->pluck('id')->toArray();
           $query->whereIn('trajet_id',$tagets);
        }

        return $query->get();
    }

    public function render()
    {
        $voyages = $this->search();
        return view('livewire.voyage.searchable',[
            'voyages' => $voyages,
        ]);
    }
}
