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

    public Collection|array $allCompagnies = [];
    public Collection|array $voyageInstances = [];

    public function mount(): void
    {
        $this->allCompagnies = Compagnie::actives()->get();
        $this->voyageInstances = VoyageInstance::avenir()->with('voyage')->get();
    }
    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        return view('livewire.voyage.search-voyage-instance-component');
    }
}
