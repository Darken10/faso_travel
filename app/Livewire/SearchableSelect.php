<?php

namespace App\Livewire;

use Livewire\Component;

class SearchableSelect extends Component
{
    public $query = '';
    public $options = [];
    public $selectedOption = null;

    public function updatedQuery()
    {
        $this->options = $this->searchOptions($this->query);
    }

    public function selectOption($value)
    {
        $this->selectedOption = $value;
        $this->query = $this->options[$value];
    }

    public function searchOptions($searchTerm)
    {
        // Simuler des options de recherche (remplacer par une requête DB si nécessaire)
        $allOptions = [
            '1' => 'Option 1',
            '2' => 'Option 2',
            '3' => 'Option 3',
            '4' => 'Option 4',
            '5' => 'Option 5',
        ];

        if (empty($searchTerm)) {
            return $allOptions;
        }

        return collect($allOptions)
            ->filter(fn($label) => stripos($label, $searchTerm) !== false)
            ->toArray();
    }

    public function render()
    {
        return view('livewire.searchable-select');
    }
}
