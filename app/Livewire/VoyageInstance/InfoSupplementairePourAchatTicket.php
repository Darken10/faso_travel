<?php

namespace App\Livewire\VoyageInstance;

use App\Helper\VoyageHelper;
use App\Models\Voyage\VoyageInstance;
use App\Services\ticket\TicketService;
use Illuminate\Support\Collection;
use Livewire\Component;

class InfoSupplementairePourAchatTicket extends Component
{

    public VoyageInstance $voyageInstance;

    public $buyFor = 'self';
    public $numero_chaise;
    public $voyageType = 'aller_simple';
    public $bagages = [];
    public $otherPerson = [
        'first_name' => '',
        'last_name' => '',
        'sexe' => '',
        'numero_identifiant' => '',
        'numero' => '',
        'email' => '',
        'lien_relation' => '',
        'accepter' => false,
    ];



    protected function rules()
    {
        return [
            'numero_chaise' => 'required',
            'voyageType' => 'required|in:aller_simple,aller_retour',
            'bagages' => 'array',
            'otherPerson.first_name' => 'required_if:buyFor,other|string|max:255',
            'otherPerson.last_name' => 'required_if:buyFor,other|string|max:255',
            'otherPerson.sexe' => 'required_if:buyFor,other|in:Homme,Femme,Autre',
            'otherPerson.numero_identifiant' => 'required_if:buyFor,other|string|max:5',
            'otherPerson.numero' => 'required_if:buyFor,other|regex:/^[0-9]{8,12}$/',
            'otherPerson.email' => 'nullable|email',
            'otherPerson.lien_relation' => 'required_if:buyFor,other|string',
            'otherPerson.accepter' => 'accepted_if:buyFor,other',
        ];
    }



    public function submit()
    {

        $this->ticketService = resolve(TicketService::class);
        $data = $this->validate();
        $isMine = $this->buyFor === 'self';
            $tk = $this->ticketService->create($this->voyageInstance->id,$data,$isMine);
        if ($tk){
            return to_route('ticket.goto-payment',$tk);
        }
        session()->flash('error', 'Une erreur au survenu lors de la reservation');
    }


    public function mount(VoyageInstance $voyageInstance): void{
        $this->voyageInstance = $voyageInstance;
    }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('livewire.voyage-instance.info-supplementaire-pour-achat-ticket',[
            'chaiseDispo' => $this->voyageInstance->chaiseDispo(),
            'buyFor' => $this->buyFor,
            'pays' => \App\Models\Ville\Pays::all(),
            'liens' => \App\Enums\LienRelationAutrePersonneTicket::values(),
            'bagageOptions' => ['Valise', 'Sac à dos', 'Petit sac', 'Caisse'],
        ]);
    }
}
