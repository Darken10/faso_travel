<?php

namespace App\Livewire\Voyage;

use App\Models\Compagnie\Compagnie;
use Livewire\Component;
use App\Models\Ville\Ville;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Voyage;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Search extends Component
{

    public string $compagnieQuery = '';
    public string $departQuery = '';
    public string $arriverQuery = '';
    public  $heureQuery = '' ;
    public $voyages = [];

   
    public function updated($property)
    {
        $query = Voyage::query();
        if ( $property==="compagnieQuery"){
            $compagnies = Compagnie::query()
                                    ->where('name','like','%'.$this->compagnieQuery.'%')
                                    ->orWhere('sigle','like','%'.$this->compagnieQuery.'%')
                                     ->get()->pluck('id')->toArray();
                                     
            $query = $query->whereIn('compagnie_id',$compagnies) ;
        }

        if ( $property==="departQuery"  or $property==="arriverQuery"){
            $departs = Ville::query()
                            ->where('name','like','%'.$this->departQuery.'%')
                            ->get()->pluck('id')->toArray();
            $arrivers = Ville::query()
                            ->where('name','like','%'.$this->arriverQuery.'%')
                            ->get()->pluck('id')->toArray();
           

            $tragets = Trajet::query()->whereIn('depart_id',$departs)->WhereIn('arriver_id',$arrivers)
                                ->get()->pluck('id')->toArray();

            $query = $query->whereIn('trajet_id',$tragets) ;
        }

        if ( $property==="heureQuery"){
            
            $query = $query->where('heure','>',$this->heureQuery) ;
        }
        
        return $this->voyages = $query->get();
    }


    public function redirecteToShow(Voyage $voyage){
        return to_route('voyage.show',$voyage);
    }


    public function render()
    {
        return view('livewire.voyage.search',[
            'voyages' => $this->voyages,
        ]);
    }
}
