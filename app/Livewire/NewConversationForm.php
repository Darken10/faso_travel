<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\Messages\Conversation;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NewConversationForm extends Component
{
    public $companyId;
    public $message;

    protected $rules = [
        'companyId' => 'required|exists:users,id',
        'message' => 'required|string|min:1',
    ];

    public function create()
    {
        $this->validate();

        // Créer la conversation
        $conversation = Conversation::create([
            'user_id' => Auth::id(), // client
            'company_id' => $this->companyId,
            'status' => 'open',
        ]);

        // Ajouter le premier message
        $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'message' => $this->message,
        ]);

        // Rediriger vers la page des messages
        return redirect()->route('messages.index');
    }

    public function render()
    {
        $companies = User::whereNotNull('compagnie_id')->get();

        return view('livewire.new-conversation-form', [
            'companies' => $companies,
        ]);
    }
}

