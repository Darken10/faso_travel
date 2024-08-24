<?php

namespace App\Livewire\Voyage;

use Livewire\Component;
use App\Models\Ville\Ville;
use App\Models\Voyage\Trajet;
use App\Models\Voyage\Voyage;
use Illuminate\Support\Collection;

class Search extends Component
{

    public $departureCity = '';
    public $arrivalCity = '';
    public $departureTime = '';
    public $company = '';

    public $departureSuggestions = [];
    public $arrivalSuggestions = [];
    public $companySuggestions = [];
    
    public $searchResults = [];

    public function updatedDepartureCity()
    {
        $this->departureSuggestions = Ville::where('name', 'like', '%' . $this->departureCity . '%')
            ->pluck('name')
            ->take(5);
    }

    public function updatedArrivalCity()
    {
        $this->arrivalSuggestions = Ville::where('name', 'like', '%' . $this->arrivalCity . '%')
            ->pluck('name')
            ->take(5);
    }

    public function updatedCompany()
    {
        // Suppose that companies are stored in the `company_name` column in the `Voyage` model
        $this->companySuggestions = Voyage::where('compagnie_id', 'like', '%' . $this->company . '%')
            ->pluck('compagnie_id')
            ->take(5);
    }

    public function selectDepartureCity($city)
    {
        $this->departureCity = $city;
        $this->departureSuggestions = [];
    }

    public function selectArrivalCity($city)
    {
        $this->arrivalCity = $city;
        $this->arrivalSuggestions = [];
    }

    public function selectCompany($company)
    {
        $this->company = $company;
        $this->companySuggestions = [];
    }

    public function search()
    {
        $query = Ville::query();

        if ($this->departureCity) {
            $query->where('name', $this->departureCity)
                  ->with(['voyagesDepart' => function ($q) {
                      if ($this->arrivalCity) {
                          $q->whereHas('trajet.villeArrivee', function ($query) {
                              $query->where('name', $this->arrivalCity);
                          });
                      }

                      if ($this->departureTime) {
                          $q->whereDate('heure', $this->departureTime);
                      }

                      if ($this->company) {
                          $q->where('compagnie_id', $this->company);
                      }
                  }]);
        }

        $results = $query->get();

        $this->searchResults = new Collection();
        foreach ($results as $ville) {
            $this->searchResults = $this->searchResults->merge($ville->voyagesDepart);
        }
    }


    public function render()
    {
        return view('livewire.voyage.search',[
            'searchResults' => $this->searchResults,
        ]);
    }
}
