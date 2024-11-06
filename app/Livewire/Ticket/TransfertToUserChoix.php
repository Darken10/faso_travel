<?php

namespace App\Livewire\Ticket;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class TransfertToUserChoix extends Component
{

    public string $name = "";
    public Ticket $ticket;
    public Collection|array $users = [];
    public Collection|array $allUsers =[];

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $this->allUsers = User::all();
        $this->users = $this->allUsers->where('name', 'like',"%{$this->name}%");
    }

    public function handleChange(){
        $this->users = User::whereLike('name', "%{$this->name}%")->get();;
    }

    public function render(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.ticket.transfert-to-user-choix',[
            'users' => $this->users,
        ]);
    }
}
